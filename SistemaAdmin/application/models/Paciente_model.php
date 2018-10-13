<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe para manipular o Banco de Dados referente as Consultas
 * 
 * @package  SistemAdmin
 * @author   Vinicius Lucena
 */
class Paciente_model extends CI_Model {

    public $crm;
    public $cpf;
    public $nome_paciente;
    public $data_nas;
    public $email;
    public $endereco;
    public $telefone;
    public $especialidade;
    public $senha;
    public $usuario;

    private $allDoctors = array();

    public function __construct() {
        parent::__construct();
    }

    public function get_informacoes($username) {
        $condition = "usuario =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('paciente');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        $data = array();
        if ($query->num_rows() == 1) {
            foreach($query->result() as $row) {
                $data['cpf'] = $row->cpf;
                $data['nome'] = $row->nome;
                $data['data_nas'] = $row->data_nas;
                $data['email'] = $row->email;
                $data['endereco'] = $row->endereco;
                $data['telefone'] = $row->telefone;
                $data['usuario'] = $row->usuario;
            }

            return $data;
        } else {
            return false;
        }
    }

    public function get_agenda($usuario) {
        $this->db->select('data, horario, medico.nome AS nome_medico, clinica.nome AS nome_clinica');    
        $this->db->from('paciente');
        $this->db->join('consulta', 'paciente.cpf = consulta.cpf_paciente');
        $this->db->join('medico', 'medico.crm = consulta.crm_medico');
        $this->db->join('clinica', 'clinica.cnpj = consulta.cnpj_clinica');
        $this->db->where("paciente.usuario = '$usuario'");

        $query = $this->db->get();

        return $query;
    }

    public function get_lista_medicos($username) {
        $this->db->select("medico.nome AS nome_medico, medico.especialidade, clinica.nome AS nome_clinica");
        $this->db->from("paciente");
        $this->db->join("consulta", "paciente.cpf = consulta.cpf_paciente");
        $this->db->join("medico", "medico.crm = consulta.crm_medico");
        $this->db->join("clinica", "clinica.cnpj = consulta.cnpj_clinica");


        $query = $this->db->get();
        

        return $query;
    }

    public function get_todos_medicos() {
        $this->db->select("medico.nome AS nome_medico, medico.especialidade, clinica.nome AS nome_clinica");
        $this->db->from("medico");
        $this->db->join("medico_clinica", "medico_clinica.crm_medico = medico.crm");
        $this->db->join("clinica", "clinica.cnpj = medico_clinica.cnpj_clinica");

        $query = $this->db->get();

        return $query;
    }

    public function get_historico_consultas($username) {
        $this->db->select("consulta.data, consulta.diagnostico, consulta.receita, medico.nome AS nome_medico");
        $this->db->from("paciente");
        $this->db->join("consulta", "paciente.cpf = consulta.cpf_paciente");
        $this->db->join("medico", "medico.crm = consulta.crm_medico");
        $this->db->where("paciente.usuario = '$username'");
        $this->db->order_by("consulta.data", "ASC");

        $query = $this->db->get();

        return $query;
    }

    public function get_clinicas_por_nome_medico($nome_medico) {
        $this->db->select("clinica.nome AS nome_clinica_por_medico");
        $this->db->distinct();
        $this->db->from('medico');
        $this->db->join('medico_clinica', 'medico_clinica.crm_medico = medico.crm');
        $this->db->join('clinica', 'clinica.cnpj = medico_clinica.cnpj_clinica');
        $this->db->where("medico.nome = '$nome_medico'");

        $query = $this->db->get()->result_array();
        $queryMerged = array_merge($query, $this->get_todos_medicos()->result_array());

        return $queryMerged;
    }

    public function get_horarios_do_medico($nome_medico, $nome_clinica, $data_consulta) {
        $weekDay      = $this->get_week_day_by_date($data_consulta);
        $crm_medico   = $this->get_crm_doctor_by_name($nome_medico);
        $cnpj_clinica = $this->get_cnpj_clinic_by_name($nome_clinica);

        $columns = $weekDay."8,".$weekDay."9,".$weekDay."10,".$weekDay."11,".$weekDay."12,".$weekDay."13,".$weekDay."14,".$weekDay."15,".$weekDay."16,".$weekDay."17,".$weekDay."18";
        $this->db->select("$columns");
        $this->db->from('medico');
        $this->db->join('medico_clinica', "medico_clinica.crm_medico = medico.crm");
        $this->db->where("medico_clinica.cnpj_clinica = '$cnpj_clinica' AND medico_clinica.crm_medico = '$crm_medico'");

        $query = $this->db->get()->result_array();

        $queryMerged = array_merge($query, $this->get_clinicas_por_nome_medico($nome_medico));

        return ($queryMerged);
    }

    public function inserir_agendamento($cpf_paciente, $nome_medico, $nome_clinica, $data, $horario) {
        $crm_medico = $this->get_crm_doctor_by_name($nome_medico);
        $cnpj = $this->get_cnpj_clinic_by_name($nome_clinica);

        $dadosConsulta = array(
            'crm_medico'   => $crm_medico,
            'cpf_paciente' => $cpf_paciente,
            'horario'      => $horario,
            'data'         => $data,
            'cnpj_clinica' => $cnpj
        );

        $this->db->insert('consulta_pendente', $dadosConsulta);
    }

    private function get_week_day_by_date($data_consulta) {
        $convertWeekDay = array('Mon' => 'seg',
                                'Tue' => 'ter',
                                'Wed' => 'qua',
                                'Thu' => 'qui',
                                'Fri' => 'sex',
                                'Sat' => 'NaN',
                                'Sun' => 'NaN');
    
        return $convertWeekDay[date('D', strtotime($data_consulta))];
    }

    private function get_cnpj_clinic_by_name($nome_clinica) {
        $this->db->select('cnpj');
        $this->db->from('clinica');
        $this->db->where("nome LIKE '$nome_clinica'");

        $row = $this->db->get()->result()[0];

        if(isset($row)){
            
            return $row->cnpj;
        }
            
    }

    private function get_crm_doctor_by_name($nome_medico) {
        $this->db->select('crm');
        $this->db->from('medico');
        $this->db->where("nome LIKE '$nome_medico'");

        $query = $this->db->get();

        if($query->num_rows() > 0)
            $row = $query->result()[0];

        if(isset($row))
            return $row->crm;

    }

}

?>
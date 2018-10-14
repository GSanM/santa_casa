<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe para manipular o Banco de Dados referente as Consultas
 * 
 * @package  SistemAdmin
 * @author   Vinicius Lucena
 */
class Medico_model extends CI_Model {

    public $crm;
    public $cpf;
    public $nome;
    public $data_nas;
    public $email;
    public $endereco;
    public $telefone;
    public $especialidade;
    public $senha;
    public $usuario;

    public function __construct() {
        parent::__construct();
    }

    public function get_informacoes($username) {
        $condition = "usuario =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('medico');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            foreach($query->result() as $row) {
                $data['crm'] = $row->crm;
                $data['cpf'] = $row->cpf;
                $data['nome'] = $row->nome;
                $data['data_nas'] = $row->data_nas;
                $data['email'] = $row->email;
                $data['endereco'] = $row->endereco;
                $data['telefone'] = $row->telefone;
                $data['especialidade'] = $row->especialidade;
                $data['usuario'] = $row->usuario;
            }

            return $data;
        } else {
            return false;
        }
    }
    public function get_clinicas_por_medico($username) {
 
        $this->db->select('clinica.nome AS nome_clinica, clinica.endereco AS endereco_clinica, clinica.telefone AS telefone_clinica, clinica.nome_gerente');    
        $this->db->from('medico');
        $this->db->join('medico_clinica', 'medico.crm = medico_clinica.crm_medico');
        $this->db->join('clinica', 'clinica.cnpj = medico_clinica.cnpj_clinica');

        $query = $this->db->get();

        return $query;
    }

    public function get_horario_por_nome($nome) {
        $this->db->select('*');
        $this->db->from('medico');
        $this->db->join('medico_clinica', 'medico.crm = medico_clinica.crm_medico');

        return $this->db->get();
    }

    public function save_diagnostic($nome_paciente, $nome_medico, $nome_clinica, $horario, $data, $diagnostico) {
        $this->db->set('diagnostico', $diagnostico);
        
        $condition = array(
            'cpf_paciente' => $this->get_cpf_patient_by_name($nome_paciente),
            'crm_medico'   => $this->get_crm_doctor_by_name($nome_medico),
            'cnpj_clinica' => $this->get_cnpj_clinic_by_name($nome_clinica),
            'horario'      => $horario,
            'data'         => $data
        );
        $this->db->where($condition);
        $this->db->update('consulta');
    }

    public function save_receita($nome_paciente, $nome_medico, $nome_clinica, $horario, $data, $receita) {
        $this->db->set('receita', $receita);
        
        $condition = array(
            'cpf_paciente' => $this->get_cpf_patient_by_name($nome_paciente),
            'crm_medico'   => $this->get_crm_doctor_by_name($nome_medico),
            'cnpj_clinica' => $this->get_cnpj_clinic_by_name($nome_clinica),
            'horario'      => $horario,
            'data'         => $data
        );
        $this->db->where($condition);
        $this->db->update('consulta');
    }

    public function get_receita($nome_paciente, $nome_medico, $nome_clinica, $horario, $data) {
        $this->db->select('*');
        $this->db->from('consulta');
        
        $condition = array(
            'cpf_paciente' => $this->get_cpf_patient_by_name($nome_paciente),
            'crm_medico'   => $this->get_crm_doctor_by_name($nome_medico),
            'cnpj_clinica' => $this->get_cnpj_clinic_by_name($nome_clinica),
            'horario'      => $horario,
            'data'         => $data
        );

        $this->db->where($condition);

        $row = $this->db->get()->result()[0];

        if(isset($row))
            return $row->receita;

    }

    public function get_diagnostico($nome_paciente, $nome_medico, $nome_clinica, $horario, $data) {
        $this->db->select('diagnostico');
        $this->db->from('consulta');
        
        $condition = array(
            'cpf_paciente' => $this->get_cpf_patient_by_name($nome_paciente),
            'crm_medico'   => $this->get_crm_doctor_by_name($nome_medico),
            'cnpj_clinica' => $this->get_cnpj_clinic_by_name($nome_clinica),
            'horario'      => $horario,
            'data'         => $data
        );

        $this->db->where($condition);

        $row = $this->db->get()->result()[0];

        if(isset($row))
            return $row->diagnostico;
    }

    private function get_cnpj_clinic_by_name($nome_clinica) {
        $this->db->select('cnpj');
        $this->db->from('clinica');
        $this->db->where("nome LIKE '$nome_clinica'");

        $row = $this->db->get()->result()[0];

        if(isset($row))
            return $row->cnpj;
        
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

    private function get_cpf_patient_by_name($nome_paciente) {
        $this->db->select('cpf');
        $this->db->from('paciente');
        $this->db->where("nome LIKE '$nome_paciente'");

        $query = $this->db->get();

        if($query->num_rows() > 0)
            $row = $query->result()[0];

        if(isset($row))
            return $row->cpf;
    }

}

?>
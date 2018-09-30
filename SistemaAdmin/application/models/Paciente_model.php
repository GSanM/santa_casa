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

    public function get_agenda($cpf) {
        $this->db->select('data, horario, medico.nome AS nome_medico, clinica.nome AS nome_clinica');    
        $this->db->from('paciente');
        $this->db->join('consulta', 'paciente.cpf = consulta.cpf_paciente');
        $this->db->join('medico', 'medico.crm = consulta.crm_medico');
        $this->db->join('clinica', 'clinica.cnpj = consulta.cnpj_clinica');

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

    public function get_clinicas($username) {
        $this->db->select("medico.nome AS nome_medico, medico.especialidade, clinica.nome AS nome_clinica");
        $this->db->from("paciente");
        $this->db->join("consulta", "paciente.cpf = consulta.cpf_paciente");
        $this->db->join("medico", "medico.crm = consulta.crm_medico");
        $this->db->join("clinica", "clinica.cnpj = consulta.cnpj_clinica");
        $this->db->where("paciente.usuario = '$username'");

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

}

?>
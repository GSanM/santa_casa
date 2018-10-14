<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe para manipular o Banco de Dados referente as Consultas
 * 
 * @package  SistemAdmin
 * @author   Vinicius Lucena
 */
class Consulta_model extends CI_Model {

    public $crm_medico;
    public $cpf_paciente;
    public $horario;
    public $data;
    public $clinica;

    public function __construct() {
        parent::__construct();
    }

    public function get_consultas_por_medico($crm) {

        $this->db->select('consulta.data, consulta.horario, paciente.nome AS nome_paciente, clinica.nome AS nome_clinica');
        $this->db->from('consulta');
        $this->db->join('paciente', 'consulta.cpf_paciente = paciente.cpf');
        $this->db->join('clinica', 'clinica.cnpj = consulta.cnpj_clinica');

        $this->db->order_by('data','ASC');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        }
 
        else {
            return false;
        }
    }

    public function get_pacientes_por_medico($crm) {

        $this->db->select('paciente.nome AS nome_paciente, clinica.nome AS nome_clinica');
        $this->db->from('consulta');
        $this->db->join('paciente', 'consulta.cpf_paciente = paciente.cpf');
        $this->db->join('clinica', 'clinica.cnpj = consulta.cnpj_clinica');

        $this->db->order_by('nome_paciente','ASC');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        }
 
        else {
            return false;
        }
    }

}

?>
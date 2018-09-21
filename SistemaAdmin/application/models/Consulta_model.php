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

        $this->db->select('consulta.data, consulta.horario, paciente.nome_paciente, clinica.nome_clinica');
        $this->db->from('consulta');
        $this->db->join('paciente', 'consulta.cpf_paciente = paciente.cpf');
        $this->db->join('clinica', 'clinica.cnpj = consulta.clinica');

        $this->db->order_by('data','ASC');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;

            /*
            foreach ($query->result() as $row) {
                echo "<br>-----------<br>";
                echo "crm: ". $row->crm_medico;
                echo "<br>";
                echo "cpf: ". $row->cpf_paciente;
                echo "<br>-----------<br>";
            }
            */
        }
 
        else {
            return false;
        }
    }

}

?>
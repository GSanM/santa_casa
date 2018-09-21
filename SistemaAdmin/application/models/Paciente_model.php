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
            return $query->result();
        } else {
            return false;
        }
    }

}

?>
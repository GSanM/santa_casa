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
    public $nome_medico;
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
                $data['nome_medico'] = $row->nome_medico;
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

}

?>
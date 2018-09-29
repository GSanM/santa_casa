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
}

?>
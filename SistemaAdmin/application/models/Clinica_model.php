<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe para manipular o Banco de Dados referente as Clinicas
 * 
 * @package  SistemAdmin
 * @author   Vinicius Lucena
 */
class Clinica_model extends CI_Model {

    public $nome_clinica;
    public $nome_gerente;
    public $cpf_gerente;

    public function __construct() {
        parent::__construct();
    }


    /**
     * Método para inserir uma nova Clinica no Banco
     * 
     * @return void
      */
    public function inserir_registro() {
        $this->nome_clinica = $_POST['txtNomeClinica'];
        $this->nome_gerente = $_POST['txtNomeGerente'];
        $this->cpf_gerente  = $_POST['cpfGerente'];

        $this->db->insert('clinica', $this);
    }

    /**
     * Método para acessar e retornar toda a Tabela de Clinicas
     * 
     * @return tabela_clinicas
      */
    public function get_todas_clinicas() {
        $query = $this->db->get('clinica'); 
        return $query->result();
    }

}

?>
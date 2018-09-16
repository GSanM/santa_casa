<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe para manipular o Banco de Dados referente as Clinicas
 * 
 * @package  SistemAdmin
 * @author   Vinicius Lucena
 */
class Clinica_model extends CI_Model {

    public $nome;
    public $nome_gerente;
    public $cnpj;
    public $endereco;
    public $telefone;

    public function __construct() {
        parent::__construct();
    }


    /**
     * Método para inserir uma nova Clinica no Banco
     * 
     * @return void
      */
    public function inserir_registro() {
        $this->nome         = $_POST['txtNomeClinica'];
        $this->nome_gerente = $_POST['txtNomeGerente'];
        $this->cnpj         = $_POST['cnpj'];
        $this->endereco     = $_POST['endereco'];
        $this->telefone     = $_POST['telefone'];

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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Cadastro
 *
 * Esta classe gerencia as funções de Cadastro
 *
 * @package		SistemaAdmin
 * @author		Vinicius Lucena
 */
class Cadastro extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Método para chamar a View 'Index'
	 * 
	 * @return void 
	  */
	public function index() {
		$this->load->view('admin/cadastro');
	}

	/**
	 * Método para chamar validar os dados do formulário de preenchimento de 
	 * cadastro de uma nova Clinica e inserir informações no Banco.
	 * 
	 * @return void 
	  */
	public function cadastrar_clinica() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules("txtNomeClinica", "Nome da Clinica", "required");
		$this->form_validation->set_rules("txtNomeGerente", "Nome do Gerente", "required");
		$this->form_validation->set_rules("cnpj", "CNPJ", "required");
		$this->form_validation->set_rules("endereco", "Endereco", "required");
		$this->form_validation->set_rules("telefone", "Telefone", "required");

		if($this->form_validation->run() == FALSE) {
			$this->index();
			return;
		}
	
		$this->load->model('Clinica_model');
		
		$this->Clinica_model->inserir_registro();

		// Duplicar os arquivos


		
		// Chamando a View de cadastro realizado com sucesso
		$this->cadastrado_sucesso();
	}

	/**
	 * Método para chamar a View de 'Cadastrado com sucesso'
	 * 
	 */
	public function cadastrado_sucesso() {
		$this->load->view('admin/cadastrado_sucesso');
	}
}

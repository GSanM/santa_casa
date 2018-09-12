<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * Controlador padrao da aplicacao
     * 
	 */
class Listagem extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->model('Clinica_model');
		$dados['resultado'] = $this->Clinica_model->get_todas_clinicas();

		$this->load->view('listagem', $dados);
	}

}

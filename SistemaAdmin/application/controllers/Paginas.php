<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * Controlador padrao da aplicacao
     * 
	 */
class Paginas extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('index');
	}

	public function cadastro() {
		$this->load->view('cadastro');
	}

	public function listagem() {
		$this->load->view('cadastro');
	}

	public function edicao() {
		$this->load->view('cadastro');
	}

	public function exclusao() {
		$this->load->view('cadastro');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Consulta_model");
	}
	
	public function index() {

		if (session_status() == PHP_SESSION_NONE) {
            $this->load->view('login');
            return;
        }
        
        $dados_consulta['query'] = $this->Consulta_model->get_pacientes_por_medico($this->session->userdata('crm'));

		$this->load->view('medico/pacientes', $dados_consulta);

	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Consulta_model');
        $this->load->model('Paciente_model');
	}

	public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            $this->load->view('login');
            return;
        }

        $dados_consulta['query'] = $this->Paciente_model->get_agenda($this->session->userdata('usuario'));

		$this->load->view('paciente/agenda', $dados_consulta);
	}

}

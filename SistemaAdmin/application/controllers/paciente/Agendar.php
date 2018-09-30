<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Paciente_model");
    }

	public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            $this->load->view('login');
            return;
        }

        $dados['query'] = $this->Paciente_model->get_lista_medicos($_SESSION['usuario']);

        $this->load->view('paciente/agendar', $dados);
        
	}
}

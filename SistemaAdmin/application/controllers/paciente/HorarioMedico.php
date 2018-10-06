<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HorarioMedico extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Medico_model');
	}

	public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            $this->load->view('login');
            return;
        }

        $dados['query'] = $this->Medico_model->get_horario_por_nome($_SESSION['nome_medico']);

        //print_r($dados['query']->result());

		$this->load->view('paciente/horariomedico', $dados);
	}

}

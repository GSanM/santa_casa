<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendar extends CI_Controller {
    private $query;

    public function __construct() {
        parent::__construct();
        $this->load->model("Paciente_model");
    }

	public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            $this->load->view('login');
            return;
        }

        $dados['queryMedicos'] = $this->Paciente_model->get_todos_medicos()->result_array();

        $this->load->view('paciente/agendar', $dados);
        
    }
    
    public function envio() {
        if (session_status() == PHP_SESSION_NONE) {
            $this->load->view('login');
            return;
        }
        print_r($_POST);

        $naoDigitouNomeClinica = $_POST['iClinica'] == "" ? 1:0;
        $naoDigitouHorario = $_POST['iHorario'] == "" ? 1:0;

        if($naoDigitouHorario and $naoDigitouNomeClinica)
            $dados['query'] = $this->Paciente_model->get_clinicas_por_nome_medico($_POST['iMedico']);
        elseif($naoDigitouHorario)
            $dados['query'] = $this->Paciente_model->get_horarios_do_medico();
        else {
            // inserir consulta
            echo "";
        }
        $this->load->view('paciente/agendar', $dados);
    }
}

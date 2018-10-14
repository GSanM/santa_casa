<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitar extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Medico_model");
	}
	
	public function index() {

		if (session_status() == PHP_SESSION_NONE) {
            $this->load->view('login');
            return;
        }

        $nome_paciente = $_GET['nome_paciente'];
        $nome_medico   = $_SESSION['nome'];
        $nome_clinica  = $_GET['nome_clinica'];
        $horario       = $_GET['horario'];
        $data          = $_GET['data'];

        //$receita     = $this->Medico_model->get_receita($nome_paciente, $nome_medico, $nome_clinica, $horario, $data);
        //$diagnostico = $this->Medico_model->get_diagnostico($nome_paciente, $nome_medico, $nome_clinica, $horario, $data);

    
        $dados = array(
            'nome_paciente' => $_GET['nome_paciente'],
            'nome_medico'   => $_SESSION['nome'],
            'nome_clinica'  => $_GET['nome_clinica'],
            'horario'       => $_GET['horario'],
            'data'          => $_GET['data'],
            'receita'       => '',
            'diagnostico'   => ''
        );



		$this->load->view('medico/receitar', $dados);
        
    }

    public function salvar_receita() {
        $this->Medico_model->save_receita($_POST['nome_paciente'], $_POST['nome_medico'], $_POST['nome_clinica'], $_POST['horario'], $_POST['data'], $_POST['iReceita']);
        $this->Medico_model->save_diagnostic($_POST['nome_paciente'], $_POST['nome_medico'], $_POST['nome_clinica'], $_POST['horario'], $_POST['data'], $_POST['iDiagnostico']);

        $this->load->view('medico/receitado_sucesso');
    }

}
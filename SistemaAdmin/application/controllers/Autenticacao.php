<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe responsável pelo Controle da autenticacao do usuario
 */
class Autenticacao extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('loginDatabaseAdmin_model');
        $this->load->model('loginDatabaseMedico_model');
        $this->load->model('loginDatabasePaciente_model');
        
    }

	public function index() {
		$this->load->view('login');
    }
    
    public function autenticar() {
        // carregando as regras de validacao
        $this->form_validation->set_rules('username', 'Usuário', 'trim|required');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
            return;
        } 

        $data = array ( 'usuario' => $this->input->post('username'),
                        'senha'   => $this->input->post('password'));

        $usuarioLogadoComo = $this->input->post('option');

        if($usuarioLogadoComo == "admin")
            $result = $this->loginDatabaseAdmin_model->login($data);
        
        else if ($usuarioLogadoComo == "medico") 
            $result = $this->loginDatabaseMedico_model->login($data);
        
        else 
            $result = $this->loginDatabasePaciente_model->login($data);
        


        if ($result == FALSE) {
            $data = array( 'mensagem_erro' => 'Nome ou e-mail inválidos');
            $this->load->view('login', $data);
            return;
        }
        
        $username = $this->input->post('username');
        
  

        $session_data = array('logadoComo' => $usuarioLogadoComo);

        // Adicionar dados do usuario na Session
        $this->session->set_userdata('logged_in', $session_data);

        if($usuarioLogadoComo == "admin")
            $this->load->view('index');

        else if ($usuarioLogadoComo == "medico")
            $this->load->view('medico');

        else
            $this->load->view('paciente');
    
    }

    public function logout() {
        // Removendo os dados da Session
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Logout realizado com sucesso.';
        $this->load->view('login', $data);
    }
    

}

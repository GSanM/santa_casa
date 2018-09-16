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
        $this->load->model('login_database');
        
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
                        
        $result = $this->login_database->login($data);

        if ($result == FALSE) {
            $data = array( 'mensagem_erro' => 'Nome ou e-mail inválidos');
            $this->load->view('login', $data);
            return;
        }
        
        $username      = $this->input->post('username');
        $dados_usuario = $this->login_database->read_user_information($username);
        
        if ($dados_usuario == FALSE) {
            return;
        }

        $session_data = array('usuario' => $dados_usuario[0]->usuario);

        // Adicionar dados do usuario na Session
        $this->session->set_userdata('logged_in', $session_data);
        $this->load->view('index');
    
        
        
    }

    public function logout() {
        // Removendo os dados da Session
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Logout realizado com sucesso.';
        $this->load->view('login', $data);
    }
    

}

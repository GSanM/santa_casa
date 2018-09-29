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
        $this->load->model('Medico_model');
        $this->load->model('Paciente_model');
        $this->load->model('Consulta_model');
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
        
        else if ($usuarioLogadoComo == "paciente") 
            $result = $this->loginDatabasePaciente_model->login($data);
        


        if ($result == FALSE) {
            $data = array( 'mensagem_erro' => 'Nome ou e-mail inválidos');
            $this->load->view('login', $data);
            return;
        }
        
        $username = $this->input->post('username');


        if($usuarioLogadoComo == "admin") {
            $this->load->view('admin/index');
        }
        else if ($usuarioLogadoComo == "medico") {

            $dados_usuario = $this->Medico_model->get_informacoes($username);
            $dados_usuario['logged_in'] = TRUE;

            // Adicionar dados do usuario na Session
            $this->session->set_userdata($dados_usuario);

            $this->load->view('medico/index', $dados_usuario);
        } 
        else if ($usuarioLogadoComo == "paciente") { 
            
            $dados_usuario['logged_in'] = TRUE;
            $dados_usuario = $this->Paciente_model->get_informacoes($username);
            $dadosAgendaDoUsuario['query'] = $this->Paciente_model->get_agenda($username);

            // Adicionar dados do usuario na Session
            $this->session->set_userdata($dados_usuario);
            $this->load->view('paciente/agenda', $dadosAgendaDoUsuario);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $data['message_display'] = 'Logout realizado com sucesso.';
        $this->load->view('login', $data);
    }
    

}

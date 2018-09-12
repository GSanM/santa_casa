<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador do Login
 * 
 */
class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('login');
    }
    
    public function verificar() {
        $usuario = $_POST['username'];
        $senha   = $_POST['password'];

        if($usuario == 'admin' && $senha == 'admin') {
            
            $this->load->view('index');
        } else {
            header(base_url(''));
            $dados['mensagem'] = "Usuário ou Senha inválidos";
            $this->load->view('login', $dados);
        }
    }
}

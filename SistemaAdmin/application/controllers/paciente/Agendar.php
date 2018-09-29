<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendar extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

	public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            $this->load->view('login');
            return;
        }
        
		$this->load->view('paciente/agendar');
	}
}

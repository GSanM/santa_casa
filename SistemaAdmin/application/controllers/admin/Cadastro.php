<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once "simple_html_dom.php";
/**
 * Controlador de Cadastro
 *
 * Esta classe gerencia as funções de Cadastro
 *
 * @package		SistemaAdmin
 * @author		Vinicius Lucena
 */
class Cadastro extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Método para chamar a View 'Index'
	 * 
	 * @return void 
	  */
	public function index() {
		$this->load->view('admin/cadastro');
	}

	/**
	 * Método para chamar validar os dados do formulário de preenchimento de 
	 * cadastro de uma nova Clinica e inserir informações no Banco.
	 * 
	 * @return void 
	  */
	public function cadastrar_clinica() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules("txtNomeClinica", "Nome da Clinica", "required");
		$this->form_validation->set_rules("txtNomeGerente", "Nome do Gerente", "required");
		$this->form_validation->set_rules("cnpj", "CNPJ", "required");
		$this->form_validation->set_rules("endereco", "Endereco", "required");
		$this->form_validation->set_rules("telefone", "Telefone", "required");

		if($this->form_validation->run() == FALSE) {
			$this->index();
			return;
		}
	
		$this->load->model('Clinica_model');
		
		$this->Clinica_model->inserir_registro();

		// Duplicar os arquivos
		$nomeDaClinica = $_POST['txtNomeClinica'];
		$nomeDaClinicaSemEspaco = str_replace(" ", "_", $_POST['txtNomeClinica']);
		$source = getcwd() . "/template/";
		$dest   = getcwd() . "/$nomeDaClinicaSemEspaco/"; 

		$dest   = str_replace("/SistemaAdmin", "", $dest);
		$source = str_replace("/SistemaAdmin", "", $source);
		
		if($this->xcopy($source, $dest)) {
			$source = str_replace("/template/", "", $source);
			$caminhoAteOArquivo = "$source/$nomeDaClinicaSemEspaco/front/index.html";
		
			$this->change_name($caminhoAteOArquivo, $nomeDaClinica);

			// chama a página que mostra "clinica cadastrada com sucesso"
			$this->cadastrado_sucesso();
		}

	}

	// Muda nome da clínica, porém, "desformata" o arquivo html
	private function change_name($caminhoAteOArquivo, $nomeDaClinica) {

		$html = str_get_html(file_get_contents($caminhoAteOArquivo));
	
		$html->find('h1', 0)->innertext = $nomeDaClinica;
		file_put_contents($caminhoAteOArquivo, $html);
	}




	/**
	 * Método para chamar a View de 'Cadastrado com sucesso'
	 * 
	 */
	public function cadastrado_sucesso() {
		$this->load->view('admin/cadastrado_sucesso');
	}

		/**
	 * Copy a file, or recursively copy a folder and its contents
	 * @author      Aidan Lister <aidan@php.net>
	 * @version     1.0.1
	 * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
	 * @param       string   $source    Source path
	 * @param       string   $dest      Destination path
	 * @param       int      $permissions New folder creation permissions
	 * @return      bool     Returns true on success, false on failure
	 */
	private function xcopy($source, $dest, $permissions = 0755) {
		// Check for symlinks
		if (is_link($source)) {
			return symlink(readlink($source), $dest);
		}

		// Simple copy for a file
		if (is_file($source)) {
			return copy($source, $dest);
		}

		// Make destination directory
		if (!is_dir($dest)) {
			mkdir($dest, $permissions);
		}

		// Loop through the folder
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			// Skip pointers
			if ($entry == '.' || $entry == '..') {
				continue;
			}

			// Deep copy directories
			$this->xcopy("$source/$entry", "$dest/$entry", $permissions);
		}

		// Clean up
		$dir->close();
		return true;
	}
}

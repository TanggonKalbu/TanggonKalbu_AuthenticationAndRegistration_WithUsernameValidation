<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index(){
		$this->load->view('register');	
	}

	public function createaccount(){
		$this->load->helper('url','form');	
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules('username','Username','trim|required|callback_cekDB');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->load->model('uts_model');
		
		if($this->form_validation->run()==FALSE){
			$this->load->view('register');
		}else{

				$this->uts_model->insertAccount();
				$this->load->view('register_sukses');
		}
	}

	public function cekDB(){
		$this->load->model('user');
		
		$username = $this->input->post('username');
		$result = $this->user->register($username);
		if($result){
			$this->form_validation->set_message('cekDB',"Register Gagal! Username Sudah Terpakai!");
			return false;
		}
		else{
			return true;
		}
	}	
}

/* End of file Anak.php */
/* Location: ./application/controllers/Anak.php */
 ?>
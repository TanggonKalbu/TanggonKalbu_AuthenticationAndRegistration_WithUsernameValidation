<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenishero extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
		}else{
			redirect('login','refresh');
		}	
		
	}
	public function index()
	{
		$this->load->model('uts_model');
		$data["jenisHero_list"] = $this->uts_model->getJenisHero();
		$this->load->view('jenishero',$data);	
	}

	public function createJenis(){
		$this->load->helper('url','form');	
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules('keterangan','Keterangan','trim|required');
		$this->load->model('uts_model');	
		
		if($this->form_validation->run()==FALSE){
			$this->load->view('tambah_jenis_view');
		}else{

				$this->uts_model->insertJenisHero();
				$this->load->view('tambah_jenis_sukses');
		}
	}

	public function deleteJenis($idJenis){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->load->model('uts_model');
		
		$this->uts_model->deleteById($idJenis);
		if($this->form_validation->run()==FALSE){
			redirect('jenishero');
		}
	}

	public function updateJenis($idJenis){
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('keterangan','Keterangan','trim|required');
		$this->load->model('uts_model');

		$data['jenis_hero']=$this->uts_model->getJenisHeroByID($idJenis);

		if($this->form_validation->run()==FALSE){
			$this->load->view('edit_jenis_view',$data);
		}
		else{
			$this->uts_model->updateJenisById($idJenis);
			$this->load->view('edit_jenis_sukses');
		}
	}

	
	//method update butuh parameter id berapa yang akan di update
	

	
}


/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>
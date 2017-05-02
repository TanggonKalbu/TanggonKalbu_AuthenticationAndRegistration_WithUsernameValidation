<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uts_model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getJenisHero()
		{
			$this->db->select("id,keterangan");
			$query = $this->db->get('jenis_hero');
			return $query->result();
		}
		public function getHeroById($idHero)
		{
			$this->db->select("id,nama,tanggal_lahir,foto");
			$this->db->where('id', $idHero);
			$query = $this->db->get('hero');
			return $query->result();
		}


		public function getHeroByJenis($idJenis)
		{
			$this->db->select("jenis_hero.keterangan as keteranganJenis, nama, DATE_FORMAT(tanggal_lahir,'%d-%m-%Y') as tanggalLahir, foto, hero.id");
			$this->db->where('fk_jenis', $idJenis);	
			$this->db->join('jenis_hero', 'jenis_hero.id = hero.fk_jenis', 'left');	
			$query = $this->db->get('hero');
			return $query->result();
		}
		


		public function insertJenisHero()
		{
			$object = array(
				'keterangan' => $this->input->post('keterangan') );
			$this->db->insert('jenis_hero', $object);
		}

		public function getJenisHeroById($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('jenis_hero',1);
			return $query->result();
		}

		public function updateJenisById($id){
			$data = array(
				'keterangan' => $this->input->post('keterangan'));
			$this->db->where('id', $id);
			$this->db->update('jenis_hero', $data);
		}

		

		public function deleteById($id)
		{
			$this -> db -> where('fk_jenis', $id);
  			$this -> db -> delete('hero');
			
			$this -> db -> where('id', $id);
  			$this -> db -> delete('jenis_hero');

  			

		}
		public function insertHero($idJenis)
		{	
			$object = array(
				'nama' => $this->input->post('nama'), 
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'foto' => $this->upload->data('file_name'),
				'fk_jenis'=> $idJenis
				);
			$this->db->insert('hero', $object);
		}
		public function updateHero($idJenis)
		{	
			$object = array(
				'nama' => $this->input->post('nama'), 
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'foto' => $this->upload->data('file_name'),
				);
			$this->db->where('id', $idJenis);
			$this->db->update('hero', $object);
		}
		
		public function deleteHero($idHero){
			$this -> db -> where('id', $idHero);
  			$this -> db -> delete('hero');
		}

		public function insertAccount(){
			$password = $this->input->post('password');
			$object = array(
				'username' => $this->input->post('username'),
				'password' => md5($password)
				 );
			$this->db->insert('akun', $object);
		}


}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function login ($username,$password){
		$this->db->select('id,username,password');
		$this->db->from('akun');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$query = $this->db->get();
		if ($query->num_rows()>=1) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function register($username){
		$this->db->select('id,username,password');
		$this->db->from('akun');
		$this->db->where('username', $username);
		$query = $this->db->get();
		if ($query->num_rows()>=1) {
			return $query->result();
		}else{
			return false;
		}	
	}

}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>
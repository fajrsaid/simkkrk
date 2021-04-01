<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('login');
	}

	function aksi_login(){
		$username 	= $this->input->post('username');
		$password 	= MD5($this->input->post('password'));

		$query_dsn	= "SELECT
							*
						FROM
							dosen
						LEFT JOIN roles ON roles.nip = dosen.nip
						WHERE
						username = '$username' AND password = '$password'
						";
		$cek_dosen 	= $this->db->query($query_dsn);

		$query_mhs	= "SELECT
							*
						FROM
							mahasiswa
						LEFT JOIN roles ON roles.nim = mahasiswa.nim
						WHERE
							mahasiswa.username = '$username' AND password = '$password'
						";
		$cek_mhs 	= $this->db->query($query_mhs);

		$query_lab	= "SELECT
							*
						FROM
							laboratorium
						LEFT JOIN roles ON roles.id_laboratorium = laboratorium.id_laboratorium
						WHERE
						laboratorium.username = '$username' AND laboratorium.password = '$password'
						";
		$cek_lab 	= $this->db->query($query_lab);
		
		$row_lab 	= $cek_lab->row_array();
		$row_dosen 	= $cek_dosen->row_array();
		$row_mhs 	= $cek_mhs->row_array();

		if($cek_dosen->num_rows()>=1){
			$data_session = array(
				'nip' 				=> $row_dosen['nip'],
				'nidn' 				=> $row_dosen['nidn'],
				'nama_awal' 		=> $row_dosen['nama_awal'],
				'nama_akhir' 		=> $row_dosen['nama_akhir'],
				'kode_dosen' 		=> $row_dosen['kode_dosen'],
				'alamat' 			=> $row_dosen['alamat'],
				'jenis_kelamin' 	=> $row_dosen['jenis_kelamin'],
				'telp' 				=> $row_dosen['telp'],
				'blog' 				=> $row_dosen['blog'],
				'id_bidang' 		=> $row_dosen['id_bidang'],
				'username' 			=> $row_dosen['username'],
				'password' 			=> $row_dosen['password'],
				'email' 			=> $row_dosen['email'],
				'user_role' 		=> $row_dosen['user_role_id'],
				'jab_fungsional' 	=> $row_dosen['id_jabatan'],
				'jab_struktural' 	=> $row_dosen['jab_struktural'],
				'jab_pangkat' 		=> $row_dosen['jab_pangkat'],
				'jab_golongan' 		=> $row_dosen['jab_golongan']
			);
			$this->session->set_userdata($data_session);
			redirect(site_url('home'));
			
			
		}elseif ($cek_mhs->num_rows()>=1) {
			$data_session1 = array(
				'nim' 			=> $row_mhs['nim'],
				'username' 		=> $row_mhs['username'],
				'email' 		=> $row_mhs['email'],
				'nama_awal' 	=> $row_mhs['nama_awal'],
				'nama_akhir' 	=> $row_mhs['nama_akhir'],
				'password' 		=> $row_mhs['password'],
				'id_status' 	=> $row_mhs['id_status'],
				'user_role' 	=> $row_mhs['user_role_id']
				);
 
			$this->session->set_userdata($data_session1);
			redirect(base_url('home'));
		}elseif ($cek_lab->num_rows()>=1){
			$data_session2 =array(
				'id_laboratorium' 	=> $row_lab['id_laboratorium'],
				'nama_awal' 		=> $row_lab['nama_laboratorium'],
				'nama_kordas' 		=> $row_lab['nama_kordas'],
				'username' 			=> $row_lab['username'],
				'password' 			=> $row_lab['password'],
				'user_role' 		=> $row_lab['user_role_id']
				);
			$this->session->set_userdata($data_session2);
			redirect(base_url('home')); 
		}
		
		else{
			$this->session->set_flashdata('alert_gagal', 'Username atau password salah !');
			redirect(site_url('login'));
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(site_url('login'));
	}

	
	
}

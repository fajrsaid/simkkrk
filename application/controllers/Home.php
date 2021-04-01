<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct()
    {
		parent::__construct();
		// if (empty($this->session->userdata('username'))) {
		// 	redirect(site_url("login"));
		}
	public function index()
	{
		$this->load->model("m_pengumuman");
		$data['list_pengumuman'] = $this->m_pengumuman->load_pengumuman();

		$this->load->view('home', $data);
	}
}

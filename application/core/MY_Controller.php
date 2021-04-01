<?php

class MY_Controller extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		if (empty($this->session->userdata('username'))) {
			redirect(site_url("login"));
		}
		$this->load->model('m_akun');
		$this->data['getUserRole'] = $this->m_akun->getUserRole();

		// $this->load->view('_partials/sidebar.php', $data);

	}


}

?>

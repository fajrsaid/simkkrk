<?php 
    if ($this->session->userdata("user_role") == 1) {
        $this->load->view("_partials/sidebar_kk.php");
    }elseif ($this->session->userdata("user_role") == 2) {
        $this->load->view("_partials/sidebar_dsn.php");
    }elseif ($this->session->userdata("user_role") == 3) {
        $this->load->view("_partials/sidebar_mhs.php");
    }elseif ($this->session->userdata("user_role") == 4) {
        $this->load->view("_partials/sidebar_admin.php");
    }elseif ($this->session->userdata("user_role") == 51) {
		    $this->load->view("_partials/sidebar_dsnlab.php");
    }elseif ($this->session->userdata("user_role") == 7) {
		    $this->load->view("_partials/sidebar_lbrn.php");
    }elseif ($this->session->userdata("user_role") == 80) {
		    $this->load->view("_partials/sidebar_pkip.php");
    }elseif ($this->session->userdata("user_role") == 8) {
        $this->load->view("_partials/sidebar_lab.php");
    }
?>
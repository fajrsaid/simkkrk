<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PKIP extends MY_Controller
{
    public function index(){
        $this->load->model("m_pengumuman");
        $data['list_pengumuman'] = $this->m_pengumuman->load_pengumuman();
        $this->load->view('pkip/v_home', $data);
    }
    
    public function daftarjudul(){
            $this->load->model("m_pkip");
            $data['list_judulsiap'] = $this->m_pkip->load_judulsiapseminar();
            
            $this->load->view('pkip/v_datajudulmahasiswa', $data);
    }

    public function daftarprosesjudul(){
            $this->load->model("m_pkip");
            $data['list_prosesjudul'] = $this->m_pkip->load_prosesjudul();
            $data['list_judulproposalta'] = $this->m_pkip->load_judulproposalta();
            $this->load->view('pkip/v_prosesjudul', $data);
    }

    public function daftardosbing(){
            $this->load->model("m_pkip");
            $data['list_datadosbing'] = $this->m_pkip->load_dosen();
            $this->load->view('pkip/v_datadosbing', $data);
    }

    public function inputjadwalseminar($id_judul){
        $this->load->model("m_pkip");

        $data['list_judulseminar'] = $this->m_pkip->selectjudul($id_judul);
        $data['list_dosen'] = $this->m_pkip->load_dosen();
        $data['list_ruangan'] = $this->m_pkip->getRuanganSeminar();
        if(isset($_POST['btnSimpanJadwal'])){
            $this->m_pkip->simpanjadwal($_POST, $id_judul);
            redirect("pkip");
        }
        $data['default'] = $this->m_pkip->get_default($id_judul);
        $this->load->view("pkip/v_inputjadwalseminar",$data);
    }

    
     
    public function inputjadwalseminarXXX(){
            $this->load->model("m_pkip");
            $data['list_judulseminar'] = $this->m_pkip->load_judulseminar();
            $data['list_dosen'] = $this->m_pkip->load_dosen();
            $this->load->view('pkip/v_inputjadwalseminar', $data);
    } 

    public function jadwalseminar(){
        $this->load->model("m_pkip");
        $data['list_jadwalujian'] = $this->m_pkip->load_jadwal();
        $this->load->view("pkip/v_datajadwalmahasiswa",$data);
    }

    public function reject($id_judul){
            $this->load->model("m_pkip");
            $data['list_seminarulang'] = $this->m_pkip->load_seminarulang($id_judul);

            $this->session->set_flashdata('alert_tolak', 'Anda telah menolak pengajuan');
            redirect (base_url("/pkip/jadwalseminar"));
        }

    public function acceptlulus($id_judul){
            $this->db->query("UPDATE t_judul, t_jadwal, mahasiswa SET t_jadwal.id_status = 51 WHERE t_judul.nim = mahasiswa.nim AND t_jadwal.id_judul = ".intval($id_judul));
            $this->db->query("UPDATE t_judul, t_jadwal, mahasiswa SET mahasiswa.id_status = 51 WHERE t_judul.nim = mahasiswa.nim AND t_jadwal.id_judul = ".intval($id_judul));
            $this->db->query("UPDATE t_judul, t_jadwal, mahasiswa SET t_judul.id_status = 51 WHERE t_judul.nim = mahasiswa.nim  AND t_jadwal.id_judul = ".intval($id_judul));

            $this->session->set_flashdata('alert_setuju', 'Anda telah menyetujui pengajuan');
            redirect (base_url("/pkip/jadwalseminar"));
        }




    public function validasiRuangan($waktuujian)
    {
        $this->load->model("m_pkip");
            $data = $this->m_pkip->validasiRuangan($waktuujian);
            header('Content-Type: application/json');
            echo json_encode($data);
    }


}
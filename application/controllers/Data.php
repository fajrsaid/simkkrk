<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class data extends MY_Controller
{
    public function index(){
        $this->load->model("m_dosbing");
        $data['list_topik'] = $this->m_dosbing->load_topik();
        $data1 = $this->m_dosbing->get_data()->result();
        $x['data1'] = json_encode($data1);
        // $this->load->view('chart_view',$x);
        $this->load->view("dosen/v_datajudul",$data,$x);
    }

    public function daftardosbing(){
        $this->load->model("m_datadosbing");
        $data['list_datadosbing'] = $this->m_datadosbing->load_datadosbing();
        $this->load->view("dosen/v_datadosbing",$data);
    }

    public function jadwalseminar(){
        $this->load->model("m_dosbing");
        $data['list_jadwal'] = $this->m_dosbing->load_jadwal();
        $this->load->view("dosen/v_datajadwalmahasiswa",$data);
    }

    public function inputTopik()
    {
        $this->load->model("m_dosbing");
        $data['list_bidang'] = $this->m_dosbing->load_bidang();
        //$data['detail_dosbing'] = $this->m_dosbing->selectDobing($nip);

        if(isset($_POST['btnSimpanTopik'])){
            $this->load->model("m_dosbing");
            $this->m_dosbing->SimpanTopik($_POST);
            redirect("data");
        }
        $this->load->view('dosen/v_inputjudul', $data);
    }

    public function get_default($idta){
        $sql = $this->db->query("SELECT * FROM t_topik WHERE idta = ".intval($idta));
        if($sql->num_rows() > 0)
            return $sql->row_array();
        return false;
    }


    public function edit($idta){
        $this->load->model("m_dosbing");

        $data['list_bidang'] = $this->m_dosbing->load_bidang();
        $data['tipe'] = "Edit";
        if(isset($_POST['tombol_submit'])){
            $this->m_dosbing->update($_POST, $idta);
            redirect("data");
        }
        $data['default'] = $this->m_dosbing->get_default($idta);
        $this->load->view("dosen/v_updatejudul",$data);
    }
    public function delete($idta){
        $this->load->model("m_dosbing");
        $this->m_dosbing->hapus($idta);
        redirect("data");
    }


    public function pengajuanTopik(){
            $this->load->model("m_dosbing");
            $data['list_TopikPropose'] = $this->m_dosbing->load_TopikPropose();

            $this->load->view('dosen/v_pengajuantopik', $data);
        }

    public function pengajuanpembimbing(){
            $this->load->model("m_dosbing");
            $data['list_TopikPropose2'] = $this->m_dosbing->load_TopikPropose2();

            $this->load->view('dosen/v_pengajuanpembimbing', $data);
        }
    
    public function topikdisetujui(){
            $this->load->model("m_dosbing");
            $data['list_topikdisetujui'] = $this->m_dosbing->load_topikdisetujui();
            
            $this->load->view('dosen/v_topikditerima', $data);
        }   


    public function prosespengerjaan(){
            //$nip = $this->session->userdata("nip");
            $this->load->model("m_dosbing");
            $data['list_juduldikerjakan'] = $this->m_dosbing->load_juduldikerjakan();

            $this->load->view('dosen/v_prosespengerjaan', $data);
        }

     public function prosesproposal(){
            //$nip = $this->session->userdata("nip");
            $this->load->model("m_dosbing");
            $data['list_judulproposalta'] = $this->m_dosbing->load_judulproposalta();

            $this->load->view('dosen/v_prosesproposal', $data);
        }

    public function prosesproposal2(){
            //$nip = $this->session->userdata("nip");
            $this->load->model("m_dosbing");
            $data['list_judulproposalta2'] = $this->m_dosbing->load_judulproposalta2();

            $this->load->view('dosen/v_prosesproposal2', $data);
        }


    public function detailtopik($idta){
            $this->load->model("m_dosbing");
            $data['data_topik'] = $this->m_dosbing->selecttopik($idta);

            $this->load->view('dosen/v_topikditerima', $data);
        }

    public function detailjudulta($id_judul){
            $this->load->model("m_dosbing");
            $data['data_judulta'] = $this->m_dosbing->selectjudulta($id_judul);

            $this->load->view('dosen/v_detailpengerjaanjudul', $data);
        }

    public function detailjudultaXXX($idta){
            $this->load->model("m_dosbing");
            $data['data_judulta'] = $this->m_dosbing->selectjudulta($idta);

            $this->load->view('dosen/v_detailpengerjaanjudul', $data);
        }

     public function accept($idta){
             $query = "UPDATE t_judul SET id_status = 7 WHERE idta = ".intval($idta);
             $query2 = "UPDATE mahasiswa SET id_status = 7 WHERE nim = ".intval($nim);
             $sql   = $this->db->query($query) ;
             $sql2   = $this->db->query($query2) ;
             $this->session->set_flashdata('alert_setuju', 'Anda telah menyetujui pengajuan');
    
             redirect (base_url("/Data/topikdisetujui"));
         }

     public function reject($id_judul){
            $this->load->model("m_dosbing");
            $data['list_topikRejected'] = $this->m_dosbing->load_topikRejected($id_judul);

            $this->session->set_flashdata('alert_tolak', 'Anda telah menolak pengajuan');
            redirect (base_url("/Data/topikdisetujui"));
        }


    public function rejectproposal($id_judul){
            $this->load->model("m_dosbing");
            $data['list_proposalreject'] = $this->m_dosbing->load_proposalreject($id_judul);

            $this->session->set_flashdata('alert_tolak', 'Anda telah menolak pengajuan');
            redirect (base_url("/Data/topikdisetujui"));
        }

    public function rejectproposal2($id_judul){
            $this->load->model("m_dosbing");
            $data['list_proposalreject'] = $this->m_dosbing->load_proposalreject($id_judul);

            $this->session->set_flashdata('alert_tolak', 'Anda telah menolak pengajuan');
            redirect (base_url("/Data/topikdisetujui"));
        }


    public function acceptbimbing($idta){
             $query = "UPDATE t_judul SET id_status = 52 WHERE idta = ".intval($idta);
             $query2 = "UPDATE mahasiswa SET id_status = 52 WHERE nim = ".intval($nim);
             $sql   = $this->db->query($query) ;
             $sql2   = $this->db->query($query2) ;
             $this->session->set_flashdata('alert_setuju', 'Anda telah menyetujui pengajuan');
    
             redirect (base_url("/Data/topikdisetujui"));
         }

    public function proposalupdate($id_judul){
         $query = "UPDATE t_judul,mahasiswa SET t_judul.id_status = 53, mahasiswa.id_status =53 WHERE t_judul.nim = mahasiswa.nim AND t_judul.id_judul = ".intval($id_judul);
            $sql   = $this->db->query($query) ;
            $this->session->set_flashdata('alert_setuju', 'Anda telah menyetujui proposal');

            //var_dump($query,$query2);exit;
            redirect (base_url("/Data/prosesproposal"));
        }

    public function proposalupdate2($id_judul){
         $query = "UPDATE t_judul,mahasiswa SET t_judul.id_status = 9, mahasiswa.id_status =9 WHERE t_judul.nim = mahasiswa.nim AND t_judul.id_judul = ".intval($id_judul);
            $sql   = $this->db->query($query) ;
            $this->session->set_flashdata('alert_setuju', 'Anda telah menyetujui proposal');

            //var_dump($query,$query2);exit;
            redirect (base_url("/Data/prosesproposal"));
        }



}
<?php 
class Penelitian_kk extends MY_Controller {
	// pengajuan penelitian
	public function index()
	{
    $this->load->model("m_penelitian");
    $data['list_penelitian'] = $this->m_penelitian->load_penelitianPropose();
		
		$this->load->view('v_penelitian/v_kk/v_pengajuanPropose', $data);
  }

  public function pengajuanSetuju(){
    $this->load->model("m_penelitian");
    $data['list_penelitian'] = $this->m_penelitian->load_penelitianAccepted();
		
		$this->load->view('v_penelitian/v_kk/v_pengajuanAccepted', $data);
  }

  public function pengajuanDitolak(){
    $this->load->model("m_penelitian");
    $data['list_penelitian'] = $this->m_penelitian->load_penelitianRejected();
		
		$this->load->view('v_penelitian/v_kk/v_pengajuanRejected', $data);
  }

  // DETAIL
  public function penelitianDetail($id_penelitian){
		$this->load->model("m_penelitian");
    $data['detailPenelitian'] = $this->m_penelitian->load_penelitianSelect($id_penelitian);
    $data['dataAnggotaDsn'] 	= $this->m_penelitian->getAnggotaPeneliti($id_penelitian);
    $data['dataAnggotaMhs'] 	= $this->m_penelitian->getAnggotaPenelitiMhs($id_penelitian);

		$this->load->view('v_penelitian/v_kk/v_detail', $data);
  }

  // PROGRESS PENELITIAN
  public function Progress(){
    $this->load->model("m_penelitian");
    $data['list_penelitian'] = $this->m_penelitian->load_penelitianBerjalan();
		
		$this->load->view('v_penelitian/v_kk/v_penelitianBerjalan', $data);
  }

  public function verRiwayatPenelitian(){
    $this->load->model("m_penelitian");
    $data['list_penelitian'] = $this->m_penelitian->load_penelitianSelesaiVer();
    
    $this->load->view('v_penelitian/v_kk/v_riwayatPenelitianVer', $data);
  }
  
  public function monitoring(){
    $this->load->model('m_penelitian');
    $this->load->model('m_akun');
    $this->load->model('m_pengaturan');
    $data['load_dosen']       = $this->m_akun->load_dosen();
    $data['load_status']      = $this->m_pengaturan->load_status();
    // $data['list_penelitian']  = $this->m_penelitian->load_penelitian();
    $data['load_skema']       = $this->m_penelitian->load_skemaPenelitian();
    $skema  = (!empty($_POST['skema'])) ? $_POST['skema'] : '' ;
    $nip    = (!empty($_POST['nip'])) ? $_POST['nip'] : '' ;
    $status = (!empty($_POST['status'])) ? $_POST['status'] : '' ;
    // var_dump($skema);exit;
    $query  = "SELECT
                p.*, d.*, s.status AS status,
                s.status_kk AS status_kk,
                sp.skema AS skema,
                bd.nama_bidang AS bidang,
                jb.jabatan AS jab_fungsional
              FROM
                penelitian p
              JOIN dosen d ON d.nip = p.nip
              JOIN STATUS s ON s.id_status = p.id_status
              JOIN bidang bd ON bd.id_bidang = d.id_bidang
              JOIN skema_penelitian sp ON sp.id_skema = p.id_skema
              JOIN jabatan jb ON jb.id_jabatan = d.id_jabatan
              WHERE p.id_penelitian is not NULL
                    ";
    // var_dump($nip, $year);exit;
    if (!empty($skema)) {
        $query .= " AND (p.id_skema = '$skema')";
    }
    if (!empty($nip)) {
        $query .= " AND (p.nip = '$nip')";
    }
    if (!empty($status)) {
        $query .= " AND (p.id_status = '$status')";
    }

    $sql    = $this->db->query($query);
    $row	  = $sql->result_array();
    $data['dataPenelitian'] = $row;

    $this->load->view('v_penelitian/v_kk/v_monitoringPenelitian',$data);
  }

  // RIWAYAT PENELITIAN
  public function Riwayat(){
    $this->load->model("m_penelitian");
    $data['list_penelitian'] = $this->m_penelitian->load_penelitianSelesai();
		
		$this->load->view('v_penelitian/v_kk/v_penelitianSelesai', $data);
  }
  
  // ACCEPT & REJECT & FINISH
  public function accept(){
    $id_penelitian  = $this->db->escape($_POST['id_penelitian']);
    $nip            = $this->db->escape($_POST['nip']);
    $tgl_update     = date('Y-m-d'); 
    $tgl_notif      = date('Y-m-d H:i:s');
    $query          = "UPDATE penelitian SET id_status = 4 , tgl_update = '$tgl_update' WHERE id_penelitian = $id_penelitian ";
    $sql            = $this->db->query($query);
    $query_notif    = "INSERT INTO notification(nip, created_date, id_penelitian) VALUES ($nip, '$tgl_notif', $id_penelitian) ";
    $sql_notif      = $this->db->query($query_notif);
    $this->session->set_flashdata('alert_setuju', 'Anda telah menyetujui pengajuan');
    
    redirect (base_url("/Penelitian_kk/pengajuanSetuju"));
  }
  
  public function reject(){
    $id_penelitian  = $this->db->escape($_POST['id_penelitian']);
    $alasan_tolak   = $this->db->escape($_POST['alasan_tolak']);
    $nip            = $this->db->escape($_POST['nip']);
    $tgl_update     = date('Y-m-d'); 
    $tgl_notif      = date('Y-m-d H:i:s');
    $query          = "UPDATE penelitian SET id_status = 5 , tgl_update = '$tgl_update', alasan_tolak = $alasan_tolak WHERE id_penelitian = $id_penelitian ";
    $sql            = $this->db->query($query) ;
    $query_notif    = "INSERT INTO notification(nip, created_date, id_penelitian) VALUES ($nip, '$tgl_notif', $id_penelitian) ";
    $sql_notif      = $this->db->query($query_notif);
    $this->session->set_flashdata('alert_tolak', 'Anda telah menolak pengajuan');

    redirect (base_url("/Penelitian_kk/pengajuanDitolak"));
  }

  public function finish($id_penelitian){
    $tgl_update   = date('Y-m-d'); 
    $query        = "UPDATE penelitian SET id_status = 3 , tgl_update = '$tgl_update' WHERE id_penelitian = ".intval($id_penelitian);
    $sql          = $this->db->query($query) ;
    $this->session->set_flashdata('alert_finish', 'Penelitian telah dinyatakan selesai');
    $query_notif = "UPDATE notification SET status = 0 WHERE id_penelitian = $id_penelitian ";
    $sql_notif = $this->db->query($query_notif);

    redirect (base_url("/Penelitian_kk/Riwayat"));
  }

  public function berjalan($id_penelitian){
    $tgl_update   = date('Y-m-d'); 
    $query        = "UPDATE penelitian SET id_status = 2 , tgl_update = '$tgl_update' WHERE id_penelitian = ".intval($id_penelitian);
    $sql          = $this->db->query($query) ;
    $query_notif  = "UPDATE notification SET status = 0 WHERE id_penelitian = $id_penelitian ";
    $sql_notif    = $this->db->query($query_notif);

    redirect (base_url("/Penelitian_kk/pengajuanSetuju"));
  }

  function countPenelitian()
  {
      $this->load->model("m_penelitian");
      $data = $this->m_penelitian->countPenelitian();
      header('Content-Type: application/json');
      echo json_encode( $data );
  }




    
}

?>
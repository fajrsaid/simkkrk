<?php defined('BASEPATH') OR exit('No direct script access allowed');

class m_pkip extends CI_Model
{
	public function index(){
        $this->load->model("model_data");
        $data['list_judul'] = $this->m_pkip->load_judul();

        $this->load->view("pkip/v_datajudul",$data);
    }

    public function load_judul(){
        $query = "SELECT * FROM t_judul";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    public function load_dosen(){
        $query = "SELECT * FROM dosen";
            $sql = $this->db->query($query);
            return $sql->result_array();
    }

    public function load_judulproposalta(){
        $nip = $this->session->userdata("nip");
            $query  = "SELECT
                        a.*, d.*,
                        tt.kode_dosen AS kode1,
                        ty.kode_dosen AS kode2,                          
                        s. status AS status
                    FROM
                        t_judul a
                    LEFT JOIN STATUS s ON a.id_status = s.id_status
                    JOIN mahasiswa d ON d.nim = a.nim
                    LEFT JOIN dosen tt ON tt.nip = a.pbb1
                    LEFT JOIN dosen ty ON ty.nip = a.pbb2 /*Harus di or keknya */
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }

    public function load_prosesjudul(){
    $query  = "SELECT
                        a.*, d.*, s. status AS status,
                        tt.kode_dosen AS kode1,
                        ty.kode_dosen AS kode2,
                        sa.topik AS topik
                    FROM
                        t_judul a
                    JOIN STATUS s ON a.id_status = s.id_status
                    JOIN t_topik sa ON sa.idta = a.idta
                    JOIN mahasiswa d ON d.nim = a.nim
                    LEFT JOIN dosen tt ON tt.nip = a.pbb1
                    JOIN dosen ty ON ty.nip = a.pbb2 /*Harus di or keknya */
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }

    public function load_judulsiapseminar(){
            $query  = "SELECT
                        a.*, d.*, s. status AS status,
                        tt.kode_dosen AS kode1,
                        ty.kode_dosen AS kode2,
                        sa.topik AS topik
                    FROM
                        t_judul a
                    JOIN STATUS s ON a.id_status = s.id_status
                    JOIN t_topik sa ON sa.idta = a.idta
                    JOIN mahasiswa d ON d.nim = a.nim
                    LEFT JOIN dosen tt ON tt.nip = a.pbb1
                    JOIN dosen ty ON ty.nip = a.pbb2 /*Harus di or keknya */
                    WHERE
                        a.id_status = 9
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }

    public function selectjudul($id_judul){
            $sql_detail = $this->db->query("SELECT a.*,d.*,
                    s.*
                    FROM t_judul a
                    JOIN mahasiswa s ON a.nim = s.nim
                    JOIN dosen d ON d.nip = a.nip
                    WHERE a.id_judul = ".intval($id_judul));
            if($sql_detail->num_rows() > 0)
                return $sql_detail->row_array();
            return false;
    }
  
    public function load_pbb1(){
            $query = "SELECT * FROM dosen WHERE pembimbing =1";
            $sql = $this->db->query($query);
            return $sql->result_array();
    }

    public function load_pbb2(){
            $query = "SELECT * FROM dosen WHERE pembimbing =2";
            $sql = $this->db->query($query);
            return $sql->result_array();
    }

    public function get_default($id_judul){
        $sql = $this->db->query("SELECT * FROM t_judul WHERE id_judul = ".intval($id_judul));
        if($sql->num_rows() > 0)
            return $sql->row_array();
        return false;
    }

    public function lulusseminar($post, $id_judul){
        $sql  = $this->db->query("UPDATE t_judul, mahasiswa SET t_judul.id_status = 51, mahasiswa.id_status =51, WHERE mahasiswa.nim = t_judul.nim AND t_judul.id_judul = ".intval($id_judul));
        if($sql->num_rows() > 0)
            return $sql->row_array();
        return true;
    }

    public function load_jadwal(){
        $nip = $this->session->userdata("nip");
            $query  = "SELECT
                        a.*, d.*, s. status AS status,
                        tt.kode_dosen AS pbb1,
                        ty.kode_dosen AS pbb2,
                        tu.kode_dosen AS pgj1,
                        ti.kode_dosen AS pgj2
                    FROM
                        t_jadwal a
                    JOIN STATUS s ON a.id_status = s.id_status
                    JOIN mahasiswa d ON d.nim = a.nim
                    LEFT JOIN dosen tt ON tt.nip = a.pbb1
                    JOIN dosen ty ON ty.nip = a.pbb2 /*Harus di or keknya */
                    LEFT JOIN dosen tu ON tu.nip = a.pgj1
                    JOIN dosen ti ON ti.nip = a.pgj2 /*Harus di or keknya */
                    WHERE
                        a.id_status = 54 
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
    }

    public function simpanjadwal($post,$id_judul){
        $id_judul          = $this->db->escape($post['id_judul']);
        $id_status          = $this->db->escape($post['id_status']);
        $judul          = $this->db->escape($post['judul']);
        $topik               = $this->db->escape($post['topik']);
        $nim               = $this->db->escape($post['nim']);
        $nama_awal               = $this->db->escape($post['nama_awal']);
        $nama_akhir               = $this->db->escape($post['nama_akhir']);
        $pbb1               = $this->db->escape($post['pbb1']);
        $pbb2               = $this->db->escape($post['pbb2']);
        $pgj1               = $this->db->escape($post['pgj1']);
        $pgj2           = $this->db->escape($post['pgj2']);
        $waktuujian           = $this->db->escape($post['waktuujian']);
        $tempatujian               = $this->db->escape($post['tempatujian']);

        $sql = $this->db->query("INSERT INTO t_jadwal (
                    id_judul,
                    id_status,
                    judul,
                    topik,
                    nim,
                    nama_awal,
                    nama_akhir,
                    pbb1,
                    pbb2,
                    pgj1,
                    pgj2,
                    waktuujian,
                    tempatujian
                )
                VALUES
                    (
                    $id_judul,
                    $id_status,
                    $judul,
                    $topik,
                    $nim,
                    $nama_awal,
                    $nama_akhir,
                    $pbb1,
                    $pbb2,
                    $pgj1,
                    $pgj2,
                    $waktuujian,
                    $tempatujian
                                        )");
        $sql2  = $this->db->query("UPDATE mahasiswa, t_judul SET mahasiswa.id_status = 54 WHERE t_judul.nim = mahasiswa.nim AND t_judul.id_judul = $id_judul");
        $sql3  = $this->db->query("UPDATE t_judul,mahasiswa SET t_judul.id_status = 54 WHERE t_judul.nim = mahasiswa.nim AND t_judul.id_judul = $id_judul");
        // var_dump($sql2,$sql3);exit;
        return TRUE;
        }

        public function load_seminarulang($id_judul)
        {   
            $sql2 = $this->db->query("UPDATE mahasiswa,t_judul SET mahasiswa.id_status = 52, t_judul.id_status = 52 WHERE mahasiswa.nim = t_judul.nim AND t_judul.id_judul = $id_judul");
            $sql1 = $this->db->query("DELETE from t_jadwal WHERE id_jadwal = $id_jadwal");
            return TRUE;
        }


        public function getRuanganSeminar()
        {
            $query = "SELECT
                        *
                    FROM
                        ruangan_seminar";
            $sql = $this->db->query($query);
            return $sql->result_array();
        }

        public function validasiRuangan($waktuujian)
        {
            $query = "SELECT
                        *
                    FROM
                        ruangan_seminar rs
                    JOIN jadwal_seminar js ON js.id_slot = rs.id_slot
                    WHERE js.tanggal = '$waktuujian' ";
            $sql  = $this->db->query($query);
            $dataJadwal = $sql->result_array();
            $list_ruangan = $id_slot =  [];
            if (!empty($dataJadwal)) {
                foreach ($dataJadwal as $key => $value) {
                    $id_slot[] = $value['id_slot'];
                }
                $list_id = implode(',', $id_slot);
                $query_ruangan = "SELECT
                            *
                        FROM
                            ruangan_seminar WHERE id_slot NOT IN($list_id)";
                $sql_ruangan = $this->db->query($query_ruangan);
                $data_ruangan = $sql_ruangan->result_array();
            } else {
                $query_ruangan = "SELECT
                            *
                        FROM
                            ruangan_seminar";
                $sql_ruangan = $this->db->query($query_ruangan);
                $data_ruangan = $sql_ruangan->result_array();
            }
           
            return $data_ruangan;
        }




}
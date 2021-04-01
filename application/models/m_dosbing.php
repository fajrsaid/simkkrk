<?php defined('BASEPATH') OR exit('No direct script access allowed');

class m_dosbing extends CI_Model
{
    public function index(){
        $this->load->model("model_data");
        $data['list_topik'] = $this->m_dosbing->load_topik();

        $this->load->view("dosen/v_datajudul",$data);
    }

    public function load_topik(){
            $nip = $this->session->userdata("nip");
            $query = "SELECT a.*,d.*, 
                    s.nama_bidang as bidang
                    FROM t_topik a
                    JOIN bidang s ON a.id_bidang = s.id_bidang
                    JOIN dosen d ON d.nip = a.nip
                    WHERE a.nip = '$nip' ";
            $sql = $this->db->query($query);
            return $sql->result_array();
        }   

    public function load_bidang(){
        $query = "SELECT * FROM bidang";
            $sql = $this->db->query($query);
            return $sql->result_array();
    }

    public function load_dosen(){
        $query = "SELECT * FROM dosen";
            $sql = $this->db->query($query);
            return $sql->result_array();
    }



    public function update($post, $idta){
        //parameter $id wajib digunakan agar program tahu ID mana yang ingin diubah datanya.
        $topik = $this->db->escape($post['topik']);
        $id_bidang = $this->db->escape($post['id_bidang']);
        $requirement = $this->db->escape($post['requirement']);
        $nip = $this->db->escape($post['nip']);

        $keterangan = $this->db->escape($post['keterangan']);
        $kuotatopik = $this->db->escape($post['kuotatopik']);

        $sql = $this->db->query("UPDATE t_topik SET topik = $topik, id_bidang = $id_bidang, requirement = $requirement, nip = $nip, keterangan = $keterangan, kuotatopik = $kuotatopik WHERE idta = ".intval($idta));

        return true;
    }

    public function get_default($idta){
        $sql = $this->db->query("SELECT * FROM t_topik WHERE idta = ".intval($idta));
        if($sql->num_rows() > 0)
            return $sql->row_array();
        return false;
    }

public function load_jadwal(){
        $query = "SELECT * FROM t_jadwal";
            $sql = $this->db->query($query);
            return $sql->result_array();
    }
    
    public function SimpanTopik($post){
        $topik              = $this->db->escape($post['topik']);
        $tahun              = $this->db->escape($post['tahun']);
        $id_bidang          = $this->db->escape($post['id_bidang']);
        $requirement        = $this->db->escape($post['requirement']);
        $nip                = $this->db->escape($post['nip']);
        $keterangan         = $this->db->escape($post['keterangan']);
        $kuotatopik         = $this->db->escape($post['kuotatopik']);
        $pbb1         = $this->db->escape($post['pbb1']);
        $pbb2         = $this->db->escape($post['pbb2']);
        $query_add = "INSERT INTO t_topik (
                    topik,
                    tahun,
                    id_bidang,
                    requirement,
                    nip,
                    keterangan,
                    kuotatopik,
                    pbb1,
                    pbb2
                )
                VALUES
                    (
                        $topik,
                        $tahun,
                        $id_bidang,
                        $requirement,
                        $nip,
                        $keterangan,
                        $kuotatopik,
                        $pbb1,
                        $pbb2
                    )";
        $sql_add = $this->db->query($query_add);
        if($sql_add)
            return true;
        return false;
        }


        public function load_TopikProposeTA(){
        $nip = $this->session->userdata("nip");
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
                        a.id_status = 6 
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }

        public function load_TopikPropose(){
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
                    WHERE
                        a.id_status=6 AND ($nip=a.pbb1 OR $nip=a.pbb2)
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }

        public function load_TopikPropose2(){
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
                    WHERE
                        a.id_status=8 AND ($nip=a.pbb1 OR $nip=a.pbb2)
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }


        public function load_topikdisetujui(){
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
                    WHERE
                        a.id_status = 7 AND ($nip=a.pbb1 OR $nip=a.pbb2)
                    ";
            $sql    = $this->db->query($query);
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
                    WHERE
                        a.id_status = 50 AND ($nip=a.pbb1 OR $nip=a.pbb2)
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }

        public function load_judulproposalta2(){
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
                    WHERE
                        a.id_status = 53 AND ($nip=a.pbb1 OR $nip=a.pbb2)
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }

        public function load_juduldikerjakan(){
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
                    WHERE
                        a.id_status = 8 AND ($nip=a.pbb1 OR $nip=a.pbb2)
                    ";
            $sql    = $this->db->query($query);
            return $sql->result_array();
        }


    public function selecttopik($idta){
            $sql_detail = $this->db->query("SELECT
                            a.*, d.*, s. status as status
                        FROM
                            t_topik a
                        JOIN STATUS s ON s.id_status = a.id_status
                        JOIN dosen d ON d.nip = a.nip
                        WHERE a.idta = ".intval($idta));
            if($sql_detail->num_rows() > 0)
                return $sql_detail->row_array();
            return false;
        }


    public function selectjudulta($id_judul){
            $sql_detail = $this->db->query("SELECT a.*,d.*,s.*, f. status AS status
                    FROM t_judul a
                    JOIN mahasiswa s ON a.nim = s.nim
                    JOIN STATUS f ON a.id_status = f.id_status
                    JOIN dosen d ON a.nip = d.nip
                    WHERE a.id_judul = ".intval($id_judul));
            if($sql_detail->num_rows() > 0)
                return $sql_detail->row_array();
            return false;
    }

    // public function get_data_stok(){
    //     $query = $this->db->query("SELECT count(nip) FROM dosen GROUP BY kuota");
          
    //     if($query->num_rows() > 0){
    //         foreach($query->result() as $data){
    //             $hasil[] = $data;
    //         }
    //         return $hasil;
    //     }
    // }


    public function load_topikRejected($id_judul)
        {   
            $sql3 = $this->db->query("UPDATE t_topik SET kuotatopik = kuotatopik+1 WHERE idta = ".intval($idta));
            $sql2 = $this->db->query("UPDATE mahasiswa,t_judul SET mahasiswa.id_status = 60 WHERE mahasiswa.nim = t_judul.nim AND t_judul.id_judul = $id_judul");
            $sql1 = $this->db->query("DELETE from t_judul WHERE id_judul = $id_judul");
            return TRUE;
        }

    public function load_pembimbingRejected($id_judul)
        {   
            $sql2 = $this->db->query("UPDATE mahasiswa,t_judul SET mahasiswa.id_status = 6 WHERE mahasiswa.nim = t_judul.nim AND t_judul.id_judul = $id_judul");
            $sql1 = $this->db->query("DELETE from t_judul WHERE id_judul = $id_judul");
            return TRUE;
        }

    public function load_proposalreject($id_judul)
        {   
            $sql2 = $this->db->query("UPDATE mahasiswa,t_judul SET mahasiswa.id_status = 52, t_judul.id_status = 52 WHERE mahasiswa.nim = t_judul.nim AND t_judul.id_judul = $id_judul");
            return TRUE;
        }

    public function get_data(){
      $this->db->select('nip,id_bidang,id_status');
      $result = $this->db->get('t_judul');
      return $result;
  }

    public function hapus($idta)
        {
            $sql_delete = $this->db->query("DELETE from t_topik WHERE idta = ".intval($idta));
        }
}
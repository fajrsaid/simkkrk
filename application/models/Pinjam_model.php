<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjam_model extends CI_Model
{
    private $_table = "peminjaman";

    public $pinjam_id;
    public $nama_mahasiswa;
    public $nim;
    public $id_laboratorium;
    public $tanggal_peminjaman;
    public $tanggal_kembali;
    public $tanggal_update;
    public $file_peminjaman;

    public function rules()
    {
        return [
            ['field' => 'nama_mahasiswa',
            'label' => 'Nama mahasiswa',
            'rules' => 'required'],

            ['field' => 'nim',
            'label' => 'NIM',
            'rules' => 'required'],

            ['field' => 'id_laboratorium',
            'label' => 'id_inventaris',
            'rules' => 'required'],


             ['field' => 'tanggal_peminjaman',
            'label' => 'Tanggal Peminjaman',
            'rules' => 'required'],

            ['field' => 'tanggal_kembali',
            'label' => 'Tanggal Pengembalian',
            'rules' => 'required'],

            ['field' => 'tanggal_update',
            'label' => 'Tanggal Pengembalian Update',
            'rules' => 'required'],

            ['field' => 'file_peminjaman',
            'label' => 'File Peminjaman',
            'rules' => 'numeric'],

            ['field' => 'id_status',
            'label' => 'Status',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["pinjam_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nama_mahasiswa = $post["nama_mahasiswa"];
        $this->nim = $post["nim"];
        $this->id_laboratorium = $post["id_laboratorium"];
        $this->tanggal_peminjaman = $post["tanggal_peminjaman"];
        $this->tanggal_kembali = $post["tanggal_kembali"];
        $this->tanggal_update = $post["tanggal_update"];
        $this->file_peminjaman = $post["file_peminjaman"];
        $nim            = $this->session->userdata("nim");
        $this->db->insert($this->_table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $this->pinjam_id = $id;
        $this->nama_mahasiswa = $post["nama_mahasiswa"];
        $this->nim = $post["nim"];
        $this->id_laboratorium = $post["id_laboratorium"];
        $this->tanggal_peminjaman = $post["tanggal_peminjaman"];
        $this->tanggal_kembali = $post["tanggal_kembali"];
        $this->tanggal_update = $post["tanggal_update"];
        $this->file_peminjaman = $post["file_peminjaman"];
        $this->db->update($this->_table, $this, array('pinjam_id' =>$id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("pinjam_id" => $id));
    }
    public function get_by_role()
    {
      $this->db->select('
          peminjaman.*, laboratorium.id_laboratorium AS id_laboratorium, laboratorium.nama_laboratorium
          ');

       $this->db->join('laboratorium', 'peminjaman.id_laboratorium = laboratorium.id_laboratorium');
       $this->db->from('peminjaman');
      $query = $this->db->get();
      return $query->result();
    }

    public function get_by_roles()
    {
      $this->db->select('
          peminjaman.*, laboratorium.id_laboratorium AS id_laboratorium, laboratorium.nama_laboratorium
          ');

       $this->db->join('laboratorium', 'peminjaman.id_laboratorium = laboratorium.id_laboratorium');
       $this->db->from('peminjaman');
       $this->db->where('peminjaman.id_laboratorium', $this->session->userdata('id_laboratorium'));
      $query = $this->db->get();
      return $query->result();
    }

        public function getByLab()
    {
        $id_laboratorium = $this->session->userdata('id_laboratorium');
        return $this->db->get_where($this->_table, ["id_laboratorium" => $id_laboratorium])->row();
    }



}

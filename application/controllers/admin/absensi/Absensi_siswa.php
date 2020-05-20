<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Absensi_siswa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('absensi/m_absensi_siswa');
    }

    public function index()
    {
        $this->load->admin('admin/absensi/absensi_siswa/list');
    }

    public function create()
    {
        $this->load->view('admin/absensi/absensi_siswa/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/absensi/absensi_siswa/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $datas = $this->db->get_where("app_absensi_siswa",array('id'=>$id))->row();
        $siswa = $this->db->get_where("app_siswa",array('id'=>$datas->id_siswa))->row();
        $this->load->view('admin/absensi/absensi_siswa/form', ['id' => $id, 'action' => 'update', 'data'=>$datas, 'nama_siswa'=>$siswa]);
    }

    public function openAbsen(){
        $skl = $this->input->post("skl");
        $jurusan = $this->input->post("jurusan");   
        $kelas = $this->input->post("kelas");
        $semester = $this->input->post("semester");
        $thn_ajar = $this->input->post("thn_ajar");
        $mapel = $this->input->post("mapel");
        $guru = $this->input->post("guru");
        $tanggal = $this->input->post("tanggal");
        $data=[
            'skl'=>$skl,
            'jurusan'=>$jurusan,
            'kelas'=>$kelas,
            'semester'=>$semester,
            'thn_ajar'=>$thn_ajar,
            'mapel'=>$mapel,
            'guru'=>$guru,
            'tanggal'=>$tanggal
        ];
        $rows = $this->db->query("
            select 
            mu.id_device,
            aps.nama_siswa,
            aps.id_user
            from app_user mu
            left join app_siswa aps on aps.id_user = mu.id
            where mu.id_kelas = $kelas
        ")->result_array();
        // $rows=$this->db->get_where('app_siswa',array('id_kelas'=>$kelas))->result_array();
        $this->load->view('admin/absensi/absensi_siswa/open',['header'=>$data, 'app'=>$rows]);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_absensi_siswa->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_absensi_siswa->json();
    }
}

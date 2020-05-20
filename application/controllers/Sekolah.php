<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sekolah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_sekolah');
        
        $this->load->model('transaksi/m_dokumen');
        $this->load->model('transaksi/m_komen');
        $this->load->model('anjungan/m_info');
        $this->load->model('akademik/m_kalendar_pendidikan');
        $this->load->model('kesiswaan/m_kalender_kegiatan');

        $this->load->model('akademik/m_siswa');

        $this->sekolah = findOne("
            select ask.*,ask.id as id_skl from app_skl ask
            where ask.slug = '".$this->uri->segment(3)."'
        ");
    }

    public function landing()
    {
        $sekolah = findOne("
            select * from m_anjungan man
            left join app_skl ask on ask.id = man.id_skl
            where ask.slug = '".$this->uri->segment(3)."'
        ");
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/info/index', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }

    public function info($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/info/listinfo', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    public function infodetail($slug)
    {
        $sekolah = $this->sekolah;
        $detail = $this->m_info->read(['id'=>$_GET['id'],'is_active'=>STATUS_IS_ACTIVE]);
        $gambar = $this->m_dokumen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_IMG,'is_active'=>STATUS_IS_ACTIVE]);
        $dokumen = $this->m_dokumen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_DOK,'is_active'=>STATUS_IS_ACTIVE]);
        $komen = $this->m_komen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_KOMEN,'is_active'=>STATUS_IS_ACTIVE]);
        
        // var_dump($komen); die;
        if($sekolah && $detail) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $data['detail'] = (object) $detail[0];
            $data['gambar'] = (object) $gambar;
            $data['dokumen'] = (object) $dokumen;
            $data['komen'] = (object) $komen;
            $this->load->landing('landing/info/listinfodetail', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }

    public function infogaleri($slug)
    {
        $sekolah = $this->sekolah;
        // var_dump($komen); die;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/info/infogaleri', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
        
    }
    
    public function infogaleridetail($slug)
    {
        $sekolah = $this->sekolah;
        $detail = $this->m_info->read(['id'=>$_GET['id'],'is_active'=>STATUS_IS_ACTIVE]);
        $gambar = $this->m_dokumen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_IMG,'is_active'=>STATUS_IS_ACTIVE]);
        $komen = $this->m_komen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_KOMEN,'is_active'=>STATUS_IS_ACTIVE]);
        
        // var_dump($komen); die;
        if($sekolah && $detail) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $data['detail'] = (object) $detail[0];
            $data['gambar'] = (object) $gambar;
            $data['komen'] = (object) $komen;
            $this->load->landing('landing/info/infogaleridetail', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }


    public function infovideo($slug)
    {
        $sekolah = $this->sekolah;
        // var_dump($komen); die;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/info/infovideo', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    
    public function infovideodetail($slug)
    {
        $sekolah = $this->sekolah;
        $detail = $this->m_info->read(['id'=>$_GET['id'],'is_active'=>STATUS_IS_ACTIVE]);
        $video = $this->m_dokumen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_VID,'is_active'=>STATUS_IS_ACTIVE]);
        
        // var_dump($komen); die;
        if($sekolah && $detail) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $data['detail'] = (object) $detail[0];
            $data['video'] = (object) $video;
            $this->load->landing('landing/info/infovideodetail', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }












    public function mading($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/mading/listmading', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    public function madingdetail($slug, $id=0)
    {
        $sekolah = $this->sekolah;
        $detail = $this->m_info->read(['id'=>$_GET['id'],'is_active'=>STATUS_IS_ACTIVE]);
        $gambar = $this->m_dokumen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_IMG,'is_active'=>STATUS_IS_ACTIVE]);
        $dokumen = $this->m_dokumen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_DOK,'is_active'=>STATUS_IS_ACTIVE]);
        $komen = $this->m_komen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_KOMEN,'is_active'=>STATUS_IS_ACTIVE]);
        
        // var_dump($komen); die;
        if($sekolah && $detail) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $data['detail'] = (object) $detail[0];
            $data['gambar'] = (object) $gambar;
            $data['dokumen'] = (object) $dokumen;
            $data['komen'] = (object) $komen;
            $this->load->landing('landing/mading/listmadingdetail', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }

    public function madinggaleri($slug)
    {
        $sekolah = $this->sekolah;
        // var_dump($komen); die;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/mading/madinggaleri', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    
    public function madinggaleridetail($slug, $id=0)
    {
        $sekolah = $this->sekolah;
        $detail = $this->m_info->read(['id'=>$_GET['id'],'is_active'=>STATUS_IS_ACTIVE]);
        $gambar = $this->m_dokumen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_IMG,'is_active'=>STATUS_IS_ACTIVE]);
        $komen = $this->m_komen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_KOMEN,'is_active'=>STATUS_IS_ACTIVE]);
        
        // var_dump($komen); die;
        if($sekolah && $detail) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $data['detail'] = (object) $detail[0];
            $data['gambar'] = (object) $gambar;
            $data['komen'] = (object) $komen;
            $this->load->landing('landing/mading/infogaleridetail', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }


    public function madingvideo($slug)
    {
        $sekolah = $this->sekolah;
        // var_dump($komen); die;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/mading/madingvideo', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    
    public function madingvideodetail($slug)
    {
        $sekolah = $this->sekolah;
        $detail = $this->m_info->read(['id'=>$_GET['id'],'is_active'=>STATUS_IS_ACTIVE]);
        $video = $this->m_dokumen->read(['id_trx'=>$_GET['id'],'flag'=>DOKUMEN_VID,'is_active'=>STATUS_IS_ACTIVE]);
        
        // var_dump($sekolah); 
        // var_dump($detail); 
        // die;
        if($sekolah && $detail) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $data['detail'] = (object) $detail[0];
            $data['video'] = (object) $video;
            $this->load->landing('landing/mading/madingvideodetail', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }









    public function kalender($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/kalender/kalender', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    public function jadwal($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/kalender/jadwal', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }

    public function jadwalguru($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/kalender/jadwalguru', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    public function jadwalevent($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/kalender/jadwalevent', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }





    public function pustakaebook($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/pustaka/ebook', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    public function pustakavideo($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/pustaka/video', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }




    public function psbcalon($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $data['id'] = isset($_GET['id']) ? $_GET['id'] : "";
            $data['buatpsb'] = findOne("
            select apb.*, ta.tahun
            from app_buatpsb apb 
            left join app_tahun_ajaran ta on ta.id = apb.id_tahun
            where apb.id_skl = '".$sekolah->id."'
            and date(now()) >= apb.mulai 
            and date(now()) <= apb.selesai 
            ");
            $this->load->landing('landing/psb/psbcalon', (object) $data);
            // $this->load->landing('landing/psb/psbcalontd', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }
    public function psblist($slug)
    {
        $sekolah = $this->sekolah;
        if($sekolah) {
            $data['sekolah'] = $sekolah;
            $data['slug'] = $sekolah->slug;
            $this->load->landing('landing/psb/psblist', (object) $data);
        } else {
            $this->output->set_status_header('404');
        }
    }

    // public function madinggaleri($slug)
    // {
    //     $sekolah = findOne("
    //         select * from m_anjungan man
    //         left join app_skl ask on ask.id = man.id_skl
    //         where man.slug = '$slug'
    //     ");
    //     if(!$sekolah) {
    //         $this->output->set_status_header('404');
    //     } else {
    //         $data['sekolah'] = $sekolah;
    //         $data['slug'] = $sekolah->slug;
    //         $this->load->landing('landing/info/mading/madinggaleri', (object) $data);
    //     }
    // }
    
    // public function madinggaleridetail($slug, $id=0)
    // {
    //     $sekolah = findOne("
    //         select * from m_anjungan man
    //         left join app_skl ask on ask.id = man.id_skl
    //         where man.slug = '$slug'
    //     ");
    //     if(!$sekolah) {
    //         $this->output->set_status_header('404');
    //     } else {
    //         $data['sekolah'] = $sekolah;
    //         $data['slug'] = $sekolah->slug;
    //         $this->load->landing('landing/info/mading/madinggaleridetail', (object) $data);
    //     }
    // }


    // public function madingvideo($slug)
    // {
    //     $sekolah = findOne("
    //         select * from m_anjungan man
    //         left join app_skl ask on ask.id = man.id_skl
    //         where man.slug = '$slug'
    //     ");
    //     if(!$sekolah) {
    //         $this->output->set_status_header('404');
    //     } else {
    //         $data['sekolah'] = $sekolah;
    //         $data['slug'] = $sekolah->slug;
    //         $this->load->landing('landing/info/mading/madingvideo', (object) $data);
    //     }
    // }
    
    // public function madingvideodetail($slug, $id=0)
    // {
    //     $sekolah = findOne("
    //         select * from m_anjungan man
    //         left join app_skl ask on ask.id = man.id_skl
    //         where man.slug = '$slug'
    //     ");
    //     if(!$sekolah) {
    //         $this->output->set_status_header('404');
    //     } else {
    //         $data['sekolah'] = $sekolah;
    //         $data['slug'] = $sekolah->slug;
    //         $this->load->landing('landing/info/mading/madingvideodetail', (object) $data);
    //     }
    // }




    public function create()
    {
        $this->load->view('admin/master/sekolah/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/sekolah/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/sekolah/form', ['id' => $id, 'action' => 'update']);
    }

 


    



   
}
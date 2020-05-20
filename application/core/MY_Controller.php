<?php


class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cekActionMenu();
    }

    public function cekActionMenu()
    {
        
        $log = $this->session->userdata('logged');
        
        // var_dump($log);die;
        $c = $this->uri->segment(2) ? ($this->uri->segment(2)) : '';
        $a = $this->uri->segment(3) ? ($this->uri->segment(3)) : '';
        $rules = $this->uri->segment(4) ? ('/'.$this->uri->segment(4)) : '';
        $url = $a.$rules;


        // echo '<hr>';
        // var_dump($url);
        // echo '<br>';
        // var_dump(isset($log['action']) && strpos($log['action'], $url) == false);
        // echo '<br>';
        // var_dump($log['action']);
        // echo '<hr>';

        if (!$log) {
            redirect(base_url('admin')); // apabila session habis
        } elseif ($url == 'dashboard/index') {
            // jika baru login
        } elseif (isset($log['action']) && strpos($log['action'], $url) == false) { // tidak punya akses
            redirect(base_url('admin/page/show403'));
        } else {
            // jika boleh akses
        }
    }
}

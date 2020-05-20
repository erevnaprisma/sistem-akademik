<?php
class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
            $content = '';
//            $content  .= $this->view('layout/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
//            $content .= $this->view('layout/footer', $vars, $return);

            return $content;
        else:
            
            
            
            $this->view('layout/backend',['content'=>$template_name, 'data'=>$vars]);
            
//            $this->view('layout/header', $vars);
//            $this->view($template_name, $vars);
//            $this->view('layout/footer', $vars);
        endif;
    }

    public function admin($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
            $content = '';
//            $content  .= $this->view('layout/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
//            $content .= $this->view('layout/footer', $vars, $return);

            return $content;
        else:
            
            
            
            $this->view('layout/admin',['content'=>$template_name, 'data'=>$vars]);
            
//            $this->view('layout/header', $vars);
//            $this->view($template_name, $vars);
//            $this->view('layout/footer', $vars);
        endif;
    }

    public function landing($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
            $content = '';
//            $content  .= $this->view('layout/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
//            $content .= $this->view('layout/footer', $vars, $return);

            return $content;
        else:
            
            
            
            $this->view('layout/landing',['content'=>$template_name, 'data'=>$vars]);
            
//            $this->view('layout/header', $vars);
//            $this->view($template_name, $vars);
//            $this->view('layout/footer', $vars);
        endif;
    }

    public function pos($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
            $content = '';
            $content .= $this->view($template_name, $vars, $return);
            return $content;
        else:
            $this->view('layout/pos',['content'=>$template_name, 'data'=>$vars]);
        endif;
    }

    public function cetak($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
            $content = '';
            $content .= $this->view($template_name, $vars, $return);
            return $content;
        else:
            $this->view('layout/cetak',['content'=>$template_name, 'data'=>$vars]);
        endif;
    }
}
?>
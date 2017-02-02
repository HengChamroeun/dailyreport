<?php
class MY_Loader extends CI_Loader {
    public function site($template_name, $vars = array(), $return = FALSE)
    {
        $content = $this->view('inc/header', $vars, $return);
        $content .= $this->view('pages/'.$template_name, $vars, $return);
        $content .= $this->view('inc/footer', $vars, $return);


        if ($return)
        {
            return $content;
        }
    }	
	
	    public function admin($template_name, $vars = array(), $return = FALSE)
    {
        $content = $this->view('inc/admin/header', $vars, $return);
        $content .= $this->view('pages/admin/'.$template_name, $vars, $return);
        $content .= $this->view('inc/admin/footer', $vars, $return);


        if ($return)
        {
            return $content;
        }
    }
    public function admin38($template_name, $vars = array(), $return = FALSE)
    {
        $content = $this->view('inc/admin/header38', $vars, $return);
        $content .= $this->view('pages/admin/'.$template_name, $vars, $return);
        $content .= $this->view('inc/admin/footer38', $vars, $return);


        if ($return)
        {
            return $content;
        }
    }

    public function LoadPrint($template_name, $vars = array(), $return = FALSE)
    {
        $content = $this->view('pages/print/head_print', $vars, $return);
        $content .= $this->view('pages/'.$template_name, $vars, $return);
        $content .= $this->view('pages/print/footer_print', $vars, $return);

        if ($return)
        {
            return $content;
        }
    }
	public function admin_from_site($template_name, $vars = array(), $return = FALSE)
    {
        $content = $this->view('inc/admin/header', $vars, $return);
        $content .= $this->view('pages/'.$template_name, $vars, $return);
        $content .= $this->view('inc/admin/footer', $vars, $return);


        if ($return)
        {
            return $content;
        }
    }	
}	
	
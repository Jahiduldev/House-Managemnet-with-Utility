<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author asad
 */
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4,5,6,7,8))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Dashboard';
            $data['active_sub_menu'] = 'Dashboard';

            $role_id = $this->session->userdata('role_id');
         
            $this->load->view('common/header', $data);
            $this->load->view('dashboard/index', $data);
            //  $this->load->view('common/footer',$data);
            $this->load->view('common/js', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

}

?>

<?php

class Menu_button extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'Submit Attendance';


            $this->load->view('common/header', $data);
            $this->load->view('menu_button/menu_button', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

}

?>

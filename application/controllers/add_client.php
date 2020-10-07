<?php

class Add_client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
              if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6,7))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'Add Client';

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('add_client/add_client', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_client/js_add_client', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addClientData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            
            $company = mysql_real_escape_string($this->input->post('company'));
            $client = mysql_real_escape_string($this->input->post('client'));
            $status = mysql_real_escape_string($this->input->post('status'));
            $date = date('Y-m-d');



            $data_department = array(
                'company_id' => $company,
                'client_name' => $client,
                'date' => $date,
                'status' => 1
            );


            $insert_result = $this->common_model->insertData('client', $data_department);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_client');
        else:
            redirect('home');
        endif;
    }

}

?>

<?php

class View_client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6,7))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'View Client';

            $this->load->view('common/header_ssp', $data);
            $this->load->view('view_client/view_client', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('view_client/js_view_client', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {


        $table = 'client';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'company_id', 'dt' => 0,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("company","id",$rowvalue);
            foreach($res_company as $row):
               $company_name= $row->company_name;
            endforeach;
                    return $company_name;
                }),
            array('db' => 'client_name', 'dt' => 1),
            array('db' => 'id', 'dt' => 2, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="' . site_url("view_client/editClient/" . $rowvalue) . '">
      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
                })
        );

        $this->load->database();
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
        $this->load->library('SSP');
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    public function editClient() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'View Client';
            $id = $this->uri->segment(3);

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);

            $res = $this->db->query("select * from client where id=$id");
            $data['get_client_data'] = $res->result();
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('edit_client/edit_client', $data);
            $this->load->view('common/footer', $data);
              $this->load->view('common/js', $data);
            $this->load->view('edit_client/js_edit_client', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editClientData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $id = mysql_real_escape_string($this->input->post('id'));
            $company = mysql_real_escape_string($this->input->post('company'));
            $client = mysql_real_escape_string($this->input->post('client'));
            $status = mysql_real_escape_string($this->input->post('status'));

            $date = date('Y-m-d');

            $data_client = array(
                'company_id' => $company,
                'client_name' => $client,
                'status' => $status
            );

            $insert_result = $this->common_model->updateData('client', $data_client, 'id', $id);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('view_client');
        else:
            redirect('home');
        endif;
    }

}

?>

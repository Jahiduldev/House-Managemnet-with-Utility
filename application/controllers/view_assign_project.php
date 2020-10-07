<?php

class View_assign_project extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Expense Mngt';
            $data['active_sub_menu'] = 'View Project';

            $this->load->view('common/header_ssp', $data);
            $this->load->view('view_assign_project/view_assign_project', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('view_assign_project/js_view_assign_project', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {


        $table = 'project';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'company_id', 'dt' => 0,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("company","id",$rowvalue);
            foreach($res_company as $row):
               $company_name= $row->company_name;
            endforeach;
                    return $company_name;
                }),
            array('db' => 'client_id', 'dt' => 1,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("client","id",$rowvalue);
            foreach($res_company as $row):
               $client_name= $row->client_name;
            endforeach;
                    return $client_name;
                }),
            array('db' => 'name', 'dt' => 2),
            array('db' => 'description', 'dt' => 3),
            array('db' => 'id', 'dt' => 4, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="' . site_url("view_project/editProject/" . $rowvalue) . '">
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

    public function editProject() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'View Project';
            $id = $this->uri->segment(3);

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);

            $res = $this->db->query("select * from project where id=$id");
            $data['get_project_data'] = $res->result();

            foreach ($data['get_project_data'] as $row) :
                $company_id = $row->company_id;
            endforeach;

            $table_name = 'client';
            $data['get_client_data'] = $this->common_model->getDataWhere($table_name,'company_id',$company_id);



            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('edit_project/edit_project', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('edit_project/js_edit_project', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editProjectData() {
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

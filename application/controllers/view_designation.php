<?php

class View_designation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Administrator';
            $data['active_sub_menu'] = 'View Designation';

            $this->load->view('common/header_ssp', $data);
            $this->load->view('view_designation/view_designation', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('view_designation/js_view_designation', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {


        $table = 'designation';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'company_id', 'dt' => 0,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("company","id",$rowvalue);
            foreach($res_company as $row):
               $company_name= $row->company_name;
            endforeach;
                    return $company_name;
                }),
            array('db' => 'department_id', 'dt' => 1,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("department","id",$rowvalue);
            foreach($res_company as $row):
               $department_name= $row->department_name;
            endforeach;
                    return $department_name;
                }),
            array('db' => 'designation', 'dt' => 2),
            array('db' => 'id', 'dt' => 3, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="' . site_url("view_designation/editDesignation/" . $rowvalue) . '">
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

    public function editDesignation() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'View Designation';
            $id = $this->uri->segment(3);

            $res = $this->db->query("select * from designation where id=$id");
            $data['get_designation_data'] = $res->result();

            foreach ($data['get_designation_data'] as $row) :              
                $company_id = $row->company_id;                                              
            endforeach;

            $table_name = 'department';
            $data['get_department_data'] = $this->common_model->getDataWhere($table_name,'company_id',$company_id);

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);


            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('edit_designation/edit_designation', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('edit_designation/js_edit_designation', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editDesignationData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $id = mysql_real_escape_string($this->input->post('id'));
            $company = mysql_real_escape_string($this->input->post('company'));
            $department = mysql_real_escape_string($this->input->post('department'));
            $designation = mysql_real_escape_string($this->input->post('designation'));
            $status = mysql_real_escape_string($this->input->post('status'));

            $date = date('Y-m-d');

            $data_designation = array(
                'company_id' => $company,
                'department_id' => $department,
                'designation' => $designation,
                'status' => $status
            );

            $insert_result = $this->common_model->updateData('designation', $data_designation, 'id', $id);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('view_designation');
        else:
            redirect('home');
        endif;
    }

}

?>

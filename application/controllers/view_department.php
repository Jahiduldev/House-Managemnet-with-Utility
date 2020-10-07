<?php

class View_department extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Administrator';
            $data['active_sub_menu'] = 'View Department';

            $this->load->view('common/header_ssp', $data);
            $this->load->view('view_department/view_department', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('view_department/js_view_department', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {


        $table = 'department';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'company_id', 'dt' => 0,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("company","id",$rowvalue);
            foreach($res_company as $row):
               $company_name= $row->company_name;
            endforeach;
                    return $company_name;
                }),
           
            array('db' => 'department_name', 'dt' => 1),
            array('db' => 'id', 'dt' => 2, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="' . site_url("view_department/editDepartment/" . $rowvalue) . '">
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

    public function editDepartment() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'View Department';
            $id = $this->uri->segment(3);

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);

            $res = $this->db->query("select * from department where id=$id");
            $data['get_department_data'] = $res->result();
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('edit_department/edit_department', $data);
            $this->load->view('common/footer', $data);
             $this->load->view('common/js', $data);
            $this->load->view('edit_department/js_edit_department', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editDepartmentData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $id = mysql_real_escape_string($this->input->post('id'));
            $company = mysql_real_escape_string($this->input->post('company'));
            $department = mysql_real_escape_string($this->input->post('department'));
            $status = mysql_real_escape_string($this->input->post('status'));

            $date = date('Y-m-d');

            $data_department = array(
                'company_id' => $company,
                'department_name' => $department,
                'status' => $status
            );

            $insert_result = $this->common_model->updateData('department', $data_department, 'id', $id);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('view_department');
        else:
            redirect('home');
        endif;
    }

}

?>

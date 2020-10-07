<?php

class Add_designation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Administrator';
            $data['active_sub_menu'] = 'Add Designation';

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('add_designation/add_designation', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_designation/js_add_designation', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addDesignationData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $company = mysql_real_escape_string($this->input->post('company'));
            $department = mysql_real_escape_string($this->input->post('department'));
            $designation = mysql_real_escape_string($this->input->post('designation'));
            $status = mysql_real_escape_string($this->input->post('status'));

            $date = date('Y-m-d');



            $data_designation = array(
                'company_id' => $company,
                'department_id' => $department,
                'designation' => $designation,
                'date' => $date,
                'status' => 1
            );


            $insert_result = $this->common_model->insertData('designation', $data_designation);

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

    public function getDepartment() {

        $data['base_url'] = $this->config->item('base_url');
        $com_id = mysql_real_escape_string($this->input->post('com_id'));

        $table_name = 'department';
        $result = $this->common_model->getDataWhere($table_name, "company_id", $com_id);
        echo '<option value="">Select</option>';
        if (count($result) > 0) {
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->department_name; ?></option>
                <?php
            endforeach;
        }
    }

}
?>

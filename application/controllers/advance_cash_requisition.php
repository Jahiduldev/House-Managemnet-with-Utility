<?php

class Advance_cash_requisition extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Operation';
            $data['active_sub_menu'] = 'Advance Cash Requisition';

            $employee_id = $this->session->userdata('emp_id');
            $table_name = 'assign_project';
            $data['get_project_data'] = $this->common_model->getDataWhere($table_name, "employee_id", $employee_id);




            $this->load->view('common/header', $data);
            $this->load->view('advance_cash_requisition/advance_cash_requisition', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('advance_cash_requisition/js_advance_cash_requisition', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addRequisition() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');


            $project = mysql_real_escape_string($this->input->post('project'));
            $query_22 = $this->db->query("select * from project where id='$project'");
            $result_22 = $query_22->result();
            foreach ($result_22 as $row_add):
                $client = $row_add->client_id;
                $company = $row_add->company_id;
            endforeach;

            
            $amount = mysql_real_escape_string($this->input->post('amount'));
            $purpose = mysql_real_escape_string($this->input->post('purpose'));

     date_default_timezone_set("Asia/Thimbu");

            $date = date('Y-m-d H:i:s');

            $data_designation = array(
                'employee_id' => $this->session->userdata('emp_id'),
                'company_id' => $company,
                'client_id' => $client,
                'project' => $project,
                'amount' => $amount,
                'purpose' => $purpose,
                'date' => $date
            );


            $insert_result = $this->common_model->insertData('advance_cash_requisition', $data_designation);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('advance_cash_requisition');
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

    public function getProject() {

        $data['base_url'] = $this->config->item('base_url');
        $com_id = mysql_real_escape_string($this->input->post('com_id'));
        $client_id = mysql_real_escape_string($this->input->post('client_id'));
        $table_name = 'project';
        $result = $this->common_model->getDataWhere2($table_name, "company_id", $com_id, "client_id", $client_id);

        if (count($result) > 0) {
            ?>
            <option value="">Select Project</option>
            <?php
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                <?php
            endforeach;
        }
    }

}
?>

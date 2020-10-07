<?php

class Leave_request extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Operation';
            $data['active_sub_menu'] = 'Leave Request';

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('leave_request/leave_request', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('leave_request/js_leave_request', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addLeaveRequest() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            
            $from_date = mysql_real_escape_string($this->input->post('from_date'));
            $to_date = mysql_real_escape_string($this->input->post('to_date'));
            $leave_type = mysql_real_escape_string($this->input->post('leave_type'));
            $reason = mysql_real_escape_string($this->input->post('reason'));
        
            
            $date = date('Y-m-d');

            $data_designation = array(
                'employee_id' => $this->session->userdata('emp_id'),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'leave_type' => $leave_type,
                'reason' => $reason,
                'date' => $date
                
            );


            $insert_result = $this->common_model->insertData('leave_request', $data_designation);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('leave_request');
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

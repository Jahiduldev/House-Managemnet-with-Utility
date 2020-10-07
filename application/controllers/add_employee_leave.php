<?php

class Add_employee_leave extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'HR';
            $data['active_sub_menu'] = 'Add Leave';


          
           
            
            $this->load->view('common/header', $data);
            $this->load->view('add_employee_leave/add_employee_leave', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_employee_leave/js_add_employee_leave', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addConfirmLeave() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');

            $edit_id = mysql_real_escape_string($this->input->post('edit_id'));
            $from_date = mysql_real_escape_string($this->input->post('from_date'));
            $to_date = mysql_real_escape_string($this->input->post('to_date'));
            $leave_type = mysql_real_escape_string($this->input->post('leave_type'));
            $reason = mysql_real_escape_string($this->input->post('remark'));
        
            
            $date = date('Y-m-d');

            $data_designation = array(
                'employee_id' => $edit_id,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'leave_type' => $leave_type,
                'reason' => $reason,
                'date' => $date
                
            );

            $insert_result = $this->common_model->insertData('confirm_leave_request', $data_designation);
         
            if ($insert_result > 0):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_employee_leave');
        else:
            redirect('home');
        endif;
    }

    public function getEmployeeInfo() {

        $data['base_url'] = $this->config->item('base_url');
        $emp_id = mysql_real_escape_string($this->input->post('emp_id'));

        $table_name = 'employee';
        $result = $this->common_model->getDataWhere($table_name, "emp_id", $emp_id);
        if (count($result) > 0):
            echo json_encode($result);
        else:
            echo "not matched";
        endif;
    }

}

?>

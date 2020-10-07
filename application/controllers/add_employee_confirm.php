<?php

class Add_employee_confirm extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'HR';
            $data['active_sub_menu'] = 'Add Confirmation';


          
           
            
            $this->load->view('common/header', $data);
            $this->load->view('add_employee_confirm/add_employee_confirm', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_employee_confirm/js_add_employee_confirm', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addConfirm() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');

            $edit_id = mysql_real_escape_string($this->input->post('edit_id'));
            $confirm_date = mysql_real_escape_string($this->input->post('confirm_date'));          


            $data_company = array(
                'confirm_date' => $confirm_date,
                'confirm_status' => 1,
            );


            $insert_result = $this->common_model->updateData('employee', $data_company,'id',$edit_id);


          
            
            
            if ($insert_result > 0):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_employee_confirm');
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

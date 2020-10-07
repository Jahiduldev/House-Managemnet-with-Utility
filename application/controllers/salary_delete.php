<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salary_delete extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;

        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Payroll';
            $data['active_sub_menu'] = 'Salary Delete';

            $data['get_employee_data'] = array();
			$query = $this->db->select('salary_month')->get('salary_process')->result_array(); 
			$data['dates'] = array_column($query, 'salary_month');
			
			
            
            $this->load->view('common/header', $data);
            $this->load->view('salary_delete/salary_delete', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('salary_delete/js_salary_delete', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function salaryProcess(){
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Payroll';
            $data['active_sub_menu'] = 'Salary Delete';
            
            $date_to = mysql_real_escape_string($this->input->post('date_to'));             
            
			$data['date_to'] = $date_to; //die();
            $table_name = 'employee';
            $data['get_employee_data'] = $this->common_model->getData($table_name, $data);
			$query = $this->db->select('salary_month')->get('salary_process')->result_array(); 
			$data['dates'] = array_column($query, 'salary_month');

            $this->load->view('common/header', $data);
            $this->load->view('salary_delete/salary_delete', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('salary_delete/js_salary_delete', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function salarySave() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');

            //$date_from = mysql_real_escape_string($this->input->post('date_from'));
            $date_to = mysql_real_escape_string($this->input->post('date_to'));
            //$data['date_from'] = $date_from;
            $data['date_to'] = $date_to;
            

            $date_all = explode("-", $date_to);
            $year = $date_all[0];
            $month = $date_all[1];
            $salary_month = $date_to . "-28";
			//die();  master_detail
			$salary = $this->db->where('salary_month', $salary_month)->get('salary_process')->result();			
			foreach($salary as $sal){
				
				$this->db->where('table_id', $sal->id)->where('table_type', 1)->where('transaction_type', 2)->delete('master_detail');
			}
            
			if($this->db->where('salary_month', $salary_month)->delete('salary_process')){

				$this->session->set_userdata('msg_title', 'Success');
				$this->session->set_userdata('msg_body', 'Successfull');
			}else{
				
				$this->session->set_userdata('msg_title', 'Failed');
				$this->session->set_userdata('msg_body', 'Please Try Again');
			}
            redirect('salary_delete');
        else:
            redirect('home');
        endif;
    }

    public function editMenu() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;

        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $id = mysql_real_escape_string($this->input->post('edit_type_id'));
            $type = mysql_real_escape_string($this->input->post('edit_type_name'));

            $data = array(
                'type' => $type,
                'date' => date('Y-m-d')
            );
            $table_name = 'salary_add_type';
            $insert_result = $this->common_model->updateData($table_name, $data, "id", $id);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('salary_add_type');
        else:
            redirect('home');
        endif;
    }

    public function getMenuData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'salary_add_type';
        $result = $this->common_model->getDataWhere($table_name, "id", $id);
        echo json_encode($result);
    }

    public function deleteMenu() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $delete_menu_id = mysql_real_escape_string($this->input->post('delete_menu_id'));


            $table_name = 'menu';
            $column_name = 'menu_id';
            $column_value = $delete_menu_id;
            $insert_result = $this->common_model->deleteData($table_name, $column_name, $column_value);


            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_menu');
        else:
            redirect('home');
        endif;
    }

}

?>

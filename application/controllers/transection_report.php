<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transection_report extends CI_Controller {

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
            $data['active_menu'] = 'Reports';
            $data['active_sub_menu'] = 'Transectrion Report';


            $date_from = mysql_real_escape_string($this->input->post('date_from'));
            $date_to = mysql_real_escape_string($this->input->post('date_to'));
            $r_type = mysql_real_escape_string($this->input->post('r_type'));

            $data['date_from'] = $date_from;
            $data['date_to'] = $date_to;
            $data['r_type'] = $r_type;
            $result = $this->db->query("select * from master_detail ");
            $data['get_report_data'] = $result->result();


            $this->load->view('common/header', $data);
            $this->load->view('transection_report/transection_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('transection_report/js_transection_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function salaryProcess() {
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

            $data['active_menu'] = 'Reports';
            $data['active_sub_menu'] = 'Transectrion Report';

            $date_from = mysql_real_escape_string($this->input->post('date_from'));
            $date_to = mysql_real_escape_string($this->input->post('date_to'));
            $r_type = mysql_real_escape_string($this->input->post('r_type'));

            $data['date_from'] = $date_from;
            $data['date_to'] = $date_to;
            $data['r_type'] = $r_type;
            if($date_from!='' && $date_to!='' && $r_type!=''):
            $result = $this->db->query("select * from master_detail where transaction_type='$r_type' and (date between '$date_from' and '$date_to')");
            elseif($date_from!='' && $date_to!=''):
              $result = $this->db->query("select * from master_detail where  (date between '$date_from' and '$date_to')"); 
            elseif($r_type!=''):
                 $result = $this->db->query("select * from master_detail where transaction_type='$r_type'");
            else:
                $result = $this->db->query("select * from master_detail");  
            endif;
            
            
            $data['get_report_data'] = $result->result();


            $this->load->view('common/header', $data);
            $this->load->view('transection_report/transection_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('transection_report/js_transection_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
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

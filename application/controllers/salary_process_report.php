<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salary_process_report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        $per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;

        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Reports';
            $data['active_sub_menu'] = 'Salary Process Report';
            $table_name='salary_process';
            $data['get_salary_deduct_data'] = $this->common_model->getData($table_name);
            
            
            $this->load->view('common/header',$data);
            $this->load->view('salary_process_report/salary_process_report',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('salary_process_report/js_salary_process_report',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
 public function get_date_data() {
        $per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;

        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Report';
            $data['active_sub_menu'] = 'Salary Process Report';
           
            
            $date_from = mysql_real_escape_string($this->input->post('date_from'));
            $date_to = mysql_real_escape_string($this->input->post('date_to'));
            

            $data['date_from'] = $date_from;
            $data['date_to'] = $date_to;
          
            $result = $this->db->query("select * from salary_process where  (salary_month between '$date_from' and '$date_to')");
            $data['get_salary_deduct_data'] = $result->result();
            
            
            $this->load->view('common/header',$data);
            $this->load->view('salary_process_report/salary_process_report',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('salary_process_report/js_salary_process_report',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
    public function addMenu() {
        $per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $type = mysql_real_escape_string($this->input->post('type'));

         
            $data = array(
                  
                    'type' => $type,
                    'date' =>date('Y-m-d')
            );
            $table_name='indirect_expense_type';
            $insert_result = $this->common_model->insertData($table_name, $data);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull' );
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('indirect_expense_type');
        else:
            redirect('home');
        endif;
    }

    public function editMenu() {
        $per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;

        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $id = mysql_real_escape_string($this->input->post('edit_salary_deduct_id'));
           
             $empy_id = mysql_real_escape_string($this->input->post('edit_empy_id'));
            $deduct_type = mysql_real_escape_string($this->input->post('edit_deduct_type'));
            $amount = mysql_real_escape_string($this->input->post('edit_deduct_amount'));
            $note = mysql_real_escape_string($this->input->post('edit_deduct_note'));
            
            $data = array(
                   'date' =>date('Y-m-d'),
                    'id' => $id,
                    'emp_id' => $empy_id,
                    'add_type' =>$deduct_type,
                    'amount' => $amount,
                    'note' =>$note,
                    
            );
            $table_name='employee_salary_add';
            $insert_result = $this->common_model->updateData($table_name, $data,"id",$id);

            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('salary_add_report');
        else:
            redirect('home');
        endif;
    }

    public function getMenuData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name='employee_salary_add';
        $result = $this->common_model->getDataWhere($table_name,"id",$id);
        echo json_encode($result);


    }


    public function deleteMenu() {
        $per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $delete_menu_id = mysql_real_escape_string($this->input->post('delete_menu_id'));


            $table_name='menu';
            $column_name='menu_id';
            $column_value=$delete_menu_id;
            $insert_result = $this->common_model->deleteData($table_name,$column_name,$column_value);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull' );
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('add_menu');
        else:
            redirect('home');
        endif;
    }



}
?>

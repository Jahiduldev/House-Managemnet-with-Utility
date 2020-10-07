<?php

class Add_User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Administrator';
            $data['active_sub_menu'] = 'Add User';
            $table_name = 'user_role';
            $data['get_role_data'] = $this->common_model->getData($table_name);
            $table_name = 'user';
            $data['get_user_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('add_user/add_user', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_user/js_add_user', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addUser() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $add_role = mysql_real_escape_string($this->input->post('add_role'));
            $add_full_name = mysql_real_escape_string($this->input->post('add_full_name'));
            $add_user_name = mysql_real_escape_string($this->input->post('add_user_name'));
            $add_password = mysql_real_escape_string($this->input->post('add_password'));
            $add_phone = mysql_real_escape_string($this->input->post('add_phone'));
            $add_email = mysql_real_escape_string($this->input->post('add_email'));
            $add_status = mysql_real_escape_string($this->input->post('add_status'));


         

            $get_result = $this->common_model->getDataWhere('user', 'user_name', $add_user_name);
            if (count($get_result) > 0):
                $this->session->set_userdata('msg_title', 'Warning');
                $this->session->set_userdata('msg_body', 'Sorry,username already used!');
                redirect('add_user');
            endif;
            date_default_timezone_set("Asia/Dhaka");
            $data = array(
                'role_id' => $add_role,
                'emp_id' => 0,
                'name' => $add_full_name,
                'user_name' => $add_user_name,
                'password' => base64_encode($add_password),
                'phone' => $add_phone,
                'email' => $add_email,
                'status' => $add_status,
                'date_time' => date('Y-m-d H:i:s')
            );
            $table_name = 'user';
            $insert_result = $this->common_model->insertData($table_name, $data);
            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_user');
        else:
            redirect('home');
        endif;
    }

    public function editUser() {

        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $user_id = mysql_real_escape_string($this->input->post('edit_user_id'));
            $edit_name = mysql_real_escape_string($this->input->post('edit_name'));
            $edit_phone = mysql_real_escape_string($this->input->post('edit_phone'));
            $edit_email = mysql_real_escape_string($this->input->post('edit_email'));
            $edit_status = mysql_real_escape_string($this->input->post('edit_status'));
            
            $edit_add_role = $this->input->post('edit_add_role');
            $edit_user_name = mysql_real_escape_string($this->input->post('edit_user_name'));
            $edit_password = mysql_real_escape_string($this->input->post('edit_password'));

 //$edit_uname= mysql_real_escape_string($this->input->post('edit_uname'));
// $edit_pass= mysql_real_escape_string($this->input->post('edit_pass'));

            
                  
              $data = array(
                   
                   'name' => $edit_name,
                   'phone' => $edit_phone,
                   'email' => $edit_email,
                   'user_name' => $edit_user_name,
                   'status' => $edit_status
              );
              if($edit_password !=''){ $data['password'] = base64_encode($edit_password); }
              if($edit_add_role !=''){ $data['role_id'] = $edit_add_role; }


            

          // $table_name = 'user';
           //$insert_result = $this->common_model->updateData($table_name, $data, "user_id", $user_id);


            if ($this->db->where('user_id', $user_id)->update('user', $data)):

                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:

                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;
                redirect('add_user');
        else:

            redirect('home');
        endif;
    }

    public function getMenuData() {

        $data['base_url'] = $this->config->item('base_url');
        $user_id = mysql_real_escape_string($this->input->post('user_id'));

        $table_name = 'user';
        $result = $this->common_model->getDataWhere($table_name, "user_id", $user_id);
        echo json_encode($result);
    }

}

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
          $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10))):
            redirect('dashboard');
        else:
            $data['base_url'] = $this->config->item('base_url');
            $this->load->view('login/login', $data);
			 $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        endif;
    }

    public function login() {



        $user_name = trim(mysql_real_escape_string($this->input->post('user_name')));
        $password = trim(mysql_real_escape_string($this->input->post('password')));
			
        $login_check = $this->home_model->loginCheck($user_name, base64_encode($password));

        if ($login_check->num_rows()):
            $user_id = $login_check->row()->user_id;
            $user_name = $login_check->row()->user_name;
			$name = $login_check->row()->name;
            $role_id = $login_check->row()->role_id;
            $emp_id = $login_check->row()->emp_id;
            $status = $login_check->row()->status;
            if($status ==2):
            $this->session->set_userdata('msg_title', 'Error');
            $this->session->set_userdata('msg_body', 'Sorry,You are not active employee.');
            redirect('home');
            endif;
            $this->session->set_userdata('user_id', $user_id);
            $this->session->set_userdata('user_name', $user_name);
			$this->session->set_userdata('name', $name);
            $this->session->set_userdata('role_id', $role_id);
            $this->session->set_userdata('emp_id', $emp_id);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
            if($status ==5):
               redirect('change_password');
            endif;
			if($role_id ==3):
			 redirect('home');
			endif;
            redirect('home');
        else:
            $this->session->set_userdata('msg_title', 'Error');
            $this->session->set_userdata('msg_body', 'Wrong Username Or Password');
            redirect('home');
        endif;
    }

      public function login_new() {

        $old_password = trim(mysql_real_escape_string($this->input->post('old_password')));
        $new_password = trim(mysql_real_escape_string($this->input->post('new_password')));
     
        $user_name = $this->session->userdata('user_name');


        $lenstring = strlen($new_password);
        if($old_password==$new_password):
            $this->session->set_userdata('msg_title', 'Error');
            $this->session->set_userdata('msg_body', 'You must put a different new password');
            redirect('change_password');
        else:
            if (!ctype_alpha($new_password) && !ctype_digit($new_password)) {
                // echo "The string $new_password consists of all letters or digits.\n";

            } else {
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'New password must contain alphabet and numbers.');
                redirect('change_password');
                //   echo "The string $new_password does not consist of all letters or digits.\n";
            }



            $login_check = $this->home_model->loginCheck($user_name, base64_encode($old_password));
            if ($login_check->num_rows()):
                $id = $login_check->row()->user_id;
                $data_array = array(
                        'password'=>base64_encode($new_password),
                    //    'email'=>$email_add,
                        'status'=>1
                );
                $result = $this->common_model->updateData('user',$data_array,'user_id',$id);

                if($result):
                    $this->logout();

                endif;
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Wrong old Password');
                redirect('change_password');

            endif;
        endif;

    }

    public function logout() {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('role_id');

        //   $this->session->sess_destroy();
        $this->session->set_userdata('msg_title', 'Success');
        $this->session->set_userdata('msg_body', 'Logout Successfully');

        redirect('home');
    }
}


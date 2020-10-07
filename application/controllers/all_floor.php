<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_floor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'House Configuration';
            $data['active_sub_menu'] = 'View Floor';

            $table_name = 'add_floor';
            $data['project_data'] = $this->common_model->getDataWhere_floor($table_name,'status','1');

            $this->load->view('common/header', $data);
            $this->load->view('all_floor/all_floor', $data);
            $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('all_floor/js_all_floor', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addPayment() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');

            date_default_timezone_set("Asia/Thimbu");
			
			$datetime=date('Y-m-d');
             $id = mysql_real_escape_string($this->input->post('id'));
			$name_house = mysql_real_escape_string($this->input->post('name_house'));
            $floor_name = mysql_real_escape_string($this->input->post('floor_name'));
            $floor_code = mysql_real_escape_string($this->input->post('floor_code'));
            $notes = mysql_real_escape_string($this->input->post('notes'));			
		
           
			$res_clients= $this->db->query("update  add_floor set hid='$name_house', floor_name='$floor_name',floor_code='$floor_code',notes='$notes'
			where id=$id ");
						
            if ($res_clients):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;

            redirect('all_floor');
        else:

            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'add_floor';
        $result = $this->common_model->getDataWhere($table_name, "id", $id);
        echo json_encode($result);
    }

public function delfloor() {

         $this->db->where('id', $this->input->post('id'));
                  if($this->db->update('add_floor', array('status'=>0)))
                  echo 'Floor Deleted !';      
    }

    public function getDetails($passport_no) {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Accounts';
            $data['active_sub_menu'] = 'Passport Payment';

            $table_name = 'passport_makings';
            $data['passport_amount_data'] = $this->common_model->getDataWhere($table_name, "passport_no", $passport_no);

            $table_name = 'passport_payment';
            $data['passport_detail_data'] = $this->common_model->getDataWhere($table_name, "passport_no", $passport_no);


            $this->load->view('common/header', $data);
            $this->load->view('payment_detail/payment_detail', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('payment_detail/js_payment_detail', $data);

        else:
            redirect('home');
        endif;
    }

}

?>

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class View_wasa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Bill Management';
            $data['active_sub_menu'] = 'View WASA';

            $table_name = 'wasa_meter';
            $data['project_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('view_wasa/view_wasa', $data);
            $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('view_wasa/js_view_wasa', $data);
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
			
            $name = mysql_real_escape_string($this->input->post('name'));
            $acct_number = mysql_real_escape_string($this->input->post('acct_number'));
            $meter_number = mysql_real_escape_string($this->input->post('meter_number'));			
			$address = mysql_real_escape_string($this->input->post('address'));
            $notes = mysql_real_escape_string($this->input->post('notes'));
			
            
           
			$res_clients= $this->db->query("update  wasa_meter set name='$name',address='$address',acct_number='$acct_number',meter_number='$meter_number',notes='$notes'
			where id=$id ");
			
			
				$res_clients= $this->db->query("update  wasa_bill set acct_number='$acct_number',meter_number='$meter_number'
			where relid=$id ");
			
						
            if ($res_clients):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;

            redirect('view_wasa');
        else:

            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'wasa_meter';
        $result = $this->common_model->getDataWhere($table_name, "id", $id);
        echo json_encode($result);
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

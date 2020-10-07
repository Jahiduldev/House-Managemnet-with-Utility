<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Update_gas_bill extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Bill Management';
            $data['active_sub_menu'] = 'Update TITAS Bill';

            $table_name = 'gas_bill';
            $data['project_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('update_gas_bill/update_gas_bill', $data);
            $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('update_gas_bill/js_update_gas_bill', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addPayment() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');

            date_default_timezone_set("Asia/Dhaka");

            $lastdate = date('Y-m-d H:i:s');
			
	        $datetime=date('Y-m-d');
            $id = mysql_real_escape_string($this->input->post('id'));
	        $mont = $this->input->post('mont');
            $single = mysql_real_escape_string($this->input->post('single'));
            $sin_amount = mysql_real_escape_string($this->input->post('sin_amount'));
            $doubles = mysql_real_escape_string($this->input->post('doubles'));			
			$dob_amount = mysql_real_escape_string($this->input->post('dob_amount'));
            $note = mysql_real_escape_string($this->input->post('note'));
		
			$amount= mysql_real_escape_string($this->input->post('amount'));
			
           
		$res_clients= $this->db->query("update gas_bill set  single='$single',mont='$mont',doubles='$doubles',sin_amount='$sin_amount',dob_amount='$dob_amount',note='$note',amount='$amount',last_update='$lastdate'
			, status='0' where id='$id' ");
						
            if ($res_clients):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;

            redirect('update_gas_bill');
        else:

            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'gas_bill';
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
    
    public function checkpayment() {
		
        if($this->db->where('rid', $this->input->post('id'))->where('mont', $this->input->post('date'))->get('gas_bill_payment')->num_rows() !=0){
			
			echo 1;			
		}else{
			
			echo 0;
		}
	}
}

?>

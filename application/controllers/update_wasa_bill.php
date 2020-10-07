<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Update_wasa_bill extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Bill Management';
            $data['active_sub_menu'] = 'Update WASA Bill';

            $table_name = 'wasa_bill';
            $data['project_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('update_wasa_bill/update_wasa_bill', $data);
               $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('update_wasa_bill/js_update_wasa_bill', $data);
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
			
            $bill_numebr = mysql_real_escape_string($this->input->post('bill_numebr'));
			$mont = $this->input->post('mont');
            $issue_date = mysql_real_escape_string($this->input->post('issue_date'));
            $due_date = mysql_real_escape_string($this->input->post('due_date'));			
			$pre_unit = mysql_real_escape_string($this->input->post('pre_unit'));
            $cur_unit = mysql_real_escape_string($this->input->post('cur_unit'));
			$total_unit = mysql_real_escape_string($this->input->post('total_unit'));
            $unit_rate = mysql_real_escape_string($this->input->post('unit_rate'));
			
			
			
			$amount = mysql_real_escape_string($this->input->post('amount'));
            $due_amount = mysql_real_escape_string($this->input->post('due_amount'));
			$note = mysql_real_escape_string($this->input->post('note'));
            
           
			$res_clients= $this->db->query("update wasa_bill set  bill_numebr='$bill_numebr',mont='$mont',issue_date='$issue_date',due_date='$due_date',pre_unit='$pre_unit',cur_unit='$cur_unit',
			total_unit='$total_unit',unit_rate='$unit_rate',amount='$amount',due_amount='$due_amount',note='$note',status=0,last_update='$datetime'
			where id='$id'");
						
            if ($res_clients):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;

            redirect('update_wasa_bill');
        else:

            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'wasa_bill';
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
		
        if($this->db->where('rid', $this->input->post('id'))->where('mont', $this->input->post('date'))->get('wasa_bill_payment')->num_rows() !=0){
			
			echo 1;			
		}else{
			
			echo 0;
		}
	}

}

?>

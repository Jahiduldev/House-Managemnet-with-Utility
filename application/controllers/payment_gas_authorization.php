<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_gas_authorization extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Bill Management';
            $data['active_sub_menu'] = 'Payment TITAS Bill';

            $table_name = 'gas_bill';
            $data['project_data'] = $this->common_model->getDataWhere4($table_name,'authorization',3);
             
           
            $data['houses'] = $this->db->get('add_house')->result();
            $this->load->view('common/header', $data);
            $this->load->view('payment_gas_authorization/payment_gas_authorization', $data);
               $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('payment_gas_authorization/js_payment_gas_authorization', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
    
     public function searchData() {

        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Bill Management';
            $data['active_sub_menu'] = 'Payment TITAS Bill';

            $table_name = 'add_house';
            $data['desco_meter'] = $this->common_model->getData($table_name);

            $date_from= $this->input->post('date_from');
            $data['dtfrm']=$this->input->post('date_from');
            $date_to=$this->input->post('date_to');
            $data['dtrto']=$this->input->post('date_to');
            $data['house'] = $desco_meter = $this->input->post('desco_meter'); //die();
            $desco_meter=$this->input->post('desco_meter');
            $data['houses'] = $this->db->get('add_house')->result();
            

            $table_name = 'gas_bill';
            $data['project_data'] = $this->common_model->getDataWhere4($table_name, 'status', 0);
           
             
            if($desco_meter!="" && $date_from!="" && $date_to!=""):
                
                $date_from = $date_from.' 00:00:00';
                $date_to = $date_to.' 23:59:59';
                
                $result= $this->db->query("select * from gas_bill where last_update between '$date_from' and '$date_to' and hid='$desco_meter' and status='0'");
                $data['project_data'] = $result->result();

            elseif($date_from!="" && $date_to!="" && $desco_meter==""):
                $date_from = $date_from.' 00:00:00';
                $date_to = $date_to.' 23:59:59';
                $result= $this->db->query("select * from gas_bill where last_update between '$date_from' and '$date_to' and status='0'");
                $data['project_data'] = $result->result();
                
            elseif($date_from=="" && $date_to=="" && $desco_meter!=""):
                
                //echo 'sfgf'; die();
                $data['project_data'] = $this->db->where('hid', $desco_meter)->where('status', 0)->get($table_name)->result();
          
            endif;
                
            
            $this->load->view('common/header', $data);
            $this->load->view('payment_gas_bill/payment_gas_bill', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('payment_gas_bill/js_payment_gas_bill', $data);
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
            $hidfinal = mysql_real_escape_string($this->input->post('hidfinal'));	
			$single = mysql_real_escape_string($this->input->post('single'));	


$trx= mysql_real_escape_string($this->input->post('trx'));	

			$sin_amount = mysql_real_escape_string($this->input->post('sin_amount'));
			$mont = mysql_real_escape_string($this->input->post('mont'));
            $sin_pay = mysql_real_escape_string($this->input->post('sin_pay'));
            $doubles = mysql_real_escape_string($this->input->post('doubles'));
            $dob_amount = mysql_real_escape_string($this->input->post('dob_amount'));				
			$dob_pay = mysql_real_escape_string($this->input->post('dob_pay'));
            $payment_type = mysql_real_escape_string($this->input->post('payment_type'));
			$payment_date = mysql_real_escape_string($this->input->post('payment_date'));
            $note = mysql_real_escape_string($this->input->post('note'));					
			 
		   
		     $res_clients= $this->db->query("update gas_bill set  status=1,authorization=0 where id=$id ");
			
		    $res_clients= $this->db->query("update gas_bill_payment set  authorization=1 where rid=$id ");
            redirect('payment_gas_authorization');
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
    
    public function cancelpayment(){  
		
        $id = $this->input->post('id');	
		$this->db->where('id', $id)->update('gas_bill', array('status'=>'1'));
		echo 'Payment Deleted Successfuly';
	
	}

}

?>

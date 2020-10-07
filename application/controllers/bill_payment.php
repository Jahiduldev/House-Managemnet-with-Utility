<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bill_payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'Bill Update';

            $table_name = 'house_client';
            
            if($this->session->userdata('houseid')!=''){
				$data['houseid'] = $houseid = $this->session->userdata('houseid');
                //$data['project_data'] = $this->common_model->getDataWhere4($table_name,'bill_status',0);
                $data['project_data'] = $this->db->where('bill_status', 0)->where('house', $houseid)->get($table_name)->result();
            }
            
            $data['houses'] = $this->db->get('add_house')->result();
            $this->load->view('common/header', $data);
            $this->load->view('bill_payment/bill_payment', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('bill_payment/js_bill_payment', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
    public function get_house() {        
			 
	    $this->session->set_userdata('houseid', $this->input->post('houseid'));            
        redirect('bill_payment');        
    }
    public function addPayment() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');

date_default_timezone_set("Asia/Thimbu");
            $id = mysql_real_escape_string($this->input->post('id'));
			
			
			
			$client_id = mysql_real_escape_string($this->input->post('client_id'));	
            $rent = mysql_real_escape_string($this->input->post('rent'));
            $elec = mysql_real_escape_string($this->input->post('elec'));
            $gas = mysql_real_escape_string($this->input->post('gas'));
			$water = mysql_real_escape_string($this->input->post('water'));
            $service = mysql_real_escape_string($this->input->post('service'));
			$garage = mysql_real_escape_string($this->input->post('garage'));
            $note = mysql_real_escape_string($this->input->post('note'));
            $payment_type = mysql_real_escape_string($this->input->post('payment_type'));
			$payment_date = mysql_real_escape_string($this->input->post('payment_date'));
			$note = mysql_real_escape_string($this->input->post('notes'));
			$hid = mysql_real_escape_string($this->input->post('hid'));
			$mont = mysql_real_escape_string($this->input->post('mont'));
			$pu = mysql_real_escape_string($this->input->post('pu'));
			$cu = mysql_real_escape_string($this->input->post('cu'));
			$da = mysql_real_escape_string($this->input->post('da'));
			$trx = mysql_real_escape_string($this->input->post('trx'));
			
			$late = mysql_real_escape_string($this->input->post('late'));
			
			
			
			$rent_total = mysql_real_escape_string($this->input->post('rent_total1'));
			$rent_payment = mysql_real_escape_string($this->input->post('rent_payment'));
			
			
			$utility_total = mysql_real_escape_string($this->input->post('utility_total1'));
			$utility_payment = mysql_real_escape_string($this->input->post('utility_payment'));
			
			$current_due = (int)$rent_total - (int)$rent_payment;
			$utility_due = (int)$utility_total - (int)$utility_payment;
			
			$payment_amount = mysql_real_escape_string($this->input->post('total_payment'));
            
			$total = mysql_real_escape_string($this->input->post('total_payment_amount'));
			
			 
			$sendsms = mysql_real_escape_string($this->input->post('sendsms'));
			
			$date = date('Y-m-d');
			
			
		 
			$query_12 = $this->db->query("select * from bill where clinet_id='$id' and bill_id =7" );
                                        $result_12 = $query_12->result();
                                        foreach ($result_12 as $row_add):
                                            $arrears = $row_add->amount;
											
                                        endforeach;
			
			
				$query_1 = $this->db->query("select * from house_client where id='$id'" );
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $client_name = $row_add->client_name;
											$add_mobile_number = $row_add->mobile_number;
											$spacecode = $row_add->code;
                                        endforeach;
			
			
			
			if($add_mobile_number !=''&& $sendsms==3)
				{
					
	$msgfinal5 = "Dear $client_name
In the month of $mont your Space Code $spacecode Rent $rent, Electricity Bill $elec,Gas Bill $gas, Water Bill $water,Service Charge $service, Garage Rent $garage, Arrears $arrears Total  $total Tk, Plz pay before 15th March  to avoid the fine. Happy Living In Dhaka ";
	
	                           $lng = strlen($msgfinal5);								
							   $nm = ($lng/158);
							   $nmfinal = round($nm);
	
	                           if($nmfinal<1)
								{
									
									$nmfinal = 1;
								}
	
	
	
			              $msgfinal  = urlencode($msgfinal5); 
								 $url = "http://2aitbd.com/2abulksms/remote_access_script_greeha.php";		                      	
		                         $data = "user=greeha&pass=gree3322&text=$msgfinal&mobile=$add_mobile_number";
                           echo      $all = $url.'?'.$data;       

					   
		                    	echo $reply=file_get_contents($all);
			
			
			     $data22 = array(
                    'mob' => $add_mobile_number,
                    'sms' => $msgfinal5,
                    'cnt' => $nmfinal,
                    'type' => 1,
                    'datetime' => date('Y-m-d H:i:s')
					
                );
          

            $table_name = 'sms_history';
            $insert_result = $this->common_model->insertDataGetId($table_name, $data22);
			
			
			
			$res_clients= $this->db->query("update  total_sms set total=total-$nmfinal ");
			
			
			
                 }			
			
			
	 
			
			
			
			
			
			//$current_due = $total-$payment_amount;
			
			
			 $date = date('Y-m-d');

             $data_department = array(
                'status' => 1               
            );

            $insert_result = $this->common_model->updateData('bill', $data_department, 'clinet_id', $id);
			
			
			
			$res_clients12= $this->db->query("update bill set  amount=$current_due where clinet_id='$id' and bill_id =7");
			$res_clients12= $this->db->query("update bill set  amount=$utility_due where clinet_id='$id' and bill_id =10");
			
			
			  $data_client = array(
                'bill_status' => 1,
                 'bill_authorization' => 3,
                'last_payment_date' => $payment_date			
            );

            $insert_result = $this->common_model->updateData('house_client', $data_client, 'id', $id);
			
			$data = array(
			    
                'clinet_id' => $id,
                'rent' => $rent,
				'electrict' => $elec,
				'gas' => $gas,
				'water' => $water,
				'service' => $service,
				'mont' => $mont,
				'pu' => $pu,
				'cu' => $cu,
				'hid' => $hid,
				'garage' => $garage,
                'trx' => $trx,
				'total' => $total,
				'payment_type' => $payment_type,
				'current_due' => $current_due,
				'utility_due' => $utility_due,
				'rent_pay' => $rent_payment,
				'utility_pay' => $utility_payment,
				'pay_amount' => $payment_amount,
				'late' => $late,
				'pay_date' => $payment_date,
				'note' => $note,
				'status' => 1,
                'default_date' => date('Y-m-d')
            );
          

            $table_name = 'bill_payment';
            $insert_result = $this->common_model->insertDataGetId($table_name, $data);

            $data = array(
                'company_id' => 3,
                'table_id' => $insert_result,
                'table_type' => 7,
                'transaction_type' => 1,
                'date' => $payment_date,
				'status' => 1,
                'default_date' => date('Y-m-d')
            );

            $table_name = 'master_detail';
            $insert_result = $this->common_model->insertDataGetId($table_name, $data);
           

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('bill_payment');
        else:

            redirect('home');
        endif;
        
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'house_client';
        $result = $this->common_model->getbillupdate($id);
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
		//$m = explode('/',$this->db->where('id', $id)->get('house_client')->row()->mont);
		//$pre_month = date('Y-m-d', strtotime("-1 months", strtotime('01-'.$m[0].'-'.$m[1]))); 
		//$mont = date('m/y', strtotime($pre_month)); 
		//if($this->db->where('id', $id)->update('house_client', array('bill_status'=>1, 'mont'=>$mont))){
		if($this->db->where('id', $id)->update('house_client', array('bill_status'=>1))){
		    
		   $this->db->where('clinet_id', $id)->where('bill_id', 7)->update('bill', array('amount'=>0));
		   $this->db->where('clinet_id', $id)->where('bill_id', 10)->update('bill', array('amount'=>0));
		echo 'Payment Deleted Successfuly';
		}else{ echo 'Payment Delete Failed !'; }
	
	
	}

}

?>

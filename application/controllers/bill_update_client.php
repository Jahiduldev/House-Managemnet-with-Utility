<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bill_update_client extends CI_Controller {

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
			$emp_id = $this->session->userdata('emp_id');
				
				$data['project_data'] = $this->common_model->getDataWhere($table_name, "id", $emp_id);
						
			$data['houses'] = $this->db->get('add_house')->result();

            $this->load->view('common/header', $data);
            $this->load->view('bill_update_client/bill_update_client', $data);
            $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('bill_update_client/js_bill_update_client', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

   public function get_house() {        
			 
	    $this->session->set_userdata('houseid', $this->input->post('houseid'));            
            redirect('bill_update');        
    }
    public function addPayment() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');

            date_default_timezone_set("Asia/Thimbu");
			
			$datetime=date('Y:m:d');
            $id = mysql_real_escape_string($this->input->post('id'));
			$sendsms = mysql_real_escape_string($this->input->post('sendsms'));
            $rent = mysql_real_escape_string($this->input->post('rent'));
            $elec = mysql_real_escape_string($this->input->post('elec'));
            $gas = mysql_real_escape_string($this->input->post('gas'));
			
			$mont = mysql_real_escape_string($this->input->post('mont'));
			$totalamount = mysql_real_escape_string($this->input->post('totalamount'));
            $totaltotal  = mysql_real_escape_string($this->input->post('totaltotal'));
			
			$pu = mysql_real_escape_string($this->input->post('pu'));
			$cu = mysql_real_escape_string($this->input->post('cu'));
			$da = mysql_real_escape_string($this->input->post('da'));
			$uda = mysql_real_escape_string($this->input->post('uda'));
			
			$water = mysql_real_escape_string($this->input->post('water'));
            $service = mysql_real_escape_string($this->input->post('service'));
			$garage = mysql_real_escape_string($this->input->post('garage'));
            $note = mysql_real_escape_string($this->input->post('note'));
            $unitrate= mysql_real_escape_string($this->input->post('unitrate'));
			
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
			
			
			
			if($add_mobile_number !=''&& $sendsms==3){
					
	            $msgfinal5 = "Dear $client_name
                In the month of $mont your Space Code $spacecode Rent $rent, Electricity Bill $elec,Gas Bill $gas, Water Bill $water,Service Charge $service, Garage Rent $garage, Arrears $arrears Total  $totaltotal Tk, Plz pay before 15th March  to avoid the fine. Happy Living In Dhaka ";
	
                   $lng = strlen($msgfinal5);								
				   $nm = ($lng/158);
				   $nmfinal = round($nm);
                   if($nmfinal<1){
							
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
			
			
		
			
			
			
			
			
			
			$lastdate= date('Y-m-d H:i:s');
			 
			$res_clientsf= $this->db->query("update house_client set bill_status = '0', elec_rate='$unitrate',  mont='$mont', totalamount='$totaltotal', last_payment_date='$lastdate', note='$note', pre_due='$da', pre_uti_due='$uda' where id='$id'");
           
			$res_clients= $this->db->query("update bill set  amount='$rent' where clinet_id='$id' and bill_id =1");
			
			$res_clients= $this->db->query("update bill set  amount='$elec' where clinet_id='$id' and bill_id =2");
				
			
			$res_clients= $this->db->query("update bill set  amount='$da' where clinet_id='$id' and bill_id =7");
			$res_clients= $this->db->query("update bill set  amount='$pu' where clinet_id='$id' and bill_id =8");
			$res_clients= $this->db->query("update bill set  amount='$cu' where clinet_id='$id' and bill_id =9");
			$res_clients= $this->db->query("update bill set  amount='$uda' where clinet_id='$id' and bill_id =10");
			
			$res_clients= $this->db->query("update bill set  amount='$gas' where clinet_id='$id' and bill_id =3");
				
			
           
			$res_clients= $this->db->query("update bill set  amount='$water' where clinet_id='$id' and bill_id =4");
		
			
			$res_clients= $this->db->query("update bill set  amount='$service' where clinet_id='$id' and bill_id =5");
			$res_clients= $this->db->query("update bill set  amount='$garage' where clinet_id='$id' and bill_id =6");
				
		        $res_clients= $this->db->query("update bill set  datetime='$datetime' where clinet_id='$id' ");
			   
		       $res_clients= $this->db->query("update bill set  comments='$note' where clinet_id='$id' ");

            if ($res_clients):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;

            redirect('bill_update');
        else:

            redirect('home');
        endif;
    }


public function addPayment2() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');

            date_default_timezone_set("Asia/Dhaka");
			
			$datetime=date('Y:m:d');
            $id = mysql_real_escape_string($this->input->post('id'));
			
            $rent = mysql_real_escape_string($this->input->post('rent'));
            $elec = mysql_real_escape_string($this->input->post('elec'));
            $gas = mysql_real_escape_string($this->input->post('gas'));
			
			$mont = mysql_real_escape_string($this->input->post('mont'));
			$totalamount = mysql_real_escape_string($this->input->post('totalamount'));
            $totaltotal  = mysql_real_escape_string($this->input->post('totaltotal'));
			
			$pu = mysql_real_escape_string($this->input->post('pu'));
			$cu = mysql_real_escape_string($this->input->post('cu'));
			  
			$da = mysql_real_escape_string($this->input->post('da'));
			
			$water = mysql_real_escape_string($this->input->post('water'));
            $service = mysql_real_escape_string($this->input->post('service'));
			$garage = mysql_real_escape_string($this->input->post('garage'));
            $note = mysql_real_escape_string($this->input->post('note'));
			$unitrate= mysql_real_escape_string($this->input->post('unitrate'));			 
			
			 
			$res_clientsf= $this->db->query("update house_client set elec_rate='$unitrate',  mont='$mont',totalamount='$totaltotal' where id='$id'");
           
			$res_clients= $this->db->query("update bill set  amount='$rent' where clinet_id='$id' and bill_id =1");
			
			$res_clients= $this->db->query("update bill set  amount='$elec' where clinet_id='$id' and bill_id =2");
				
			
			$res_clients= $this->db->query("update bill set  amount='$da' where clinet_id='$id' and bill_id =7");
			$res_clients= $this->db->query("update bill set  amount='$pu' where clinet_id='$id' and bill_id =8");
			$res_clients= $this->db->query("update bill set  amount='$cu' where clinet_id='$id' and bill_id =9");
			
			$res_clients= $this->db->query("update bill set  amount='$gas' where clinet_id='$id' and bill_id =3");
				
		    $res_clients= $this->db->query("update bill set  amount='$water' where clinet_id='$id' and bill_id =4");
		
			
			$res_clients= $this->db->query("update bill set  amount='$service' where clinet_id='$id' and bill_id =5");
			$res_clients= $this->db->query("update bill set  amount='$garage' where clinet_id='$id' and bill_id =6");
				
		    $res_clients= $this->db->query("update bill set  datetime='$datetime' where clinet_id='$id' ");
			   
		    $res_clients= $this->db->query("update bill set  comments='$note' where clinet_id='$id' ");

            if ($res_clients):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;

            redirect('bill_update');
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

     public function checkpayment() {
		
        if($this->db->where('clinet_id', $this->input->post('id'))->where('mont', $this->input->post('date'))->where('note !=', 'Advance')->get('bill_payment')->num_rows() !=0){
			
			echo 1;			
		}else{
			
			echo 0;
		}
	}

}

?>

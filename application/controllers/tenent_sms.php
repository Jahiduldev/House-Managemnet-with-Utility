<?php

class Tenent_sms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Tenant Mngt';
            $data['active_sub_menu'] = 'Tenant SMS';

            $table_name = 'add_house';
            $data['add_house'] = $this->common_model->getData($table_name);
            $data['smsese'] = $this->common_model->getData('smslog');
             
            $this->load->view('common/header', $data);
            $this->load->view('tenent_sms/tenent_sms', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('tenent_sms/js_tenent_sms', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function send_sms() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))){
            
			$data['base_url'] = $this->config->item('base_url');            
            $houseid = mysql_real_escape_string($this->input->post('houseid'));
            $housesms = mysql_real_escape_string($this->input->post('housesms'));
            
			$this->db->insert('sendsms', array('sms'=>$housesms, 'date'=>date('Y-m-d')));
			$smsid = $this->db->insert_id(); //die();
			
			$tenants = $this->db->where('house', $houseid)->get('house_client')->result();
			foreach($tenants as $tenant){				
				$smses[] = array(					
					'smsid' => $smsid,
					'house_id' => $houseid,
					'phonenumber' => $tenant->mobile_number					 
				);					
			}
			if($this->db->insert_batch('smslog', $smses)){
            
				redirect('tenent_sms');
			}
			
        }else{
            redirect('home');
        }
    }
	
	public function send_bulk_sms() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))){
            
			$data['base_url'] = $this->config->item('base_url');            
            $add_mobile_number = mysql_real_escape_string($this->input->post('bulknumber'));
            $msgfinal5 = mysql_real_escape_string($this->input->post('bulksms'));
            
			

			if($add_mobile_number !=''){

				
				$lng = strlen($msgfinal5);								
				$nm = ($lng/158);
				$nmfinal = round($nm);

				if($nmfinal<1){

					$nmfinal = 1;	
				}



				$msgfinal  = urlencode($msgfinal5); 
				$url = "http://2aitbd.com/2abulksms/remote_access_script_greeha.php";		                      	
				$data = "user=greeha&pass=gree3322&text=$msgfinal&mobile=$add_mobile_number";
				$all = $url.'?'.$data;       


				$reply=file_get_contents($all);


				$data22 = array(
					
					'mob' => $add_mobile_number,
					'sms' => $msgfinal5,
					'cnt' => $nmfinal,
					'type' => 1,
					'datetime' => date('Y-m-d H:i:s')
				);


				$table_name = 'sms_history';
				$insert_result = $this->common_model->insertDataGetId($table_name, $data22);
				$res_clients = $this->db->query("update  total_sms set total=total-$nmfinal ");
			}	
			redirect('tenent_sms');
			
			
        }else{
            redirect('home');
        }
    }

}

?>

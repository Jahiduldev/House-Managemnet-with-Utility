<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Add_floor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'House Configuration';
            $data['active_sub_menu'] = 'Add Floor';

         	
			
			$data['headlist'] = $this->db->get('add_house')->result();
			

            $this->load->view('common/header', $data);
            $this->load->view('add_floor/add_floor', $data);
            $this->load->view('add_floor/js_add_floor', $data);
            $this->load->view('common/js', $data);
            $this->load->view('common/footer', $data);
			
        else:
            redirect('home');
        endif;
    }

    public function addPayment() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');

			date_default_timezone_set("Asia/Dhaka");
            $house = $this->input->post('house');
           
			
            $floorname = $this->input->post('floorname'); 
			$floorcode = $this->input->post('floorcode');
			$notes = $this->input->post('notes');
		    $cnt = count($floorname);
	        $cnt = $cnt-1;
            $date_time = date('Y-m-d');
			for( $i=0;$i<=$cnt;$i++) {
				
				
					  $result= $this->db->query("insert into add_floor values('NULL','$house','$floorname[$i]','$floorcode[$i]','$notes[$i]','1','$date_time')");
         
			
			}
		
			
            if ($result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_floor');
        else:
            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'passport_makings';
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
	public function checkcreditvno() {	
				
		$row = $this->db->where('vno', 'JV-'.date('y').'-'.$this->input->post('vno'))->get('journal');		
		if($row->num_rows()==0){ echo 'ok';	}else{ 	echo 'notok'; }	
	}
}

?>

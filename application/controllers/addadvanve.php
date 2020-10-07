<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Addadvanve extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
		
		
		$houses = $this->db->get('house_client')->result();$sl=1;
		foreach($houses as $hous){
			if(is_numeric($hous->advance) && (int)$hous->advance !=0){
				
				//echo $hous->advance.'<br>';
				
				$data = array(
				
					
					'mont' => '01/2019',
					
				);
				
				$table_name = 'bill_payment';
				$insert_result = $this->db->where('clinet_id',$hous->id)->update($table_name, $data);
				$sl++;
			}
		}
		echo $sl;
    }

    public function addPayment(){


       
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
	
	
	
	    public function getFloor() {

        $data['base_url'] = $this->config->item('base_url');
        $house_id = mysql_real_escape_string($this->input->post('house_id'));

        $table_name = 'add_floor';
        $result = $this->common_model->getDataWhere($table_name, "hid", $house_id);
        echo '<option value="">Select Floor</option>';
        if (count($result) > 0) {
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->floor_name.'-'.$row->floor_code; ?></option>
                <?php
            endforeach;
        }
    }

	
	
	
}

?>

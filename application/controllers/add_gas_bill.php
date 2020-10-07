<?php

class Add_gas_bill extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Bill Management';
            $data['active_sub_menu'] = 'Add GAS Bill';
  
            $table_name = 'add_house';
            $data['headlist'] = $this->db->get('add_house')->result();
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('add_gas_bill/add_gas_bill', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_gas_bill/js_add_gas_bill', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addDepartmentData() {
        
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            
            $house   = mysql_real_escape_string($this->input->post('house'));
            $floor = mysql_real_escape_string($this->input->post('floor'));
            $flat  = mysql_real_escape_string($this->input->post('flat'));
            $sbn = mysql_real_escape_string($this->input->post('sbn'));
            $dbn = mysql_real_escape_string($this->input->post('dbn'));
			$billing_name = $this->input->post('billing_name');
            $titas_id= $this->input->post('titas_id');
			$billing_address = $this->input->post('billing_address');
			$sba = mysql_real_escape_string($this->input->post('sba'));
            $dba = mysql_real_escape_string($this->input->post('dba'));
			$note = mysql_real_escape_string($this->input->post('note'));
           
            $date = date('Y-m-d');

            $get_result = $this->common_model->getDataWhere('gas_bill', 'hid', $hid);
            if (count($get_result) > 0):
                $this->session->set_userdata('msg_title', 'Warning');
                $this->session->set_userdata('msg_body', 'Sorry,GAS Bill already Configured!');
                redirect('add_gas_bill');
            endif;

            $data_department = array(
                
                'hid' => $house,
                'floid' => $floor,
                'fltid' => $flat,
                'single' => $sbn,
				'doubles' => $dbn,
				'name' => $billing_name,
                'titas_id' => $titas_id,
				'address' => $billing_address,
                'sin_amount' => $sba,
				'dob_amount' => $dba,
				'note' => $note,
                'last_update' => $date,
                'status' => 1
            );


            $insert_result = $this->common_model->insertData('gas_bill', $data_department);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_gas_bill');
        else:
            redirect('home');
        endif;
    }

}

?>

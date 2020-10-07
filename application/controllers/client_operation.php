<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_operation extends CI_Controller {

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
            $data['project_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('client_operation/client_operation', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('client_operation/js_client_operation', $data);
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
            $id = mysql_real_escape_string($this->input->post('id'));
			
			
	
          
            $status = mysql_real_escape_string($this->input->post('status'));
			
			$operation_date = mysql_real_escape_string($this->input->post('operation_date'));
			$note = mysql_real_escape_string($this->input->post('notes'));
			 $date = date('Y-m-d');

            
			
			  $data_client = array(
                'status' => $status,
				'note' => $note,
                'operation_date' => $operation_date			
            );

            $insert_result = $this->common_model->updateData('house_client', $data_client, 'id', $id);
			

           

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('client_operation');
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

}

?>

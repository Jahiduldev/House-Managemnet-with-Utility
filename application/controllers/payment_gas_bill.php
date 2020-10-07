<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_gas_bill extends CI_Controller {

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
            $data['project_data'] = $this->common_model->getDataWhere4($table_name,'status',0);
             
           
            $data['houses'] = $this->db->get('add_house')->result();
            $this->load->view('common/header', $data);
            $this->load->view('payment_gas_bill/payment_gas_bill', $data);
               $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('payment_gas_bill/js_payment_gas_bill', $data);
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
			 
		   
		     $res_clients= $this->db->query("update gas_bill set  status=1, authorization=3 where id=$id ");
			
			$config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/company';
            $config['allowed_types'] = 'gif|jpg|png|pdf';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
            $config['max_size'] = '60000';
            $config['max_width'] = '';
            $config['max_height'] = '';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data['upload_data'] = '';

            if (!$this->upload->do_upload('userfile')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $fileName = '';
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                //  print_r($upload_data);
                $fileName = $upload_data['file_name'];

                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/company/'.$fileName;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();



            endif;

		
		   
		   
				$data = array(
                    'rid' => $id,
                   
                    'hid' => $hidfinal,
					'single' => $single,
					'image_name' => $fileName,
					'mont' => $mont,
'trx' => $trx,
					'sin_amount' => $sin_amount,
					'sin_pay' => $sin_pay,
					'doubles' => $doubles,
					'dob_amount' => $dob_amount,
					'dob_pay' => $dob_pay,
					
					'payment_type' => $payment_type,					
				
					'payment_date' => $payment_date,
					'note' => $note,
					'status' => 1,
                    'datetime' => date('Y-m-d H:i:s')
                );
          
			
			$table_name = 'gas_bill_payment';
            $insert_result = $this->common_model->insertDataGetId($table_name, $data);

                $data = array(
                    'company_id' => 3,
                    'table_id' => $insert_result,
                    'table_type' => 9,
                    'transaction_type' => 2,
                    'date' => $payment_date,
					'status' => 1,
                    'default_date' => date('Y-m-d H:i:s')
                );
          

            $table_name = 'master_detail';
            $insert_result = $this->common_model->insertDataGetId($table_name, $data);
            redirect('payment_gas_bill');
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

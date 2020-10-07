<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class View_desco extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Bill Management';
            $data['active_sub_menu'] = 'View DESCO';

            $table_name = 'desco_meter';
            $data['project_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('view_desco/view_desco', $data);
            $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('view_desco/js_view_desco', $data);
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
			
            $name = mysql_real_escape_string($this->input->post('name'));
            $acct_number = mysql_real_escape_string($this->input->post('acct_number'));
            $meter_number = mysql_real_escape_string($this->input->post('meter_number')); $meter_nm = mysql_real_escape_string($this->input->post('meter_nm'));			
			$address = mysql_real_escape_string($this->input->post('address'));
            $notes = mysql_real_escape_string($this->input->post('notes'));
			
            
            $house_name = mysql_real_escape_string($this->input->post('house_name'));
            $floor = mysql_real_escape_string($this->input->post('floor'));
            $flat= mysql_real_escape_string($this->input->post('flat'));
            $sec_load= mysql_real_escape_string($this->input->post('load'));


            
            $queryMenu = $this->db->query("SELECT * FROM add_house where id ='$house_name' ");
            $result = $queryMenu->result();
            if (count($result) > 0):
                foreach ($result as $rowmenu):
                     $house_code = $rowmenu->house_code;
                endforeach;
            else:
                 "";
            endif;
            
            
            
            
            $queryMenu = $this->db->query("SELECT * FROM add_floor where id ='$floor' ");
            $result = $queryMenu->result();
            if (count($result) > 0):
                foreach ($result as $rowmenu):
                     $floor_code = $rowmenu->floor_code;
                endforeach;
            else:
                 "";
            endif;
            
            
            
            
            $queryMenu = $this->db->query("SELECT * FROM add_flat where id ='$flat'");
            $result = $queryMenu->result();
            if (count($result) > 0):
                foreach ($result as $rowmenu):
                     $flat_code = $rowmenu->flat_code;
                endforeach;
            else:
                 "";
            endif;
            
            
            if($room!='')
            {
            
                $queryMenu = $this->db->query("SELECT * FROM add_room where id ='$room'");
                $result = $queryMenu->result();
                if (count($result) > 0):
                    foreach ($result as $rowmenu):
                         $room_code = $rowmenu->room_code;
                    endforeach;
                else:
                     "";
                endif;
            }   
            if($room_code==''){
                
                 $code = $house_code.'-'.$floor_code.'-'.$flat_code;
            }else{
                
                $code = $house_code.'-'.$floor_code.'-'.$flat_code.'-'.$room_code;
            } 

            
         

			
            
           
	$res_clients= $this->db->query("update  desco_meter set name='$name',address='$address',acct_number='$acct_number',meter_number='$meter_number', sec_load = '$sec_load',meter_nm='$meter_nm',notes='$notes' , hid = '$house_name', floid = '$floor' , fltid = '$flat' , code = '$code'
			where id=$id ");
			
			
			$res_clients= $this->db->query("update  desco_bill set acct_number='$acct_number',meter_number='$meter_number',meter_nm='$meter_nm'
			where relid=$id ");
			
			
						
            if ($res_clients):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;

            redirect('view_desco');
        else:

            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'desco_meter';
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

}

?>

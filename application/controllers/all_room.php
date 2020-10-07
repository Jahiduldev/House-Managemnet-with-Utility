<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_room extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'House Configuration';
            $data['active_sub_menu'] = 'View Room';

            $table_name = 'add_room';
            $data['project_data'] = $this->common_model->getDataWhere($table_name,'status','1');
            $data['headlist'] = $this->db->get('add_house')->result();
            $data['floorlist'] = $this->db->get('add_floor')->result();
            $data['flatlist'] = $this->db->get('add_flat')->result();

            $this->load->view('common/header', $data);
            $this->load->view('all_room/all_room', $data);
            $this->load->view('common/footer1', $data);
            $this->load->view('common/js1', $data);
            $this->load->view('all_room/js_all_room', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }


public function delroom() {
                    

                  $this->db->where('id', $this->input->post('id'));
                  if($this->db->update('add_room', array('status'=>0)))
                  echo 'Room Deleted !';         
         }

    public function addPayment() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');

            date_default_timezone_set("Asia/Thimbu");
			
			$datetime=date('Y-m-d');
            $id = $this->input->post('id');
            $house_name = $this->input->post('house_name');
	    $floor = $this->input->post('floor');
	    $flat = $this->input->post('flat');
			
            $room_name = $this->input->post('room_name');
            $room_code = $this->input->post('room_code');
            $notes = $this->input->post('notes');			
		
           
			//$res_clients= $this->db->query("update  add_room set room_name='$room_name',room_code='$room_code',notes='$notes'
			//where id=$id ");
              if($id != '' && $house_name != '' && $floor != '' && $flat != '' && $room_name != '' && $room_code != '' && $notes != '')
              {
              $res_clients= $this->db->query("update  add_room set hid='$house_name',floid='$floor',fltid='$flat', room_name='$room_name',room_code='$room_code', notes='$notes'
            where id='$id'");

              }
                
						
            if ($res_clients):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;

            redirect('all_room');
        else:

            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = $this->input->post('id');

        $table_name = 'add_room';
        $result = $this->common_model->getDataWhere($table_name, "id", $id);
        echo json_encode($result);
    }
 public function getHouseData() {

        $data['base_url'] = $this->config->item('base_url');
      
         $id = mysql_real_escape_string($this->input->post('id'));


        $this->db->where('id', $id);
        $query = $this->db->get('add_room');
        $row = $query->row();
        $hid = $row->hid;

        $table_name = 'add_house';
        $result = $this->common_model->getDataWhere($table_name, "id", $hid);
        echo json_encode($result);


    }
    public function getFloorData() {

        $data['base_url'] = $this->config->item('base_url');
      
         $id = mysql_real_escape_string($this->input->post('id'));


        $this->db->where('id', $id);
        $query = $this->db->get('add_room');
        $row = $query->row();
        $floid = $row->floid;

        $table_name = 'add_floor';
        $result = $this->common_model->getDataWhere($table_name, "id", $floid);
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

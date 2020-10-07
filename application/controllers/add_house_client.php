<?php

class Add_house_client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6,7,8))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'Add House Client';

            $data['headlist'] = $this->db->get('add_house')->result();
            $data['bill_type'] = $this->db->get('bill_type')->result();
            $this->load->view('common/header', $data);
            $this->load->view('add_house_client/add_house_client', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_house_client/js_add_house_client', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addEmployeeData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6,7))):
            $data['base_url'] = $this->config->item('base_url');
          

            $client_id = mysql_real_escape_string($this->input->post('client_id'));
		    $house = mysql_real_escape_string($this->input->post('house'));
            $floor = mysql_real_escape_string($this->input->post('floor'));
            $flat = mysql_real_escape_string($this->input->post('flat'));
			$rent_type = mysql_real_escape_string($this->input->post('rent_type'));
			$room = mysql_real_escape_string($this->input->post('room'));
			
			$queryMenu = $this->db->query("SELECT * FROM add_house where id =$house ");
			$result = $queryMenu->result();
			if (count($result) > 0):
				foreach ($result as $rowmenu):
					 $house_code = $rowmenu->house_code;
				endforeach;
			else:
				 "";
			endif;
			
			
			
			
			$queryMenu = $this->db->query("SELECT * FROM add_floor where id =$floor ");
			$result = $queryMenu->result();
			if (count($result) > 0):
				foreach ($result as $rowmenu):
					 $floor_code = $rowmenu->floor_code;
				endforeach;
			else:
				 "";
			endif;
			
			
			
			
			$queryMenu = $this->db->query("SELECT * FROM add_flat where id =$flat ");
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
			
				$queryMenu = $this->db->query("SELECT * FROM add_room where id =$room ");
				$result = $queryMenu->result();
				if (count($result) > 0):
					foreach ($result as $rowmenu):
						 $room_code = $rowmenu->room_code;
					endforeach;
				else:
					 $room_code='';
				endif;
			}	
			if($room_code==''){
				
				 $code = $house_code.'-'.$floor_code.'-'.$flat_code;
			}else{
				
				$code = $house_code.'-'.$floor_code.'-'.$flat_code.'-'.$room_code;
			}
			
			$advance = mysql_real_escape_string($this->input->post('advance'));
			$bill = $this->input->post('bill');


			
		
			
			
            $client_name = mysql_real_escape_string($this->input->post('client_name'));
            $date_birth = mysql_real_escape_string($this->input->post('date_birth'));
          
            

            $rent_date = mysql_real_escape_string($this->input->post('rent_date'));
    
         
            $user_name = mysql_real_escape_string($this->input->post('user_name'));

            $password = mysql_real_escape_string($this->input->post('password'));
			
            $gender = mysql_real_escape_string($this->input->post('gender'));
            $marital_status = mysql_real_escape_string($this->input->post('marital_status'));
            $religion = mysql_real_escape_string($this->input->post('religion'));


            $mobile_number = mysql_real_escape_string($this->input->post('mobile_number'));
            $email = mysql_real_escape_string($this->input->post('email'));
            $father_name = mysql_real_escape_string($this->input->post('father_name'));
            $mother_name = mysql_real_escape_string($this->input->post('mother_name'));

            $emergency_contact = mysql_real_escape_string($this->input->post('emergency_contact'));
            $present_address = mysql_real_escape_string($this->input->post('present_address'));
            $permanent_address = mysql_real_escape_string($this->input->post('permanent_address'));
            $status = mysql_real_escape_string($this->input->post('status'));
            $idtype= mysql_real_escape_string($this->input->post('idtype'));
            $idno= mysql_real_escape_string($this->input->post('idno'));
            $emergencycontactrelation= mysql_real_escape_string($this->input->post('emergencycontact_relation'));
            $profession= mysql_real_escape_string($this->input->post('profession'));
            $designation= mysql_real_escape_string($this->input->post('designation'));

            $date = date('Y-m-d');
			
			
			
	    $get_result = $this->common_model->getDataWhere('user', 'user_name', $user_name);
            if (count($get_result) > 0):
                $this->session->set_userdata('msg_title', 'Warning');
                $this->session->set_userdata('msg_body', 'Sorry,username already used!');
                redirect('add_house_client');
            endif;
			
			
			

            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/employee';
            $config['allowed_types'] = 'gif|jpg|png|pdf';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
            $config['max_size'] = '60000';
            $config['max_width'] = '';
            $config['max_height'] = '';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('photo')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $photo = '';
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                $photo = $upload_data['file_name'];

                //$config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/employee/' . $photo;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

               // $this->load->library('image_lib', $config);
               // $this->image_lib->resize();

            endif;



            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('signature')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $signature = '';
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                $signature = $upload_data['file_name'];

                //$config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/employee/' . $signature;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                //$config['width'] = 1024;
                //$config['height'] = 768;

                //$this->load->library('image_lib', $config);
                //$this->image_lib->resize();

            endif;



            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('cv')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $cv = '';
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                $cv = $upload_data['file_name'];

                //$config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/employee/' . $cv;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                //$config['width'] = 1024;
               // $config['height'] = 768;

                //$this->load->library('image_lib', $config);
                //$this->image_lib->resize();

            endif;




            $data_company = array(
                'client_id' => $client_id,
				'house' => $house,
                'floor' => $floor,
                'flat' => $flat,							
				'rent_type' => $rent_type,
                'room' => $room,
				'code' => $code,
                'advance' => $advance,				
						
                'client_name' => $client_name,
                'date_birth' => $date_birth,              
                'idno' => $idno,
                'idtype' => $idtype,
                'rent_date' => $rent_date,
                'emergencycontactrelation' => $emergencycontactrelation,
                'user_name' => $user_name,
                'password' => base64_encode(trim($password)),
                'gender' => $gender,
                'marital_status' => $marital_status,
                'religion' => $religion,
                'mobile_number' => $mobile_number,
                'email' => $email,
                'father_name' => $father_name,
                'mother_name' => $mother_name,
                'emergency_contact' => $emergency_contact,
                'photo_upload' => $photo,
                'signature_upload' => $signature,
                'present_address' => $present_address,
                'permanent_address' => $permanent_address,
                'cv_upload' => $cv,
                'date' => $date,
'bill_status' => 1,
                'status' => 2,
                'profession'=> $profession,
                'designation' => $designation

            );


            $insert_last_id = $this->common_model->insertDataGetId('house_client', $data_company);
			
						
				
				
				
	  foreach($bill as $key=>$value) {
  
          $data_user = array(
              
                'clinet_id' => $insert_last_id ,
                'bill_id' => $key,  //array key
                 'amount' => $bill[$key], //for asaigning array value
                
                'status' => 1,
                'datetime' => date('Y-m-d')
            );

            $insert_result = $this->common_model->insertData('bill', $data_user);
            }
				
	

            $data_user = array(
                'role_id' => 6,
                'emp_id' => $insert_last_id,
                'name' => $client_name,
                'user_name' => $user_name,
                'password' => base64_encode(trim($password)),
                'phone' => $mobile_number,
                'email' => $email,
                'status' => 2,
                'date_time' => date('Y-m-d H:i:s')
            );

            $insert_result = $this->common_model->insertData('user', $data_user);


            if($advance != 0 || $advance != ''){
				
				$data = array(
				
					'clinet_id' => $insert_last_id,			   
					'rent' => $advance,
					'electrict' => '0',
					'gas' => '0',
					'water' => '0',
					'service' => '0',
					'mont' => '0',
					'pu' => '0',
					'cu' => '0',
					'hid' => $house,
					'garage' => '0',
					'total' => $advance,
					'payment_type' => 'Cash',
					'current_due' => '0',
					'pay_amount' => $advance,
					'late' => '0',
					'pay_date' => $date,
					'note' => 'Advance',
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
					   'date' => $date,
					   'status' => 1,
					   'default_date' => date('Y-m-d')
				);  
				$table_name = 'master_detail';
				$insert_result = $this->common_model->insertDataGetId($table_name, $data);			
			}

            if ($insert_result > 0):

                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_house_client');
        else:
            redirect('home');
        endif;
    }

    public function getEmpCode() {

        $queryMenu = $this->db->query("SELECT * FROM employee ORDER BY ID DESC LIMIT 1");
        $result = $queryMenu->result();
        if (count($result) > 0):
            foreach ($result as $rowmenu):
                echo $emp_code = $rowmenu->emp_code;
            endforeach;
        else:
            echo "";
        endif;
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

	
	    public function getRoom() {

        $data['base_url'] = $this->config->item('base_url');
        $floor_id = mysql_real_escape_string($this->input->post('floor_id'));

        $table_name = 'add_flat';
        $result = $this->common_model->getDataWhere($table_name, "floid", $floor_id);
        echo '<option value="">Select Flat</option>';
        if (count($result) > 0) {
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->flat_name.'-'.$row->flat_code; ?></option>
                <?php
            endforeach;
        }
    }
	
	
		    public function getRoomNo() {

        $data['base_url'] = $this->config->item('base_url');
        $room_id = mysql_real_escape_string($this->input->post('room_id'));

        $table_name = 'add_room';
        $result = $this->common_model->getDataWhere($table_name, "fltid", $room_id);
        echo '<option value="">Select Room</option>';
        if (count($result) > 0) {
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->room_name.'-'.$row->room_code;; ?></option>
                <?php
            endforeach;
        }
    }
	
	
	

}
?>

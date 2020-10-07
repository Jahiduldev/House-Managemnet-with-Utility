<?php

class View_house_client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6,7,8))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'View Client';

            $this->load->view('common/header', $data);
            $this->load->view('view_house_client/view_house_client', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('view_house_client/js_view_house_client', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {
		
		
		$emp_id = $this->session->userdata('emp_id');
  
        $table = 'house_client';
        $primaryKey = 'id';
		$where = "id=$emp_id";
		
		
		
		
		
		
		
		
        $columns = array(
            array('db' => 'client_id', 'dt' => 0),
            array('db' => 'code', 'dt' => 1),
			array('db' => 'client_name', 'dt' => 2),
			array('db' => 'mobile_number', 'dt' => 3),
			
            array('db' => 'house', 'dt' => 4,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("add_house","id",$rowvalue);
            foreach($res_company as $row):
               $house_name= $row->house_name;
            endforeach;
                    return $house_name;
                }),
				
            array('db' => 'floor', 'dt' => 5,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("add_floor","id",$rowvalue);
            foreach($res_company as $row):
               $floor_name= $row->floor_name;
            endforeach;
                    return $floor_name;
                }),
				
				  
            array('db' => 'flat', 'dt' => 6,'formatter' => function ($rowvalue, $row) {
            $res_company= $this->common_model->getDataWhere("add_flat","id",$rowvalue);
            foreach($res_company as $row):
               $flat_name= $row->flat_name;
            endforeach;
                    return $flat_name;
                }),
                
                
                 array('db' => 'tenant_authorization', 'dt' => 7, 'formatter' => function ($rowvalue, $row) {
				if($rowvalue==1)
					{	
                    return 'Authorized';
					}
				
					else
					{
						return 'Pending';
						
					}
					 
                }),
                
                
                
                	 array('db' => 'status', 'dt' => 8, 'formatter' => function ($rowvalue, $row) {
				if($rowvalue==2)
					{	
                    return 'Booked';
					}
					elseif($rowvalue==1)
					{
						return 'Active';
						
					}
					elseif($rowvalue==3)
					{
						return 'Leaved';
						
					}
					 
                }),
				
			
			
				
           
            array('db' => 'id', 'dt' => 9, 'formatter' => function ($rowvalue, $row) {
				
				
			$ro = 	$this->session->userdata('role_id');
			if($ro==1)
			{
			    
			    
			    
				
		$retr = '<a  href="javascript:void(0)" onclick="gethouseclient('.$rowvalue.')">
      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
      <a  href="' . site_url("view_house_client/view_details/" . $rowvalue).'" target="_blank">
      <button class="btn btn-primary btn-xs">Profile</i></button></a>'
	  .
	  '<a  target="_blank" href="' . site_url("view_house_client/getCustomerServiceDetail/" . $rowvalue) . '">
      <button class="btn btn-primary btn-xs">Payment</button></a>'. '<a   href="' . site_url("view_house_client/getCustomerServiceSMS/" . $rowvalue) . '">
      <button class="btn btn-primary btn-xs">Send SMS</button></a>';
				
				
			}
			
			else
			{
				$retr = '
              <a  href="' . site_url("view_house_client/view_details/" . $rowvalue).'" target="_blank">
              <button class="btn btn-primary btn-xs">Profile</i></button></a>'
        	  .
        	  '<a  target="_blank" href="' . site_url("view_house_client/getCustomerServiceDetail/" . $rowvalue) . '">
              <button class="btn btn-primary btn-xs">Payment</button></a>';
				
			}
				
				
				
                    return $retr;
         })
        );

        $this->load->database();
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
        $this->load->library('SSP');
		
		
		$ro = 	$this->session->userdata('role_id');
		if($ro==6){
		  
			echo json_encode(
			    
                SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, '', $where,'')
            );
		}else{
		    
            echo json_encode(
                
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
            );
		}
    }
	
	public function getclient() {
                
                $this->db->select('*, house_client.status, house_client.id');
                $this->db->from('house_client');
                $this->db->join('add_house', 'add_house.id = house_client.house');
                $this->db->join('add_floor', 'add_floor.id = house_client.floor');
                $this->db->join('add_flat', 'add_flat.id = house_client.flat');
                $this->db->join('bill', 'bill.clinet_id = house_client.id');
                $this->db->where('house_client.id', $this->input->post('id'));
                $q = $this->db->get()->result(); echo json_encode($q);



                                         
    }




 public function update() {

            $data['base_url'] = $this->config->item('base_url');
            $id = mysql_real_escape_string($this->input->post('id')); 
            $house = mysql_real_escape_string($this->input->post('house_name'));
            $floor = mysql_real_escape_string($this->input->post('floor'));
            $flat = mysql_real_escape_string($this->input->post('flat'));
            $room = mysql_real_escape_string($this->input->post('roomn'));
            $rent_type = mysql_real_escape_string($this->input->post('rent_type'));


            $queryMenu = $this->db->query("SELECT * FROM add_house where id ='$house' ");
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
                    $room_code=''; 
                endif;
            } else{
				
				$room_code='';
			}  
            if($room_code==''){
                
                 $code = $house_code.'-'.$floor_code.'-'.$flat_code;
            }else{
                
                $code = $house_code.'-'.$floor_code.'-'.$flat_code.'-'.$room_code;
            } 



             
            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/employee';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
            $config['max_size'] = '60000';
            $config['max_width'] = '';
            $config['max_height'] = '';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data['upload_data'] = '';

            if (!$this->upload->do_upload('Id_image')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $fileName = '';
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                //  print_r($upload_data);
                $fileName = $upload_data['file_name'];

                 
                $config['source_image'] = './public/uploads/employee/'.$fileName;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                 

                 
            endif;

          
            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/employee';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
            $config['max_size'] = '60000';
            $config['max_width'] = '';
            $config['max_height'] = '';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data['upload_data'] = '';

            if (!$this->upload->do_upload('tenant_photo*')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $photo= '';
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                //  print_r($upload_data);
                $photo= $upload_data['file_name'];

               
                $config['source_image'] = './public/uploads/employee/'.$photo;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                 

                 
            endif;

         

            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/employee';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
            $config['max_size'] = '60000';
            $config['max_width'] = '';
            $config['max_height'] = '';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data['upload_data'] = '';

            if (!$this->upload->do_upload('form_image')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $signature = '';
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                //  print_r($upload_data);
                $signature = $upload_data['file_name'];

                 
                $config['source_image'] = './public/uploads/employee/'.$signature;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                 

                 
            endif;


            $data = array(
             
                //'client_id' => $this->input->post('clientid'),
                'house' => mysql_real_escape_string($this->input->post('house_name')),
                'floor' => mysql_real_escape_string($this->input->post('floor')),
                'flat' => mysql_real_escape_string($this->input->post('flat')),
                'room' => $room,
                'code' => $code,
                'rent_date' => mysql_real_escape_string($this->input->post('rentdate')),
                'advance' => mysql_real_escape_string($this->input->post('advance')),  
                'client_name' => mysql_real_escape_string($this->input->post('name')),

                'father_name' => mysql_real_escape_string($this->input->post('fathername')),
                'mother_name' => mysql_real_escape_string($this->input->post('mothername')),
                'date_birth' => mysql_real_escape_string($this->input->post('date_birth')),
                'gender' => mysql_real_escape_string($this->input->post('gender')),
                'marital_status' => mysql_real_escape_string($this->input->post('maritalstatus')),
                'religion' => mysql_real_escape_string($this->input->post('religion')),
                'permanent_address' => mysql_real_escape_string($this->input->post('parmaneaddr')),
                'profession' => mysql_real_escape_string($this->input->post('profession')),         
                'designation' => base64_encode($this->input->post('designation')),
                'present_address' => mysql_real_escape_string($this->input->post('presentaddr')),
                'email' => mysql_real_escape_string($this->input->post('emailaddr')),      
                'mobile_number' => mysql_real_escape_string($this->input->post('mobileno')),
                'emergency_contact' => mysql_real_escape_string($this->input->post('emergencycontact')),
                'emergencycontactrelation' => mysql_real_escape_string($this->input->post('emergencycontactrelation')),
                'idtype'  => mysql_real_escape_string($this->input->post('idtype')),
                'idno' =>  mysql_real_escape_string($this->input->post('idno')),
                'status' => mysql_real_escape_string($this->input->post('status')),
                
			);
			if($fileName != ''){  $data['photo_upload'] =  $fileName; }
			if($photo != ''){  $data['cv_upload'] =  $photo; }
			if($signature != ''){  $data['signature_upload'] =  $signature; }

			

	$date = date('Y-m-d');

    $insert_result_id = $this->common_model->updateData('house_client', $data, 'id', $this->input->post('id'));
	$rentdate = $this->input->post('rentdate');
	$mo = explode('-', $rentdate);
	$month = $mo[1].'/'.$mo[0];
	$advn = $this->input->post('advance');
	$payment = array(
		
		'mont' =>$month,
		'rent' =>$advn,
		'total' =>$advn,
		'pay_amount' =>$advn,
		'pay_date' =>$rentdate,
		'default_date' => date('Y-m-d')
	
	);
	
	if($this->db->where('clinet_id', $id)->where('note', 'Advance')->get('bill_payment')->num_rows() != 0){
		
		$this->db->where('clinet_id', $id)->where('note', 'Advance')->update('bill_payment', $payment);
	}else{
		
		$data = array(
				
			'clinet_id' => $id,			   
			'rent' => $advn,
			'electrict' => '0',
			'gas' => '0',
			'water' => '0',
			'service' => '0',
			'mont' => $month,
			'pu' => '0',
			'cu' => '0',
			'hid' => $this->input->post('house_name'),
			'garage' => '0',
			'total' => $advn,
			'payment_type' => 'Cash',
			'current_due' => '0',
			'pay_amount' => $advn,
			'late' => '0',
			'pay_date' => $rentdate,
			'note' => 'Advance',
			'status' => 1,
			'default_date' => date('Y-m-d')
		);	
		
		$this->db->insert('bill_payment', $data);		
	}

	redirect('view_house_client');
}
	
	
	
public function getCustomerServiceDetail() {
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6,7,8))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'View Client';
            $id = $this->uri->segment(3);
			
		    $res = $this->db->query("select * from house_client where id=$id");
            $data['get_client_data'] = $res->result();
			
			$res12 = $this->db->query("select * from bill_payment where clinet_id=$id order by id DESC");
            $data['get_pay_data'] = $res12->result();
          
          
		  
            $this->load->view('common/header', $data);
            $this->load->view('view_house_client/view_house_client_details', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('view_house_client/js_view_house_client_details', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
	
	
	
	
	
	
	
	
	
	public function getCustomerServiceSMS() {
	    
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6,7,8))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'View Client';
            $id = $this->uri->segment(3);
			
		    
			
			
			$query_1 = $this->db->query("select * from house_client where id='$id'" );
            $result_1 = $query_1->result();
            foreach ($result_1 as $row_add):
                $client_name = $row_add->client_name;
				$add_mobile_number = $row_add->mobile_number;
				$spacecode = $row_add->code;
				$user_name = $row_add->user_name;
				$password = $row_add->password;
				$finalpass =  base64_decode($password);
            endforeach;
			
		
			
			if($add_mobile_number !=''){
				
				 $res_clients= $this->db->query("update   house_client set smssend=1 where id='$id' ");
				 
				 	$res_clients12 = $this->db->query("update  house_client set tenant_authorization=1 where id='$id' ");
					
	            $msgfinal5 = "Dear $client_name Welcome to Greehasheba. Please click below link http://greehasheba.com/greehasheba Your User Name : $user_name and Password : $finalpass  Happy Living In Dhaka ";
	  
                   $lng = strlen($msgfinal5);								
				   $nm = ($lng/158);
				   $nmfinal = round($nm);
                   if($nmfinal<1){
							
						$nmfinal = 1;
					}



	              $msgfinal  = $msgfinal5; 
				  $url = "http://2aitbd.com/2abulksms/remote_access_script_greeha.php";		                      	
                  $datas = urlencode("user=greeha&pass=gree3322&text=$msgfinal&mobile=$add_mobile_number");
                        $all = $url.'?'.$datas;       
                   $reply=file_get_contents($all);
			
			
			     $data22 = array(
                    'mob' => $add_mobile_number,
                    'sms' => $msgfinal5,
                    'cnt' => $nmfinal,
                    'type' => 5,
                    'datetime' => date('Y-m-d H:i:s')
					
                );
          

                $table_name = 'sms_history';
                $insert_result = $this->common_model->insertDataGetId($table_name, $data22);
    			
    			
    			
    			$res_clients= $this->db->query("update  total_sms set total=total-$nmfinal ");
			
			  
			
            }			
			
			
		
			
			
          
          
		  
            $this->load->view('common/header', $data);
            $this->load->view('view_house_client/view_house_client', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('view_house_client/js_view_house_client', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

	
	
	
	
	
	
	
	
	


public function view_details() {
         
		$data['base_url'] = $this->config->item('base_url');
		$data['active_menu'] = 'Tenant Mngt';
		$data['active_sub_menu'] = 'View Tenant';
		 
		
		

                $this->db->select('*, house_client.status, house_client.id');
                $this->db->from('house_client');
                $this->db->join('add_house', 'add_house.id = house_client.house');
                $this->db->join('add_floor', 'add_floor.id = house_client.floor');
                $this->db->join('add_flat', 'add_flat.id = house_client.flat');
                $this->db->where('house_client.id', $this->uri->segment(3));
                 
		
                $data['row1'] = $this->db->get()->row();
	  
		$this->load->view('common/header', $data);
		$this->load->view('view_house_client/view_details', $data);
		$this->load->view('common/footer', $data);
		$this->load->view('common/js_ssp', $data);
		$this->load->view('view_house_client/js_view_details', $data);          
        
    }
	
	
	
	
	
	
	
	

	

    public function editEmployee() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'View Employee';
            $id = $this->uri->segment(3);
            $res = $this->db->query("select * from employee where id=$id");
            $data['get_employee_data'] = $res->result();
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('edit_employee/edit_employee', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('edit_employee/js_edit_employee', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editEmployeeData() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $id = mysql_real_escape_string($this->input->post('id'));
            $emp_name = mysql_real_escape_string($this->input->post('emp_name'));         
            $date_join = mysql_real_escape_string($this->input->post('date_join'));
            $phone = mysql_real_escape_string($this->input->post('phone'));
            $email = mysql_real_escape_string($this->input->post('email'));
            $company = mysql_real_escape_string($this->input->post('company'));
           
          
            $date = date('Y-m-d');



            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/employee';
            $config['allowed_types'] = 'gif|jpg|png';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
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
                $data1 = array(
                    'emp_name' => $emp_name,                  
                    'joining_date' => $date_join,
                    'company' => $company,
                    'mobile_number' => $phone,
                    'email' => $email,                                  
                    'date' => $date
                );
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                
                $fileName = $upload_data['file_name'];
                $data1 = array(
                    'emp_name' => $emp_name,                   
                    'joining_date' => $date_join,
                    'company' => $company,
                    'mobile_number' => $phone,
                    'email' => $email,
                    'photo_upload' => $fileName,               
                    'date' => $date
                );
            endif;


            $table_name = 'employee';
            $insert_result_id = $this->common_model->updateData($table_name, $data1, 'id', $id);

            if ($insert_result_id > 0):

                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('view_employee');
        else:
            redirect('home');
        endif;
    }

}

?>


<?php

class View_house_client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6))):
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


        $table = 'house_client';
        $primaryKey = 'id';
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
				
			
			 array('db' => 'status', 'dt' => 7, 'formatter' => function ($rowvalue, $row) {
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
				
           
            array('db' => 'id', 'dt' => 8, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="javascript:void(0)" onclick="gethouseclient('.$rowvalue.')">
      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
      <a  href="' . site_url("view_house_client/view_details/" . $rowvalue).'" target="_blank">
      <button class="btn btn-primary btn-xs">Profile</i></button></a>'
	  .
	  '<a  target="_blank" href="' . site_url("view_house_client/getCustomerServiceDetail/" . $rowvalue) . '">
      <button class="btn btn-primary btn-xs">Payment</button></a>'
	  ;
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
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
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

       
	  $data = array(
		 
			 
			'client_name' => mysql_real_escape_string($this->input->post('name')),         
			'father_name' => mysql_real_escape_string($this->input->post('fathername')),
			'mother_name' => mysql_real_escape_string($this->input->post('mothername')),
			'present_address' => mysql_real_escape_string($this->input->post('presentaddr')),
			'permanent_address' => mysql_real_escape_string($this->input->post('parmaneaddr')),
			
			'mobile_number' => mysql_real_escape_string($this->input->post('mobileno')),         
			'religion' => mysql_real_escape_string($this->input->post('religion')),
			'marital_status' => mysql_real_escape_string($this->input->post('maritalstatus')),
			'gender' => mysql_real_escape_string($this->input->post('gender')),
			'email' => mysql_real_escape_string($this->input->post('emailaddr')),
			'emergency_contact' => mysql_real_escape_string($this->input->post('emergencycontact')),
			
			'status' => mysql_real_escape_string($this->input->post('status')),         
			'note' => mysql_real_escape_string($this->input->post('note')),
                        'user_name' => mysql_real_escape_string($this->input->post('username')),         
			'password' => base64_encode($this->input->post('password')),

                        'idtype' => mysql_real_escape_string($this->input->post('idtype')),
                        'idno' => mysql_real_escape_string($this->input->post('idno')),         
			'emergencycontactrelation' => mysql_real_escape_string($this->input->post('emergencycontactrelation')),
            'profession' => mysql_real_escape_string($this->input->post('profession')),  
            'designation' => mysql_real_escape_string($this->input->post('designation')),  
	   );
	  
	$date = date('Y-m-d');
		

    //  $student_id = $this->input->post('hid');
    // $this->db->where('id', $student_id);
    // $this->db->update('house_client', $data);
    // $updated_status = $this->db->affected_rows();

    // if($updated_status):
    //     return $student_id;
    // else:
    //     return false;
    // endif;


    $insert_result_id = $this->common_model->updateData('house_client', $data, 'id', $this->input->post('hid'));


    
	redirect('view_house_client');
			
	}
	
	
	
public function getCustomerServiceDetail() {
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6))):
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


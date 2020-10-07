<?php

class Submit_attendance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Operation';
            $data['active_sub_menu'] = 'Submit Attendance';


            $this->load->view('common/header', $data);
            $this->load->view('submit_attendance/submit_attendance', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('submit_attendance/js_submit_attendance', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addAttendanceData() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');

            $att_type = mysql_real_escape_string($this->input->post('att_type'));
            $comments = mysql_real_escape_string($this->input->post('comments'));
            $emp_id = $this->session->userdata('emp_id');
           date_default_timezone_set("Asia/Thimbu");
            $date_time = date('Y-m-d H:i:s');
            $date = date('Y-m-d');


            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/attendance';
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
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed to upload image due to slow internet connection.Please try again.');
                redirect('submit_attendance');
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                //  print_r($upload_data);
                $fileName = $upload_data['file_name'];


            endif;

            $get_query = $this->db->query("select * from `attendance` where `emp_id`='$emp_id' and `date`='$date'");
            $get_result = $get_query->result();
            if (count($get_result) > 0):

                if ($att_type == 'Out'):
                    $data = array(
                        'emp_id' => $emp_id,
                        'image_out' => $fileName,
                        'comments_out' => $comments,
                        'att_type_out' => $att_type,
                        'date_time_out' => $date_time
                    );
                    $table_name = 'attendance';
                    $update_result = $this->common_model->updateData($table_name, $data, 'emp_id', $emp_id, 'date', $date);
                    $data = array(
                        'emp_id' => $emp_id,
                        'image_out' => $fileName,
                        'comments_out' => $comments,
                        'att_type_out' => $att_type,
                        'date_time_out' => $date_time,
                        'date' => $date
                    );
                    $table_name = 'attendance_backup';
                    $insert_result = $this->common_model->insertData($table_name, $data);
                    $this->session->set_userdata('msg_title', 'Success');
                    $this->session->set_userdata('msg_body', 'Successfull');
                else:
                    $data = array(
                        'emp_id' => $emp_id,
                        'image' => $fileName,
                        'comments' => $comments,
                        'att_type' => $att_type,
                        'date_time' => $date_time,
                        'date' => $date
                    );
                    $table_name = 'attendance_backup';
                    $insert_result = $this->common_model->insertData($table_name, $data);
                    $this->session->set_userdata('msg_title', 'Success');
                    $this->session->set_userdata('msg_body', 'Successfull');
                endif;


            else:
                if ($att_type == 'In'):
                    $data = array(
                        'emp_id' => $emp_id,
                        'image' => $fileName,
                        'comments' => $comments,
                        'att_type' => $att_type,
                        'date_time' => $date_time,
                        'date' => $date
                    );
                    $table_name = 'attendance';
                    $insert_result = $this->common_model->insertData($table_name, $data);
                    $table_name = 'attendance_backup';
                    $insert_result = $this->common_model->insertData($table_name, $data);
                    $this->session->set_userdata('msg_title', 'Success');
                    $this->session->set_userdata('msg_body', 'Successfull');
                else:
                    //please input outtime before	
                    $this->session->set_userdata('msg_title', 'Warning');
                    $this->session->set_userdata('msg_body', 'Sorry,Please enter in time before.');
                    redirect('submit_attendance');
                endif;
            endif;
            //    redirect('submit_attendance');               
            redirect('menu_button');
        else:
            redirect('home');
        endif;
    }

    public function editClient() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'View Client';
            $id = $this->uri->segment(3);

            $res = $this->db->query("select * from clients where id=$id");
            $data['get_client_data'] = $res->result();

            $this->load->view('common/header', $data);
            $this->load->view('edit_client/edit_client', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('edit_client/js_edit_client', $data);

        else:
            redirect('home');
        endif;
    }

    public function editClientData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');

            $id = mysql_real_escape_string($this->input->post('id'));

            $add_member_id = mysql_real_escape_string($this->input->post('add_member_id'));
            $add_password = mysql_real_escape_string($this->input->post('add_password'));
            $add_prime_applicant_name = mysql_real_escape_string($this->input->post('add_prime_applicant_name'));
            $add_number_applicant = mysql_real_escape_string($this->input->post('add_number_applicant'));
            $add_contact_no = mysql_real_escape_string($this->input->post('add_contact_no'));
            $add_email = mysql_real_escape_string($this->input->post('add_email'));
            $add_nok = mysql_real_escape_string($this->input->post('add_nok'));
            $add_plot_id = mysql_real_escape_string($this->input->post('add_plot_id'));
            $add_plot_price = mysql_real_escape_string($this->input->post('add_plot_price'));
            $add_payment_type = mysql_real_escape_string($this->input->post('add_payment_type'));
            $add_remarks = mysql_real_escape_string($this->input->post('add_remarks'));
            $date_time = date('Y-m-d H:i:s');
            date_default_timezone_set("Asia/Dhaka");

            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads';
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
                $data = array(
                    'member_id' => $add_member_id,
                    'password' => $add_password,
                    'prime_applicant_name' => $add_prime_applicant_name,
                    'number_applicant' => $add_number_applicant,
                    'contact_no' => $add_contact_no,
                    'email' => $add_email,
                    'nok' => $add_nok,
                    'plot_id' => $add_plot_id,
                    'plot_price' => $add_plot_price,
                    'payment_type' => $add_payment_type,
                    'remarks' => $add_remarks,
                    //'image'=>$fileName,
                    'date_time' => $date_time
                );
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                //  print_r($upload_data);
                $fileName = $upload_data['file_name'];
                $data = array(
                    'member_id' => $add_member_id,
                    'password' => $add_password,
                    'prime_applicant_name' => $add_prime_applicant_name,
                    'number_applicant' => $add_number_applicant,
                    'contact_no' => $add_contact_no,
                    'email' => $add_email,
                    'nok' => $add_nok,
                    'plot_id' => $add_plot_id,
                    'plot_price' => $add_plot_price,
                    'payment_type' => $add_payment_type,
                    'remarks' => $add_remarks,
                    'image' => $fileName,
                    'date_time' => $date_time
                );
            endif;


            $table_name = 'clients';
            $insert_result = $this->common_model->updateData($table_name, $data, 'id', $id);
            if ($insert_result):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;
            redirect('view_client');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {


        $table = 'clients';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'member_id', 'dt' => 0),
            array('db' => 'prime_applicant_name', 'dt' => 1),
            array('db' => 'number_applicant', 'dt' => 2),
            array('db' => 'contact_no', 'dt' => 3),
            array('db' => 'id', 'dt' => 4, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="' . site_url("add_client/editClient/" . $rowvalue) . '">
      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil">Details</i></button></a><a href="#">
         <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a>';
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

}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administrator
 *
 * @author asad
 */
class Shop_wise_report extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');

            $data['active_menu'] = 'Report';
            $data['active_sub_menu'] = 'Attendance Report';

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $role_id = $this->session->userdata('role_id');

            $data['select_employee'] = '';
            if ($role_id == 3):
                $data['select_employee'] = $this->session->userdata('emp_id');
            else:
                $data['select_employee'] = 'all';
            endif;

            $date = date('Y-m-d');
            //$data['date_from'] = $date.' 00.00.00';
            // $data['date_to'] = $date.' 23.59.59';
            $data['date_from'] = $date;
            $data['date_to'] = $date;

            $this->load->view('common/header', $data);
            $this->load->view('shop_wise_report/shop_wise_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('shop_wise_report/js_shop_wise_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getReport() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Report';
            $data['active_sub_menu'] = 'Attendance Report';

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);

            $data['select_company'] = mysql_real_escape_string($this->input->post('select_company'));

            $role_id = $this->session->userdata('role_id');
            if ($role_id == 3):
                $data['select_employee'] = $this->session->userdata('emp_id');
            else:
                $data['select_employee'] = mysql_real_escape_string($this->input->post('select_employee'));
            endif;

            $data['date_from'] = mysql_real_escape_string($this->input->post('date_from'));
            $data['date_to'] = mysql_real_escape_string($this->input->post('date_to'));

            $this->load->view('common/header', $data);
            $this->load->view('shop_wise_report/shop_wise_report', $data);
            $this->load->view('common/footer', $data);
             $this->load->view('common/js', $data);
            $this->load->view('shop_wise_report/js_shop_wise_report', $data);

        else:
            redirect('home');
        endif;
    }

    public function getEmployee() {
        $company_id = $this->input->post('company_id');
        $queryEmployee = $this->db->query("SELECT * FROM employee where `company`='$company_id'");
        if (count($queryEmployee->result()) > 0):
            echo "<option value='' >Choose one of the following employee...</option>";
            foreach ($queryEmployee->result() as $rowEm):
                $id = $rowEm->id;
                $emp_name = $rowEm->emp_name;
                echo "<option value='" . $id . "' >" . $emp_name . "</option>";
            endforeach;
        endif;
    }

    public function editAttendance() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $data['active_menu'] = 'Report';
            $data['active_sub_menu'] = 'Attendance Report';
            $id = $this->uri->segment(3);
            $res = $this->db->query("select * from attendance where id=$id");
            $data['get_attendance_data'] = $res->result();
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('edit_attendance/edit_attendance', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('edit_attendance/js_edit_attendance', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editAttendanceData() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            
            $id = mysql_real_escape_string($this->input->post('id'));
            $comments = mysql_real_escape_string($this->input->post('comments'));
            $entry_time = mysql_real_escape_string($this->input->post('entry_time'));

            $comments_out = mysql_real_escape_string($this->input->post('comments_out'));
            $exit_time = mysql_real_escape_string($this->input->post('exit_time'));

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
                $data = array(
                    'comments' => $comments,
                    'date_time' => $entry_time
                );
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                $fileName = $upload_data['file_name'];
                $data = array(
                    'image' => $fileName,
                    'comments' => $comments,
                    'date_time' => $entry_time
                );
            //	$config2['image_library'] = 'gd2';
            //	$config2['source_image'] = './public/uploads/'.$fileName;
            //	$config2['create_thumb'] = FALSE;
            //	$config2['maintain_ratio'] = FALSE;
            //	$config2['width']         = 400;
            //	$config2['height']       = 400;
            //	$this->load->library('image_lib', $config2);
            //	$this->image_lib->resize();
            endif;


            $table_name = 'attendance';
            $insert_result = $this->common_model->updateData($table_name, $data, 'id', $id);


            if (!$this->upload->do_upload('userfile_out')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $fileName = '';
                $data = array(
                    'comments_out' => $comments_out,
                    'date_time_out' => $exit_time
                );
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                $fileName = $upload_data['file_name'];
                $data = array(
                    'image_out' => $fileName,
                    'comments_out' => $comments_out,
                    'date_time_out' => $exit_time
                );
            //	$config2['image_library'] = 'gd2';
            //	$config2['source_image'] = './public/uploads/'.$fileName;
            //	$config2['create_thumb'] = FALSE;
            //	$config2['maintain_ratio'] = FALSE;
            //	$config2['width']         = 400;
            //	$config2['height']       = 400;
            //	$this->load->library('image_lib', $config2);
            //	$this->image_lib->resize();
            endif;


            $table_name = 'attendance';
            $insert_result = $this->common_model->updateData($table_name, $data, 'id', $id);

            if ($insert_result):

                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('menu_button');
        else:
            redirect('home');
        endif;
    }

}

?>

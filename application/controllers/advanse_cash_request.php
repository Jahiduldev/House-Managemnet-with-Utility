<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advanse_cash_request extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Expense Mngt';
            $data['active_sub_menu'] = 'Advance Cash Request ';

            $this->load->view('common/header_ssp', $data);
            $this->load->view('advanse_cash_request/advanse_cash_request', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('advanse_cash_request/advanse_cash_request_ssp', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function editModel() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17))):
            $data['base_url'] = $this->config->item('base_url');

            $edit_id = mysql_real_escape_string($this->input->post('edit_id'));
            $amount = mysql_real_escape_string($this->input->post('amount'));
            $employee_id = mysql_real_escape_string($this->input->post('employee_id'));
            $project = mysql_real_escape_string($this->input->post('project'));
            $status = mysql_real_escape_string($this->input->post('status'));
            date_default_timezone_set("Asia/Thimbu");
            $date_time = date('Y-m-d H:i:s');


            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/employee';
            $config['allowed_types'] = 'gif|jpg|png';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
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

                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/employee/' . $photo;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

            endif;

            $data = array(
                'amount' => $amount,
                'status' => $status,
                'payment_photo' => $photo,
                'date' => $date_time
            );

            $table_name = 'advance_cash_requisition';
            $insert_result = $this->common_model->updateData($table_name, $data, "id", $edit_id);

            if ($status == 1) {
                $result2 = $this->db->query("select employee_id,project,sum(`amount`) as`amount`  from advance_cash_requisition where project='$project' and employee_id='$employee_id' and status=1");
                if ($result2->num_rows > 0):
                    foreach ($result2->result() as $row2):
                        $employee_id = $row2->employee_id;
                        $project = $row2->project;
                        $amount = $row2->amount;

                        $date_time = date('Y-m-d H:i:s');

                        $data = array(
                            'assign_amount' => $amount,
                            'date' => $date_time
                        );
                        $table_name = 'assign_project_final';
                        $insert_result = $this->common_model->updateData2($table_name, $data, 'employee_id', $employee_id, 'project', $project);
                    endforeach;
                endif;
            }

            if ($insert_result):
                if ($status == "Receive") {


                    $result = $this->common_model->getDataWhere($table_name, "id", $edit_id);
                    if (count($result) > 0) {
                        foreach ($result as $row) {


                            $passport_no = $row->passport_no;
                            $broker_name_all = $row->broker_name;
                            $reference_name_all = $row->reference_name;

                            $broker_name_all_arr = explode("-", $broker_name_all);
                            $broker_id = $broker_name_all_arr[1];

                            $reference_name_all_arr = explode("-", $reference_name_all);
                            $reference_id = $reference_name_all_arr[1];


                            /* reference  */

                            /* end reference  */


                            /* broker  */

                            /* end broker  */
                        }
                    }
                }

                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('advanse_cash_request');
        else:

            redirect('home');
        endif;
    }

    public function deleteModel() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17))):
            $data['base_url'] = $this->config->item('base_url');
            $delete_id = mysql_real_escape_string($this->input->post('delete_id'));


            $table_name = 'passport_makings';
            $column_name = 'id';
            $column_value = $delete_id;
            $insert_result = $this->common_model->deleteData($table_name, $column_name, $column_value);


            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('view_customer');
        else:
            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'advance_cash_requisition';
        $result = $this->common_model->getDataWhere($table_name, "id", $id);
        echo json_encode($result);
    }

    public function getTableData() {

        $table = 'advance_cash_requisition';

        $primaryKey = 'id';
        $columns = array(
            array('db' => 'employee_id', 'dt' => 0, 'field' => 'employee_id', 'formatter' => function ($rowvalue, $row) {
                    $query_22 = $this->db->query("select * from employee where id='$row[0]'");
                    $result_22 = $query_22->result();
                    foreach ($result_22 as $row_add):
                        $emp_name = $row_add->emp_name;

                    endforeach;
                    return $emp_name;
                }),
            array('db' => 'project', 'dt' => 1, 'field' => 'project', 'formatter' => function ($rowvalue, $row) {
                    $query_22 = $this->db->query("select * from project where id='$row[1]'");
                    $result_22 = $query_22->result();
                    foreach ($result_22 as $row_add):
                        $emp_name = $row_add->name;

                    endforeach;
                    return $emp_name;
                }),
            array('db' => 'amount', 'dt' => 2, 'field' => 'amount'),
            array('db' => 'status', 'dt' => 3, 'field' => 'status', 'formatter' => function ($rowvalue, $row) {
                    return 'Pending';
                }),
            array('db' => 'id', 'dt' => 4, 'field' => 'id', 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="#">
      <button class="btn btn-primary btn-xs" onclick="addModal(' . $rowvalue . ')"><i class="fa fa-pencil"> Approval</i></button></a>
	  
	  </a>';
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
        // $joinQuery = "FROM `{$table}` AS `c`  JOIN `base_service_master` AS `m` ON (`c`.`ci_id` = `m`.`ref_client_id`) JOIN `base_areas` AS `a` ON (`a`.`a_id` = `c`.`ref_area_id`)";

        $extraCondition = " `status`='2' ";
        // $extraCondition = "`enzaz_mufa_number`!=''";

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, '', $extraCondition)
        );
    }

}

?>

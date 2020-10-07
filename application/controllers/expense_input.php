<?php

class Expense_input extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Operation';
            $data['active_sub_menu'] = 'Expense Input';


            $employee_id = $this->session->userdata('emp_id');
            $table_name = 'assign_project';
            $data['get_project_data'] = $this->common_model->getDataWhere($table_name, "employee_id", $employee_id);

            $this->load->view('common/header', $data);
            $this->load->view('expense_input/expense_input', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('expense_input/js_expense_input', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addExpense() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $project = mysql_real_escape_string($this->input->post('project'));
            $query_22 = $this->db->query("select * from project where id='$project'");
            $result_22 = $query_22->result();
            foreach ($result_22 as $row_add):
                $client = $row_add->client_id;
                $company = $row_add->company_id;
            endforeach;

            $amount = mysql_real_escape_string($this->input->post('amount'));
            $purpose = mysql_real_escape_string($this->input->post('purpose'));
            $expense_date = mysql_real_escape_string($this->input->post('expense_date'));


            date_default_timezone_set("Asia/Thimbu");

            $date = date('Y-m-d H:i:s');

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
            $employee_id = $this->session->userdata('emp_id');
            if ($expense_date == '') {
                $expense_date = $date;
            }
            $data_designation = array(
                'employee_id' => $this->session->userdata('emp_id'),
                'company_id' => $company,
                'client_id' => $client,
                'project' => $project,
                'amount' => $amount,
                'purpose' => $purpose,
                'bill_photo' => $photo,
                'expense_date' => $expense_date,
                'date' => $expense_date
            );


            $insert_result = $this->common_model->insertDataGetId('employee_expense', $data_designation);
            $data2 = array(
                'company_id' => $company,
                'table_id' => $insert_result,
                'table_type' => 6,
                'transaction_type' => 2,
                'date' => date("Y-m-d"),
                'default_date' => date('Y-m-d H:i:s')
            );

            $this->common_model->insertData('master_detail', $data2);


            $result2 = $this->db->query("select employee_id,project,sum(`amount`) as`amount`  from employee_expense where project='$project' and employee_id='$employee_id'");
            if ($result2->num_rows > 0):
                foreach ($result2->result() as $row2):
                    $employee_id = $row2->employee_id;
                    $project = $row2->project;
                    $amount = $row2->amount;

                    $date_time = date('Y-m-d H:i:s');

                    $data = array(
                        'expense_amount' => $amount,
                        'date' => $date_time
                    );
                    $table_name = 'assign_project_final';
                    $insert_result = $this->common_model->updateData2($table_name, $data, 'employee_id', $employee_id, 'project', $project);
                endforeach;
            endif;



            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('expense_input');
        else:
            redirect('home');
        endif;
    }

    public function getDepartment() {

        $data['base_url'] = $this->config->item('base_url');
        $com_id = mysql_real_escape_string($this->input->post('com_id'));

        $table_name = 'department';
        $result = $this->common_model->getDataWhere($table_name, "company_id", $com_id);
        echo '<option value="">Select</option>';
        if (count($result) > 0) {
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->department_name; ?></option>
                <?php
            endforeach;
        }
    }

    public function getProject() {

        $data['base_url'] = $this->config->item('base_url');
        $com_id = mysql_real_escape_string($this->input->post('com_id'));
        $client_id = mysql_real_escape_string($this->input->post('client_id'));
        $table_name = 'project';
        $result = $this->common_model->getDataWhere2($table_name, "company_id", $com_id, "client_id", $client_id);

        if (count($result) > 0) {
            ?>
            <option value="">Select Project</option>
            <?php
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                <?php
            endforeach;
        }
    }

}
?>

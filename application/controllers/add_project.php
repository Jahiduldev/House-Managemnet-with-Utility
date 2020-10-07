<?php

class Add_project extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'Add Project';

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('add_project/add_project', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_project/js_add_project', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addProject() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');

            $company = mysql_real_escape_string($this->input->post('company'));
            $client = mysql_real_escape_string($this->input->post('client'));
            $project = mysql_real_escape_string($this->input->post('project'));
            $project_description = mysql_real_escape_string($this->input->post('project_description'));
            $project_amount = mysql_real_escape_string($this->input->post('project_amount'));

            $deadline = mysql_real_escape_string($this->input->post('deadline'));
            $status = mysql_real_escape_string($this->input->post('status'));

            $date = date('Y-m-d');

            $data_designation = array(
                'company_id' => $company,
                'client_id' => $client,
                'name' => $project,
                'description' => $project_description,
                'status' => 1,
                'project_amount' => $project_amount,
                'deadline' => $deadline,
                'date' => $date
            );




            $insert_result = $this->common_model->insertDataGetId('project', $data_designation);

            $data_project = array(
                'company_id' => $company,
                'client_id' => $client,
                'project_id' => $insert_result,
                'project_name' => $project,
                'notes' => $project_description,
                'due' => $project_amount,
                'datetime' => $date
            );


            $this->common_model->insertData('project_table', $data_project);

            $data_payment = array(
                'company_id' => $company,
                'client_id' => $client,
                'project_id' => $insert_result,
                'due' => $project_amount,
                'note' => $project_description,
                'date_time' => date('Y-m-d H:i:s')
            );

            
           $this->common_model->insertData('project_payment', $data_payment);








            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_project');
        else:
            redirect('home');
        endif;
    }

    public function getClient() {

        $data['base_url'] = $this->config->item('base_url');
        $com_id = mysql_real_escape_string($this->input->post('com_id'));

        $table_name = 'client';
        $result = $this->common_model->getDataWhere($table_name, "company_id", $com_id);
        echo '<option value="">Select Client</option>';
        if (count($result) > 0) {
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->client_name; ?></option>
                <?php
            endforeach;
        }
    }

}
?>

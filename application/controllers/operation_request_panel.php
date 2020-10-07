<?php

class Operation_request_panel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Client Mngt';
            $data['active_sub_menu'] = 'Client Request Panel';

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header_ssp', $data);
            $this->load->view('client_request_panel/client_request_panel', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('client_request_panel/js_client_request_panel', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editOperation() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'Client Request Panel';

            $id = $this->uri->segment(3);
            $data['market_visit_id'] = $id;
            $result = $this->common_model->getDataWhere('market_visit', 'id', $id);
            foreach ($result as $row):
                $employee_id = $row->employee_id;
                $company_id = $row->company_id;
            endforeach;
            $table_name = 'client';
            $data['get_client_data'] = $this->common_model->getDataWhere($table_name, "company_id", $company_id);
            $data['select_company'] = $company_id;
            $data['get_employee_data'] = $this->common_model->getDataWhere('employee', 'id', $employee_id);
            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('operation_request_panel/operation_request_panel', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('operation_request_panel/js_operation_request_panel', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addProject() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');

            $market_visit_id = mysql_real_escape_string($this->input->post('market_visit_id'));
            $employee = mysql_real_escape_string($this->input->post('employee'));
            $company = mysql_real_escape_string($this->input->post('company'));
            $client = mysql_real_escape_string($this->input->post('client'));
            $project = mysql_real_escape_string($this->input->post('project'));
            $project_description = mysql_real_escape_string($this->input->post('project_description'));

            $project_amount = mysql_real_escape_string($this->input->post('project_amount'));
            $advance_amount = mysql_real_escape_string($this->input->post('advance_amount'));
            $deadline = mysql_real_escape_string($this->input->post('deadline'));
            $status = mysql_real_escape_string($this->input->post('status'));

            $date = date('Y-m-d H:i:s');


            $data_project = array(
                'employee_id' => $employee,
                'company_id' => $company,
                'client_id' => $client,
                'name' => $project,
                'description' => $project_description,
                'project_amount' => $project_amount,
                'deadline' => $deadline,
                'date' => $date
            );


            $insert_2 = $this->common_model->insertDataGetId('project', $data_project);








            $data_project = array(
                'employee_id' => $employee,
                'company_id' => $company,
                'client_id' => $client,
                'project_id' => $insert_2,
                'project_name' => $project,
                'notes' => $project_description,
                'due' => $project_amount,
                'datetime' => $date
            );


          $this->common_model->insertData('project_table', $data_project);





 $data_payment = array(
                
                'company_id' => $company,
                'client_id' => $client,
                'project_id' => $insert_2,
               
                'note' => $project_description,
                'due' => $project_amount,
                'date_time' => $date
            );


          $this->common_model->insertData('project_payment', $data_payment);






            $data_designation = array(
                'employee_id' => $employee,
                'company_id' => $company,
                'client_id' => $client,
                'project_id' => $insert_2,
                'project_name' => $project,
                'description' => $project_description,
                'project_amount' => $project_amount,
                'deadline' => $deadline,
                'status' => $status,
                'date' => $date
            );


            $insert_result = $this->common_model->insertData('market_visit_project', $data_designation);



            if ($insert_result):

                $data_designation = array(
                    'status' => 3
                );
                $this->common_model->updateData('market_visit', $data_designation, 'id', $market_visit_id);

                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;

            redirect('operation_request_panel');
        else:
            redirect('home');
        endif;
    }

    public function addClient() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'Client Request Panel';
            $company = mysql_real_escape_string($this->input->post('client_company_id'));
            $client = mysql_real_escape_string($this->input->post('client_name'));

            $date = date('Y-m-d');

            $data_designation = array(
                'company_id' => $company,
                'client_name' => $client,
                'status' => 1,
                'date' => $date
            );


            $insert_result = $this->common_model->insertData('client', $data_designation);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;

            $id = $this->uri->segment(3);
            $data['market_visit_id'] = $id;
            $result = $this->common_model->getDataWhere('market_visit', 'id', $id);
            foreach ($result as $row):
                $employee_id = $row->employee_id;
                $company_id = $row->company_id;
            endforeach;

            $table_name = 'client';
            $data['get_client_data'] = $this->common_model->getDataWhere($table_name, "company_id", $company_id);
            $data['select_company'] = $company_id;
            $data['get_employee_data'] = $this->common_model->getDataWhere('employee', 'id', $employee_id);
            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('operation_request_panel/operation_request_panel', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('operation_request_panel/js_operation_request_panel', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

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

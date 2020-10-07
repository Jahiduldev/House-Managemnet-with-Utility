<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project_payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Accounts';
            $data['active_sub_menu'] = 'Project Payment';

            $table_name = 'project_table';
            $data['project_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('project_payment/project_payment', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('project_payment/js_project_payment', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addPayment() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))):
            $data['base_url'] = $this->config->item('base_url');

date_default_timezone_set("Asia/Thimbu");
            $project_id = mysql_real_escape_string($this->input->post('project_name'));
            $payment_type = mysql_real_escape_string($this->input->post('payment_type'));
            $payment_amount = mysql_real_escape_string($this->input->post('payment_amount'));
            $note = mysql_real_escape_string($this->input->post('note'));

            $query_22 = $this->db->query("select * from project where id='$project_id'");
            $result_22 = $query_22->result();
            foreach ($result_22 as $row_add):
                $client_id = $row_add->client_id;

            endforeach;
            $query_1 = $this->db->query("select * from client where id='$client_id'");
            $result_1 = $query_1->result();
            foreach ($result_1 as $row_add):
                $client_id = $row_add->id;
                $company_id = $row_add->company_id;
            endforeach;


            if ($payment_type == 'Payment'):
                $data = array(
                    'company_id' => $company_id,
                    'client_id' => $client_id,
                    'project_id' => $project_id,
                    'payment' => $payment_amount,
                    'note' => $note,
                    'date_time' => date('Y-m-d H:i:s')
                );
            else:
                $data = array(
                    'company_id' => $company_id,
                    'client_id' => $client_id,
                    'project_id' => $project_id,
                    'due' => $payment_amount,
                    'note' => $note,
                    'date_time' => date('Y-m-d H:i:s')
                );
            endif;

            $table_name = 'project_payment';
            $insert_result = $this->common_model->insertDataGetId($table_name, $data);

            if ($payment_type == 'Payment'):
                $data2 = array(
                    'company_id' => $company_id,
                    'table_id' => $insert_result,
                    'table_type' => 4,
                    'transaction_type' => 1,
                    'date' => date("Y-m-d"),
                    'default_date' => date('Y-m-d H:i:s')
                );

                $this->common_model->insertData('master_detail', $data2);
            endif;

            $result2 = $this->db->query("select project_id,sum(`payment`) as`payment`,sum(`due`) as`due`  from project_payment where project_id='$project_id'");
            if ($result2->num_rows > 0):
                foreach ($result2->result() as $row2):
                    $project_id = $row2->project_id;



                    $payment = $row2->payment;
                    $due = $row2->due;


                    $data = array(
                        'payment' => $payment,
                        'due' => $due
                    );
                    $table_name = 'project_table';
                    $insert_result = $this->common_model->updateData($table_name, $data, 'project_id', $project_id);
                endforeach;
            endif;

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('project_payment');
        else:

            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'passport_makings';
        $result = $this->common_model->getDataWhere($table_name, "id", $id);
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

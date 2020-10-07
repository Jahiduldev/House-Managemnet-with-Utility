<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier_payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 11, 12, 13, 14, 15, 16, 17))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Supplier';
            $data['active_sub_menu'] = 'Create Project';

            $table_name = 'broker_table';
            $data['broker_data'] = $this->common_model->getData($table_name);

            $table_sup = 'projects';
            $data['sup_data'] = $this->common_model->getData($table_sup);

            $this->load->view('common/header', $data);
            $this->load->view('supplier_payment/supplier_payment', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('supplier_payment/js_supplier_payment', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addPayment() {


        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17))):
            $data['base_url'] = $this->config->item('base_url');

            date_default_timezone_set("Asia/Thimbu");
            $broker_id = mysql_real_escape_string($this->input->post('broker_name'));
            $payment_type = mysql_real_escape_string($this->input->post('payment_type'));
            $project_id = mysql_real_escape_string($this->input->post('project'));
            $payment_amount = mysql_real_escape_string($this->input->post('payment_amount'));
            $note = mysql_real_escape_string($this->input->post('note'));

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

                //$config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/employee/' . $photo;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->load->library('image_lib', $config);
               // $this->image_lib->resize();

            endif;



            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('photo2')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $photo2 = '';
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                $photo2 = $upload_data['file_name'];

                //$config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/employee/' . $photo2;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->load->library('image_lib', $config);
               // $this->image_lib->resize();

            endif;



            $query_22 = $this->db->query("select * from  broker_table where id='$broker_id'");
            $result_22 = $query_22->result();
            foreach ($result_22 as $row_add):
                $company_id = $row_add->company_id;

            endforeach;


            if ($payment_type == 'Payment'):
                $data = array(
                    'company_id' => $company_id,
                    'broker_id' => $broker_id,
                    'project_id' => $project_id,
                    'payment' => $payment_amount,
                    'photo' => $photo,
                    'photo2' => $photo2,
                    'note' => $note,
                    'date_time' => date('Y-m-d H:i:s')
                );
            else:
                $data = array(
                    'company_id' => $company_id,
                    'broker_id' => $broker_id,
                    'project_id' => $project_id,
                    'due' => $payment_amount,
                    'photo' => $photo,
                    'photo2' => $photo2,
                    'note' => $note,
                    'date_time' => date('Y-m-d H:i:s')
                );
            endif;

            $table_name = 'broker_payment';
            $insert_result = $this->common_model->insertDataGetId($table_name, $data);

            if ($payment_type == 'Payment'):
                $data2 = array(
                    'company_id' => $company_id,
                    'table_id' => $insert_result,
                    'table_type' => 5,
                    'transaction_type' => 2,
                    'date' => date("Y-m-d"),
                    'default_date' => date('Y-m-d H:i:s')
                );

                $this->common_model->insertData('master_detail', $data2);
            endif;

            $result2 = $this->db->query("select broker_id,sum(`payment`) as`payment`,sum(`due`) as`due`  from broker_payment where broker_id='$broker_id'");
            if ($result2->num_rows > 0):
                foreach ($result2->result() as $row2):
                    $broker_id = $row2->broker_id;
                    $payment = $row2->payment;
                    $due = $row2->due;


                    $data = array(
                        'payment' => $payment,
                        'due' => $due
                    );
                    $table_name = 'broker_table';
                    $insert_result = $this->common_model->updateData($table_name, $data, 'id', $broker_id);
                endforeach;
            endif;

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('supplier_payment');
        else:

            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'sup_assign_project';
        $result = $this->common_model->getDataWhere($table_name, "sup_id", $id);
        echo '<option value="">Select Project</option>';
        foreach ($result as $row12) :
            $project = $row12->project;
            $project_name = $row12->project_name;
            echo "<option value='" . $project . "'>" . $project_name . "</option>";
        endforeach;
    }

    public function getSalaryAddDetails() {



        $data = $this->common_model->getSelectedDataWhere($this->input->post('id'));

        echo $data;
    }

    public function getSalaryDeductDetails() {



        $data = $this->common_model->getDeductDataWhere($this->input->post('id'));

        echo $data;
    }

    public function getDetails($passport_no) {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17))):
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

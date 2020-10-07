<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_Billing_report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Billing Reports';
            $data['active_sub_menu'] = 'Tenant Payment';

            $table_name = 'bill_payment';
            $data['desco_bill_payment'] = $this->common_model->getData($table_name);

            $table_name = 'add_house';
            $data['desco_meter'] = $this->common_model->getData($table_name);

           $this->load->view('common/header', $data);
            $this->load->view('client_billing_report/client_billing_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('client_billing_report/js_client_billing_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }


    public function searchData() {

        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Billing Reports';
            $data['active_sub_menu'] = 'Tenant Payment';

            $table_name = 'add_house';
            $data['desco_meter'] = $this->common_model->getData($table_name);

            $date_from=$this->input->post('date_from');
            $date_to=$this->input->post('date_to');
            $desco_meter=$this->input->post('desco_meter');



            if($desco_meter!="" && $date_from!="" && $date_to!=""):
             $result= $this->db->query("select * from bill_payment where (date(`pay_date`) between '$date_from' and '$date_to') and hid='$desco_meter'");
                $data['desco_bill_payment'] = $result->result();

            elseif($date_from!="" && $date_to!=""):
                $result= $this->db->query("select * from bill_payment where date(`pay_date`) between '$date_from' and '$date_to'");
                $data['desco_bill_payment'] = $result->result();
            elseif($desco_meter!=""):
                $table_name = 'bill_payment';
                $data['desco_bill_payment'] = $this->common_model->getDataWhere($table_name,'hid',$desco_meter);
            else:
                $table_name = 'bill_payment';
                $data['desco_bill_payment'] = $this->common_model->getData($table_name);
            endif;


            $this->load->view('common/header', $data);
            $this->load->view('tenant_payment_report/tenant_payment_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('tenant_payment_report/js_tenant_payment_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }



}

?>

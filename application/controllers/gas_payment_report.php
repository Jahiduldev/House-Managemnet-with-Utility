<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gas_payment_report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Billing Reports';
            $data['active_sub_menu'] = 'GAS Payment';

            $table_name = 'gas_bill_payment';
            $data['desco_bill_payment'] = $this->common_model->getData($table_name);

            $table_name = 'add_house';
            $data['desco_meter'] = $this->common_model->getData($table_name);
             $data['house'] = $desco_meter=$this->input->post('desco_meter');
           $this->load->view('common/header', $data);
            $this->load->view('gas_payment_report/gas_payment_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('gas_payment_report/js_gas_payment_report', $data);
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
            $data['active_sub_menu'] = 'GAS Payment';

            $table_name = 'add_house';
            $data['desco_meter'] = $this->common_model->getData($table_name);

            $date_from=$this->input->post('date_from');
            $data['dtfrm']=$this->input->post('date_from');

            $date_to=$this->input->post('date_to');
            $data['dtrto']=$this->input->post('date_to');

            $desco_meter=$this->input->post('desco_meter');

            $data['house'] = $desco_meter=$this->input->post('desco_meter');
            $this->load->view('common/header', $data);
            
            $table_name = 'gas_bill_payment';
            $data['desco_bill_payment'] = $this->common_model->getData($table_name);
            if($this->input->post('details')){
                
                
                
                if($desco_meter!="" && $date_from!="" && $date_to!=""):
                    $result= $this->db->query("select * from gas_bill_payment where (date(`payment_date`) between '$date_from' and '$date_to') and hid='$desco_meter'");
                    $data['desco_bill_payment'] = $result->result();
    
                elseif($date_from!="" && $date_to!="" && $desco_meter==""):
                    $result= $this->db->query("select * from gas_bill_payment where date(`payment_date`) between '$date_from' and '$date_to'");
                    $data['desco_bill_payment'] = $result->result();
                elseif($date_from=="" && $date_to=="" && $desco_meter!=""):
                    
                    
                    $data['desco_bill_payment'] = $this->common_model->getDataWhere($table_name,'hid',$desco_meter);
                endif;
                $this->load->view('gas_payment_report/gas_payment_report', $data);
                
             }if($this->input->post('summary')){
                 
                 
                
                 
                
                if($desco_meter!="" && $date_from!="" && $date_to!=""):
                    $result= $this->db->query("select * from gas_bill_payment where (date(`payment_date`) between '$date_from' and '$date_to') and hid='$desco_meter' group by hid");
                    $data['desco_bill_payment'] = $result->result();
    
                elseif($date_from!="" && $date_to!="" && $desco_meter==""):
                    $result= $this->db->query("select * from gas_bill_payment where date(`payment_date`) between '$date_from' and '$date_to' group by hid");
                    $data['desco_bill_payment'] = $result->result();
                elseif($date_from=="" && $date_to=="" && $desco_meter!=""):
                    
                    
                    $data['desco_bill_payment'] = $this->db->group_by('hid')->where('hid', $desco_meter)->get($table_name)->result();
                endif;
                $this->load->view('gas_payment_report/gas_payment_report_summary', $data);
                 
             }
             
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('gas_payment_report/js_gas_payment_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

     public function deletepayment() {
		  
		  $id = $this->input->post('id');
		  $rid = $this->db->where('id', $id)->get('gas_bill_payment')->row()->rid;
		  $this->db->where('id', $rid)->update('gas_bill', array('status'=>1));
		  $this->db->where('id', $id)->delete('gas_bill_payment');
		  echo 'ok';		  
	  }

}

?>

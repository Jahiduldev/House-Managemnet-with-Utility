<?php

class Market_visit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Operation';
            $data['active_sub_menu'] = 'Market Visit';

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header', $data);
            $this->load->view('market_visit/market_visit', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('market_visit/js_market_visit', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addMarketVisit() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');

            $company = mysql_real_escape_string($this->input->post('company'));
            $market = mysql_real_escape_string($this->input->post('market'));

          
            $contact_person = mysql_real_escape_string($this->input->post('contact_person'));
            $mobile = mysql_real_escape_string($this->input->post('mobile'));
            $email = mysql_real_escape_string($this->input->post('email'));
            $note = mysql_real_escape_string($this->input->post('note'));

            

            
            $date = date('Y-m-d H:i:s');

            $data_designation = array(
                'employee_id' => $this->session->userdata('emp_id'),
                'company_id' => $company,
               
                'market' => $market,
                
                'person' => $contact_person,
                'mobile' => $mobile,
                'email' => $email,
                'note' => $note,
                'date' => $date
            );


            $insert_result = $this->common_model->insertData('market_visit', $data_designation);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('market_visit');
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

}
?>

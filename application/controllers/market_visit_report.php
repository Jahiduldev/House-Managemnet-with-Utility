<?php

class Market_visit_report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Operation';
            $data['active_sub_menu'] = 'Market Visit Report';

            $this->load->view('common/header_ssp', $data);
            $this->load->view('market_visit_report/market_visit_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('market_visit_report/js_market_visit_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {


        $table = 'market_visit';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'company_id', 'dt' => 0, 'formatter' => function ($rowvalue, $row) {
                    $res_company = $this->common_model->getDataWhere("company", "id", $rowvalue);
                    foreach ($res_company as $row):
                        $company_name = $row->company_name;
                    endforeach;
                    return $company_name;
                }),
            array('db' => 'market', 'dt' => 1),
			array('db' => 'person', 'dt' => 2),
			array('db' => 'mobile', 'dt' => 3),
			array('db' => 'email', 'dt' => 4),
			array('db' => 'note', 'dt' => 5),
			array('db' => 'date', 'dt' => 6),
            array('db' => 'status', 'dt' => 7, 'formatter' => function ($rowvalue, $row) {
                    if ($rowvalue == 0) {
                        return 'Pending';
                    } else {
                        return 'Done';
                    }
                }),
            array('db' => 'id', 'dt' => 8, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="' . site_url("market_visit_report/editClient/" . $rowvalue) . '">
      <button class="btn btn-primary btn-xs">Add Client</button></a>';
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
       $emp_id= $this->session->userdata('emp_id');
       $condition="employee_id=".$emp_id;
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns,'',$condition)
        );
    }

   

    public function editClient() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');

            $id = $this->uri->segment(3);

            $date = date('Y-m-d');

            $data_designation = array(
                
                'status' => 1
            );

            $insert_result = $this->common_model->updateData('market_visit', $data_designation, 'id', $id);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('market_visit_report');
        else:
            redirect('home');
        endif;
    }

}

?>

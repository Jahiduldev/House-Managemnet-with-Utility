<?php

class Member_request_app extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'Members Request';

            $this->load->view('member_request_app/header',$data);
            $this->load->view('member_request_app/member_request_app',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('member_request_app/js_member_request_app',$data);
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {

        $table = 'confirm_info';
        $primaryKey = 'id';
        $columns = array(
                array('db' => 'id', 'dt' => 0),
                array('db' => 'army_name', 'dt' => 1),
                array('db' => 'army_id', 'dt' => 2),
                array('db' => 'contact_no', 'dt' => 3),
                array('db' => 'email', 'dt' => 4),
                array('db' => 'id', 'dt' => 5,'formatter' => function ($rowvalue, $row) {
                            return '<a  href="'. site_url("member_request_app/ApprovedReq/".$rowvalue).'">
      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil">Approved</i></button></a>';
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
        $groupBy = '`s_id`';
        $joinQuery='';
        $where='s1=0';
        $order='id DESC';
        echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns,$joinQuery,$where)
        );

    }


    public function ApprovedReq() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'Members Request';

            $id = $this->uri->segment(3);

            $res= $this->db->query("select * from confirm_info where id=$id");
            $get_result = $res->result();
            if(count($get_result)>0):
                foreach ($get_result as $row) :
                    $s_id =  $row->s_id;
                    $army_id =  $row->army_id;
                    $contact_no =  $row->contact_no;
                    $email =  $row->email;

                    $data = array(
                            'contact_no' => $contact_no,
                            'email' =>  $email

                    );
                    $table_name='successfull_officers';
                    $insert_result = $this->common_model->updateData($table_name,$data,'id',$s_id);
                    if($insert_result):

                        $data = array(
                                's1' => 1
                             

                        );
                        $table_name='confirm_info';
                        $insert_result = $this->common_model->updateData($table_name,$data,'id',$id);
                        $this->session->set_userdata('msg_title', 'Success');
                        $this->session->set_userdata('msg_body','Successfully Updated' );
                    else:
                        $this->session->set_userdata('msg_title', 'Warning');
                        $this->session->set_userdata('msg_body','Failed' );
                    endif;



                endforeach;
            endif;


            redirect('member_request_app');
        else:
            redirect('home');
        endif;
    }


}
?>

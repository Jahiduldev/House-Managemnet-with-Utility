<?php

class View_company extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Administrator';
            $data['active_sub_menu'] = 'View Company';

            $this->load->view('common/header_ssp', $data);
            $this->load->view('view_company/view_company', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('view_company/js_view_company', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {


        $table = 'company';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'company_name', 'dt' => 0),
            array('db' => 'company_address', 'dt' => 1),
           
            //    array('db' => 'date', 'dt' => 3),
            array('db' => 'id', 'dt' => 2, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="' . site_url("view_company/editCompany/" . $rowvalue) . '">
      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
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
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    public function editCompany() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'View Company';
            $id = $this->uri->segment(3);
            $res = $this->db->query("select * from company where id=$id");
            $data['get_company_data'] = $res->result();
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('edit_company/edit_company', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('edit_company/js_edit_company', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editCompanyData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $id = mysql_real_escape_string($this->input->post('id'));
            $company_name = mysql_real_escape_string($this->input->post('company_name'));
            $company_address = mysql_real_escape_string($this->input->post('company_address'));
            //$company_code = mysql_real_escape_string($this->input->post('company_code'));
            $status = mysql_real_escape_string($this->input->post('status'));

            $date = date('Y-m-d');

            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/company';
            $config['allowed_types'] = 'gif|jpg|png';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
            $config['max_size'] = '60000';
            $config['max_width'] = '';
            $config['max_height'] = '';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data['upload_data'] = '';

            if (!$this->upload->do_upload('userfile')) :
                $error = $this->upload->display_errors();
                $data['upload_data'] = $error;
                $fileName = '';
                $data_company = array(
                    'company_name' => $company_name,
                    'company_address' => $company_address,
                     
                    'date' => $date,
                    'status' => $status
                );
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                //  print_r($upload_data);
                $fileName = $upload_data['file_name'];

                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/employee/' . $fileName;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();




                $data_company = array(
                    'company_name' => $company_name,
                    'company_address' => $company_address,
                     
                    'image_name' => $fileName,
                    'date' => $date,
                    'status' => $status
                );
            endif;




            $insert_result = $this->common_model->updateData('company', $data_company, 'id', $id);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('view_company');
        else:
            redirect('home');
        endif;
    }

}

?>

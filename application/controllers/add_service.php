<?php

class Add_service extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'CLient Panel';
            $data['active_sub_menu'] = 'Add Service/Complain';


            $table_name = 'complain_type';
            $data['complain_type_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('add_service/add_service', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_service/js_add_service', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addCompanyData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2,3,4,5,6,7))):
            $data['base_url'] = $this->config->item('base_url');
            date_default_timezone_set("Asia/Dhaka");
			$user_id = $this->session->userdata('user_id');
            $com_type = mysql_real_escape_string($this->input->post('com_type'));
            $client_note = mysql_real_escape_string($this->input->post('client_note'));
            
            $status = mysql_real_escape_string($this->input->post('status'));

            $datetime = date('Y-m-d H:i:s');

            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads/company';
            $config['allowed_types'] = 'gif|jpg|png|pdf';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
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
            else:
                $upload_data = $this->upload->data();
                $data['upload_data'] = $upload_data;
                //  print_r($upload_data);
                $fileName = $upload_data['file_name'];

                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/uploads/company/'.$fileName;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();



            endif;

            $data_company = array(
                'cid' => $user_id,
                'comid' => $com_type,
               
                'comimg' => $fileName,
                'datetime' => $datetime,
                'status' => 4
            );


            $insert_result56 = $this->common_model->insertDataGetId('client_complain', $data_company);
			
			  $data2 = array(
                    'cid' => $user_id,
                    'comid' => $insert_result56,
                    'client_note' => $client_note,                
                    'datetime' => date('Y-m-d H:i:s')
                );

                $this->common_model->insertData('complain_note', $data2);

            if ($insert_result56):
                $this->session->set_userdata('msg_title', 'Successfully Complain Submitted');
              

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_service');
        else:
            redirect('home');
        endif;
    }

}

?>

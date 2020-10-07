<?php

class Add_house extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'House Configuration';
            $data['active_sub_menu'] = 'Add House';


            $table_name = 'status';

            $data['get_status_data'] = $this->common_model->getData($table_name);

            $data['employee'] = $this->db->get('employee')->result();

            $this->load->view('common/header', $data);
            $this->load->view('add_house/add_house', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_house/js_add_house', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addCompanyData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
         
            $house_name = mysql_real_escape_string($this->input->post('house_name'));
            $house_code = mysql_real_escape_string($this->input->post('house_code'));
            $house_address = mysql_real_escape_string($this->input->post('house_address'));
            $emp= mysql_real_escape_string($this->input->post('emp'));
            $notes = mysql_real_escape_string($this->input->post('notes'));

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
                'house_name' => $house_name,
		'house_code' => $house_code,
                'emp_id'=>$emp,
                'address' => $house_address,
                'notes' => $notes,
                'imgg' => $fileName,
                'datetime' => $date,
                'status' => 1
            );


            $insert_result = $this->common_model->insertData('add_house', $data_company);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_house');
        else:
            redirect('home');
        endif;
    }

}

?>

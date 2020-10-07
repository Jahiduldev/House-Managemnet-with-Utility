<?php

class All_houses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'House Configuration';
            $data['active_sub_menu'] = 'View House';
$data['employee'] = $this->db->get('employee')->result();
            $this->load->view('common/header', $data);
            $this->load->view('house_view/all_house', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js_ssp', $data);
            $this->load->view('house_view/js_all_house', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getTableData() {


        $table = 'add_house';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'house_name', 'dt' => 0),
            array('db' => 'house_code', 'dt' => 1),
            array('db' => 'emp_id', 'dt' => 2, 'formatter'=> function($rowvalue, $row){ return $this->db->where('id', $rowvalue)->get('employee')->row()->emp_name; }),
            array('db' => 'address', 'dt' => 3),
            array('db' => 'notes', 'dt' => 4),
            array('db' => 'imgg', 'dt' => 5, 'formatter' => function ($rowvalue, $row) { return '<img src="'.base_url().'public/uploads/employee/'.$rowvalue.'">'; }),
            array('db' => 'id', 'dt' => 6, 'formatter' => function ($rowvalue, $row) {
                    return '<a  href="javascript:void(0)" onclick="gethouse('.$rowvalue.')">
      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
      <a  href="javascript:void(0)" onclick="deletehouse('.$rowvalue.')"> <button class="btn btn-primary btn-xs">x</button></a>';
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

                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, '', "status=1")
        );
    }

          public function gethouse() {

                  echo json_encode($this->common_model->getDataWhere('add_house', 'id', $this->input->post('id')));
                  //echo $this->input->post('id');          
         }

            public function delhouse() {
                    

                  $this->db->where('id', $this->input->post('id'));
                  if($this->db->update('add_house', array('status'=>0)))
                  echo 'House Deleted !';         
         }

         
    public function update() {



                    $config['overwrite'] = false;
                    $config['upload_path'] = './public/uploads/employee';
                    $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
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
                        $config['source_image'] = './public/uploads/employee/'.$fileName;
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 150;
                        $config['height'] = 150;

                        $this->load->library('image_lib', $config);

                        $this->image_lib->resize();



                    endif;

if($fileName!=''){
                     $data = array(

                            'house_name'=> $this->input->post('hname'),
                            'house_code'=> $this->input->post('hcode'),
                            'address' => $this->input->post('address'),
                            'emp_id' => $this->input->post('emp'),
                            'notes' => $this->input->post('hnote'),
                            'imgg'  => $fileName
                      );
}else{

$data = array(

                            'house_name'=> $this->input->post('hname'),
                            'house_code'=> $this->input->post('hcode'),
                            'address' => $this->input->post('address'),
                            'emp_id' => $this->input->post('emp'),
                            'notes' => $this->input->post('hnote')
                      );
}
                     $this->db->where('id', $this->input->post('hid'));
                     $this->db->update('add_house', $data);
                     
                redirect('all_houses');
              }

    public function editClient() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Corporate Profile';
            $data['active_sub_menu'] = 'View Client';
            $id = $this->uri->segment(3);

            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);

            $res = $this->db->query("select * from client where id=$id");
            $data['get_client_data'] = $res->result();
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('edit_client/edit_client', $data);
            $this->load->view('common/footer', $data);
              $this->load->view('common/js', $data);
            $this->load->view('edit_client/js_edit_client', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');

        else:
            redirect('home');
        endif;
    }

    public function editClientData() {
        if (in_array($this->session->userdata('role_id'), array(1, 2))):
            $data['base_url'] = $this->config->item('base_url');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $id = mysql_real_escape_string($this->input->post('id'));
            $company = mysql_real_escape_string($this->input->post('company'));
            $client = mysql_real_escape_string($this->input->post('client'));
            $status = mysql_real_escape_string($this->input->post('status'));

            $date = date('Y-m-d');

            $data_client = array(
                'company_id' => $company,
                'client_name' => $client,
                'status' => $status
            );

            $insert_result = $this->common_model->updateData('client', $data_client, 'id', $id);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('view_client');
        else:
            redirect('home');
        endif;
    }

}

?>

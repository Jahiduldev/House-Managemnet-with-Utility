<?php

class Upload extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Gallery Admin';
            $data['active_sub_menu'] = 'Upload';

            $this->load->view('upload/upload',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            $data['base_url'] = $this->config->item('base_url');
            $this->load->view('login/login', $data);
        endif;
    }

    public function uploadData() {

        if (in_array($this->session->userdata('role_id'), array(1,2))):

            // $txtEditor= htmlspecialchars($this->input->post('txtEditor'));//htmlspecialchars_decode will decode character to html
            $select_cat=  $this->input->post('select_cat');
            $select_sub_folder=  $this->input->post('select_sub_folder');
            $recent_album_title=  $this->input->post('recent_album_title');
            date_default_timezone_set("Asia/Dhaka");

            //  $config['file_name'] = hash('sha1', "TUSHAR");
            $config['overwrite'] = false;
            $config['upload_path'] = './public/uploads';
            $config['allowed_types'] ='*';   //'gif|jpg|png|mp4|ogg|webm|mov|mpeg|avi';
            $config['max_size'] = '60000';
            $config['max_width'] = '';
            $config['max_height'] = '';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data['upload_data'] = '';
            $date_time = date('Y-m-d H:i:s');
            if (!$this->upload->do_upload('userfile')) :
                $error = $this->upload->display_errors();
                $data['upload_data']=$error;
                $fileName= $this->input->post('youtube');
                $result= $this->db->query("insert into upload values('NULL','$fileName','$recent_album_title','$select_cat','$select_sub_folder','$date_time')");
            //$this->session->set_userdata('msg_title', 'Warning');
            // $this->session->set_userdata('msg_body','Failed '.$error);
            else:
                $upload_data = $this->upload->data();
                $data['upload_data']=$upload_data;
                //  print_r($upload_data);
                $fileName= $upload_data['file_name'];
                $result= $this->db->query("insert into upload values('NULL','$fileName','$recent_album_title','$select_cat','$select_sub_folder','$date_time')");
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Upload Successfully');

            endif;

            redirect('upload');
        else:
            $data['base_url'] = $this->config->item('base_url');
            $this->load->view('login/login', $data);
        endif;

    }


    public function getSubFolder() {

        $cat_id=$this->input->post('cat_id');
        $querySubMenuData= $this->db->query("select * from sub_folder where cat_id='$cat_id'");
        echo '<option value="">Choose Your Sub-Folder</option>';
        foreach($querySubMenuData ->result() as $row):
            echo '<option value="'.$row->id.'">'.$row->sub_folder_name.'</option>';
        endforeach;

    }


    public function getTableData() {
        $folder_id=$this->input->post('folder_id');
        $queryTableData= $this->db->query("select * from upload where sub_folder_id='$folder_id'");
        foreach($queryTableData ->result() as $row):
            $id= $row->id;
            $file_name= $row->file_name;
            $file_type= $row->file_type;
            if($file_type ==1) {
                $file_type_name='Slide Gallery';
            }elseif($file_type ==2) {
                $file_type_name='Picture Gallery';
            }elseif ($file_type ==3) {
                $file_type_name='Video Gallery';
            }elseif ($file_type ==4) {
                $file_type_name='You Tube Video Gallery';
            }elseif ($file_type ==5) {
                $file_type_name='Animation Gallery';
            }elseif ($file_type ==6) {
                $file_type_name='Publication  Gallery';
            }elseif ($file_type ==7) {
                $file_type_name='Home Page Image';
            }elseif ($file_type ==8) {
                $file_type_name='Animation Video Gallery';
            }
            $sub_folder_id= $row->sub_folder_id;
            $queryFolderData= $this->db->query("select * from sub_folder where id='$sub_folder_id'");
            foreach($queryFolderData ->result() as $rowF):
                $folder_name = $rowF->sub_folder_name;
            endforeach;
            echo '<tr class="gradeX">';
            echo '<td>'.$file_type_name.'</td>';
            echo '<td>'.$folder_name.'</td>';
            echo '<td>'.$file_name.'</td>';
            echo '<td>'.'<button class="btn btn-danger btn-xs" onclick="deleteFile('.$id.');">Delete File</button>
                  <button class="btn btn-danger btn-xs" onclick="deleteFolder('.$folder_id.');">Delete Folder</button>'.'</td>';

            echo '</tr>';
        endforeach;
    }



    public function deleteFile() {
        $file_id=$this->input->post('file_id');
        $queryDeleteData= $this->db->query("DELETE FROM upload WHERE id = '$file_id' ");
        if($queryDeleteData):
            $this->session->set_userdata('msg_title', 'Success');
            $this->session->set_userdata('msg_body', 'Delete Successfully');
        else:
            $this->session->set_userdata('msg_title', 'Warning');
            $this->session->set_userdata('msg_body', 'Delete Failed');
        endif;
        redirect('upload');

    }

    public function deleteFolder() {
        $folder_id=$this->input->post('folder_id');
        $queryDeleteData= $this->db->query("DELETE FROM upload WHERE sub_folder_id = '$folder_id' ");
        $queryDeleteData2= $this->db->query("DELETE FROM sub_folder WHERE id = '$folder_id' ");
        if($queryDeleteData && $queryDeleteData2):
            $this->session->set_userdata('msg_title', 'Success');
            $this->session->set_userdata('msg_body', 'Delete Successfully');
        else:
            $this->session->set_userdata('msg_title', 'Warning');
            $this->session->set_userdata('msg_body', 'Delete Failed');
        endif;
        redirect('upload');

    }
}
?>

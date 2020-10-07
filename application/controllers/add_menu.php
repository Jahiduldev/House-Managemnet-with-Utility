<?php

class Add_Menu extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Administrator';
            $data['active_sub_menu'] = 'Add Menu';
            $table_name='menu';
            $data['get_menu_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header',$data);
            $this->load->view('add_menu/add_menu',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
             $this->load->view('add_menu/js_add_menu',$data);
        else:
            redirect('home');
        endif;
    }

    public function addMenu() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $menu_name = mysql_real_escape_string($this->input->post('menu_name'));
            $data = array(
                    'menu_name' => $menu_name
            );
            $table_name='menu';
            $insert_result = $this->common_model->insertData($table_name, $data);
            if($insert_result):
                $this->session->set_userdata('login_msg', 'Added Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Added Fail');
            endif;
            redirect('add_menu');
        else:
            redirect('home');
        endif;
    }
	
	 public function editMenu() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
			 $menu_id = mysql_real_escape_string($this->input->post('edit_menu_id'));
            $menu_name = mysql_real_escape_string($this->input->post('edit_menu_name'));
            $data = array(
                    'menu_name' => $menu_name
            );
            $table_name='menu';
            $insert_result = $this->common_model->updateData($table_name, $data,"menu_id",$menu_id);
            if($insert_result):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;
            redirect('add_menu');
        else:
            redirect('home');
        endif;
    }
	
	    public function getMenuData() {
      
            $data['base_url'] = $this->config->item('base_url');
            $menu_id = mysql_real_escape_string($this->input->post('menu_id'));
           
            $table_name='menu';
            $result = $this->common_model->getDataWhere($table_name,"menu_id",$menu_id);
          echo json_encode($result);
           
        
    }



}
?>

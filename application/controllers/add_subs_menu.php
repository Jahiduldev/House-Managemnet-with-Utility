<?php

class Add_Subs_menu extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Administrator';
            $data['active_sub_menu'] = 'Add Sub Menu';

            $table_name='subs_menu';
            $data['get_sub_menu_data'] = $this->common_model->getData($table_name);
            $table_name='menu';
            $data['get_role_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header',$data);
            $this->load->view('add_subs_menu/add_subs_menu',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('add_subs_menu/js_add_subs_menu',$data);
        else:
        redirect('home');
        endif;
    }

    public function addSubsMenu() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $menu_id = mysql_real_escape_string($this->input->post('select_menu'));

            $sub_menu_name = mysql_real_escape_string($this->input->post('sub_menu_name'));
            $url = mysql_real_escape_string($this->input->post('url'));
            $data = array(
                    'menu_id' => $menu_id,
                    'sub_menu_name' => $sub_menu_name,
                    'url' => $url
            );
            $table_name='subs_menu';
            $insert_result = $this->common_model->insertData($table_name, $data);
            if($insert_result):
                $this->session->set_userdata('login_msg', 'Added Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Added Fail');
            endif;
            redirect('add_subs_menu');
        else:
          redirect('home');
        endif;
    }
	
	
		    public function getSubMenuData() {
      
            $data['base_url'] = $this->config->item('base_url');
            $sub_menu_id = mysql_real_escape_string($this->input->post('sub_menu_id'));
           
            $table_name='subs_menu';
            $result = $this->common_model->getDataWhere($table_name,"sub_menu_id",$sub_menu_id);
          echo json_encode($result);
           
        
    }

		 public function editSubMenu() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
			 $sub_menu_id = mysql_real_escape_string($this->input->post('edit_menu_id'));
            $sub_menu_name = mysql_real_escape_string($this->input->post('edit_menu_name'));
            $data = array(
                    'sub_menu_name' => $sub_menu_name
            );
            $table_name='subs_menu';
            $insert_result = $this->common_model->updateData($table_name, $data,"sub_menu_id",$sub_menu_id);
            if($insert_result):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;
            redirect('add_subs_menu');
        else:
            redirect('home');
        endif;
    }


}
?>

<?php

class Add_subs_menu2 extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Administrator';
            $data['active_sub_menu'] = 'Add Sub Menu';

            $table_name='subs_menu2';
            $data['get_sub_menu_data'] = $this->common_model->getData($table_name);
            $table_name='menu';
            $data['get_role_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header',$data);
            $this->load->view('add_subs_menu2/add_subs_menu2',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
        else:
            redirect('home');
        endif;
    }

    public function addSubsMenu() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
            $select_menu = mysql_real_escape_string($this->input->post('select_menu'));
            $select_sub_menu = mysql_real_escape_string($this->input->post('select_sub_menu'));

            $sub_menu_name = mysql_real_escape_string($this->input->post('sub_menu_name'));
            $url = mysql_real_escape_string($this->input->post('url'));
            $data = array(
                    'menu_id' => $select_menu,
                    'sub_menu_id' => $select_sub_menu,
                    'sub_menu2_name' => $sub_menu_name,
                    'url' => $url
            );
            $table_name='subs_menu2';
            $insert_result = $this->common_model->insertData($table_name, $data);
            if($insert_result):
                $this->session->set_userdata('login_msg', 'Added Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Added Fail');
            endif;
            redirect('add_subs_menu2');
        else:
            redirect('home');
        endif;
    }

    public function getSubMenu() {

        $menu_id=$this->input->post('menu_id');
        $querySubMenuData= $this->db->query("select * from subs_menu where menu_id='$menu_id'");
        echo '<option value="">Choose Your Sub Menu</option>';
        foreach($querySubMenuData ->result() as $row):
            echo '<option value="'.$row->sub_menu_id.'">'.$row->sub_menu_name.'</option>';
        endforeach;

    }
	
	
	
	 public function getSubMenuData() {
      
            $data['base_url'] = $this->config->item('base_url');
            $sub_menu_id = mysql_real_escape_string($this->input->post('subs_menu2_id'));
           
            $table_name='subs_menu2';
            $result = $this->common_model->getDataWhere($table_name,"subs_menu2_id",$sub_menu_id);
          echo json_encode($result);
           
        
    }

		 public function editSubMenu() {
        if (in_array($this->session->userdata('role_id'), array(1,2))):
            $data['base_url'] = $this->config->item('base_url');
			 $sub_menu2_id = mysql_real_escape_string($this->input->post('edit_menu_id'));
            $sub_menu2_name = mysql_real_escape_string($this->input->post('edit_menu_name'));
            $data = array(
                    'sub_menu2_name' => $sub_menu2_name
            );
            $table_name='subs_menu2';
            $insert_result = $this->common_model->updateData($table_name, $data,"subs_menu2_id",$sub_menu2_id);
            if($insert_result):
                $this->session->set_userdata('login_msg', 'Updated Successfull');
            else:
                $this->session->set_userdata('login_msg', 'Updated Fail');
            endif;
            redirect('add_subs_menu2');
        else:
            redirect('home');
        endif;
    }



}
?>

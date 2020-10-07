<?php

class Sup_assign_project extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Supplier';
            $data['active_sub_menu'] = 'Supplier Assign Project';
            
           
            $table_name = 'broker_table';
            $data['get_employee_data'] = $this->common_model->getData($table_name);
            $table_name = 'company';
            $data['get_company_data'] = $this->common_model->getData($table_name);
            $table_name = 'status';
            $data['get_status_data'] = $this->common_model->getData($table_name);
            $this->load->view('common/header', $data);
            $this->load->view('sup_assign_project/sup_assign_project', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('sup_assign_project/js_sup_assign_project', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addProject() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3))):
            $data['base_url'] = $this->config->item('base_url');

            $employee = mysql_real_escape_string($this->input->post('employee'));
              date_default_timezone_set("Asia/Thimbu");
           
            $date = date('Y-m-d H:i:s');

            $delete_result = $this->db->query("delete from sup_assign_project where sup_id='$employee'");

            $allPost = $this->input->post();
            foreach ($allPost as $key => $project_id):
                if ($key == 'employee' || $key == 'note' || $key == 'status')
                    continue;
                $result_project = $this->common_model->getDataWhere('project', 'id', $project_id);

                foreach ($result_project as $row_project):
                    $company = $row_project->company_id;
                    $client = $row_project->client_id;
                    $name = $row_project->name;
                endforeach;

                $data_designation = array(
                    'sup_id' => $employee,
                    'company_id' => $company,
                    'client_id' => $client,
                    'project' => $project_id,
                    'project_name' => $name,
                   
                    'date' => $date
                );


                $insert_result = $this->common_model->insertData('sup_assign_project', $data_designation);
                
           
                endforeach;



            if (1):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('sup_assign_project');
        else:
            redirect('home');
        endif;
    }

    public function getClient() {

        $data['base_url'] = $this->config->item('base_url');
        $com_id = mysql_real_escape_string($this->input->post('com_id'));

        $table_name = 'client';
        $result = $this->common_model->getDataWhere($table_name, "company_id", $com_id);
        echo '<option value="">Select</option>';
        if (count($result) > 0) {
            foreach ($result as $row):
                ?>
                <option value="<?= $row->id; ?>"><?= $row->client_name; ?></option>
                <?php
            endforeach;
        }
    }

    public function getProject() {

        $data['base_url'] = $this->config->item('base_url');
        $emp_id = mysql_real_escape_string($this->input->post('emp_id'));
      

        $queryCom = $this->db->query("select * from company");
        $resultCom = $queryCom->result();
        if (count($resultCom) > 0):
            foreach ($resultCom as $rowCom) :
                $company_id = $rowCom->id;
                $company_name = $rowCom->company_name;
                ?>
                <div class="form-group"> 
                    <label for="inputSuccess" class="col-sm-12 control-label col-lg-12"><?= $company_name ?></label>
                    <?php
                    $queryClient = $this->db->query("select * from client where company_id='$company_id'");
                    $resultClient = $queryClient->result();
                    if (count($resultClient) > 0):
                        foreach ($resultClient as $rowClient) :
                            $client_id = $rowClient->id;
                            $client_name = $rowClient->client_name;
                            ?>
                            <div class="col-lg-10 col-lg-offset-2">
                                <label for="inputSuccess" class="col-sm-12 control-label col-lg-12"><?= $client_name ?></label>
                                <?php
                                $queryProject = $this->db->query("select * from project where company_id='$company_id' and client_id='$client_id'");
                                $resultProject = $queryProject->result();
                                if (count($resultProject) > 0):
                                    foreach ($resultProject as $rowProject) :
                                        $project_id = $rowProject->id;
                                        $project_name = $rowProject->name;

                                        $queryProjectCheck = $this->db->query("select * from sup_assign_project where sup_id='$emp_id' and project='$project_id'");
                                        $resultProjectCheck = $queryProjectCheck->result();
                                        if (count($resultProjectCheck) > 0):
                                            ?>
                                            <label class="col-sm-10 control-label col-lg-10 col-lg-offset-2"> <input type="checkbox"id="chk<?= $project_id; ?>" name="chk<?= $project_id; ?>" value="<?= $project_id ?>" checked> <?= $project_name ?></label>
                                            <?php
                                        else:
                                            ?>
                                            <label class="col-sm-10 control-label col-lg-10 col-lg-offset-2"> <input type="checkbox"id="chk<?= $project_id; ?>" name="chk<?= $project_id; ?>" value="<?= $project_id ?>"> <?= $project_name ?></label>
                                        <?php
                                        endif;
                                    endforeach;
                                endif;
                                ?>  

                            </div> 

                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>

                <?php
            endforeach;
        endif;
       
       
    }

}
?>

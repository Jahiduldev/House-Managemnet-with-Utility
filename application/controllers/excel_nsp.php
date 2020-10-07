<?php

class Excel_nsp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        //    $this->load->library('ExportXLS');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13))):
            $data['base_url'] = $this->config->item('base_url');
            include_once 'excelclass/export-xls.class.php';
            $filename = 'excel_nsp_report.xls';
            $xls = new ExportXLS($filename);

            $header[] = "Tranx Type";
            $header[] = "Note";
            $header[] = "Income";
            $header[] = "Expense";
            $header[] = "Date & Time";


            $xls->addHeader($header);

            $today = date('Y-m-d');
            $data['date_from'] = $date_from;
            $data['date_to'] = $date_to;
            $data['r_type'] = $r_type;
            if ($date_from != '' && $date_to != '' && $r_type != ''):
                $sql_get_data = $this->db->query("select * from master_detail where transaction_type='$r_type' and (date between '$date_from' and '$date_to')");
            elseif ($date_from != '' && $date_to != ''):
                $sql_get_data = $this->db->query("select * from master_detail where  (date between '$date_from' and '$date_to')");
            elseif ($r_type != ''):
                $sql_get_data = $this->db->query("select * from master_detail where transaction_type='$r_type'");
            else:
                $sql_get_data = $this->db->query("select * from master_detail");
            endif;

            $get_report_data = $sql_get_data->result();
            foreach ($get_report_data as $row) :  // Date Filter


                $id = $row->id;
                $table_id = $row->table_id;
                $table_type = $row->table_type;
                $transaction_type = $row->transaction_type;
                $date = $row->date;


                $query_1 = $this->db->query("select * from table_relation where id='$table_type'");
                $result_1 = $query_1->result();
                foreach ($result_1 as $row_add):
                    $table_name = $row_add->name;
                    $trx_type = $row_add->type;
                endforeach;



                if ($table_type == 1):

                    $query_1 = $this->db->query("select * from $table_name where id='$table_id'");
                    $result_1 = $query_1->result();
                    foreach ($result_1 as $row_add):
                        $note = '';
                        $gross_salary = $row_add->gross_salary;

                        $salary_add = $row_add->salary_add;
                        $salary_add_arr = explode('-', $salary_add);

                        $salary_deduct = $row_add->salary_deduct;
                        $salary_deduct_arr = explode('-', $salary_deduct);

                        $sum_add = 0;
                        $sum_deduct = 0;
                        if (count($salary_add_arr) > 0):
                            foreach ($salary_add_arr as $value) :

                                $query_2 = $this->db->query("select * from employee_salary_add where id='$value'");
                                $result_2 = $query_2->result();
                                foreach ($result_2 as $row2):
                                    $amount = $row2->amount;
                                    $sum_add += $amount;
                                endforeach;

                            endforeach;
                        endif;

                        if (count($salary_deduct_arr) > 0):
                            foreach ($salary_deduct_arr as $value) :

                                $query_2 = $this->db->query("select * from employee_salary_deduct where id='$value'");
                                $result_2 = $query_2->result();
                                foreach ($result_2 as $row2):
                                    $amount = $row2->amount;
                                    $sum_deduct += $amount;
                                endforeach;

                            endforeach;
                        endif;


                        $expense = ($gross_salary + $sum_add) - $sum_deduct;
                        $total_expense = $total_expense + $expense;
                        $note = '';
                        $income = '';


                    endforeach;

                elseif ($table_type == 2):

                    $query_1 = $this->db->query("select * from $table_name where id='$table_id'");
                    $result_1 = $query_1->result();
                    foreach ($result_1 as $row_add):
                        $expense = $row_add->amount;
                        $total_expense = $total_expense + $expense;
                        $note = $row_add->note;
                        $income = '';
                    endforeach;

                elseif ($table_type == 3):

                    $query_1 = $this->db->query("select * from $table_name where id='$table_id'");
                    $result_1 = $query_1->result();
                    foreach ($result_1 as $row_add):
                        $expense = '';
                        $note = $row_add->note;
                        $income = $row_add->amount;
                        $total_income = $total_income + $income;
                    endforeach;


                elseif ($table_type == 4):

                    $query_1 = $this->db->query("select * from $table_name where id='$table_id'");
                    $result_1 = $query_1->result();
                    foreach ($result_1 as $row_add):
                        $expense = '';
                        $note = $row_add->note;
                        $income = $row_add->payment;
                        $total_income = $total_income + $income;
                    endforeach;

                elseif ($table_type == 5):

                    $query_1 = $this->db->query("select * from $table_name where id='$table_id'");
                    $result_1 = $query_1->result();
                    foreach ($result_1 as $row_add):
                        $expense = $row_add->payment;
                        $total_expense = $total_expense + $expense;
                        $note = $row_add->note;
                        $income = '';
                    endforeach;

                elseif ($table_type == 6):

                    $query_1 = $this->db->query("select * from $table_name where id='$table_id'");
                    $result_1 = $query_1->result();
                    foreach ($result_1 as $row_add):
                        $expense = $row_add->amount;
                        $total_expense = $total_expense + $expense;
                        $note = $row_add->purpose;
                        $income = '';
                    endforeach;

                endif;




                $k = 0;
                $user_data[$k++] = $trx_type;
                $user_data[$k++] = $note;
                $user_data[$k++] = $income;
                $user_data[$k++] = $expense;
                $user_data[$k++] = $date;




                $xls->addRow($user_data);
            endforeach;

            $user_data[$k++] = '';
            $user_data[$k++] = 'Total';
            $user_data[$k++] = $total_income;
            $user_data[$k++] = $total_expense;
            $user_data[$k++] = $date;




            $xls->addRow($user_data);

            $xls->sendFile();

        else:
            redirect('home');
        endif;
    }

}

?>

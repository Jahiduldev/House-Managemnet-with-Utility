<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tenant_payment_report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Billing Reports';
            $data['active_sub_menu'] = 'Tenant Payment';

            $table_name = 'bill_payment';
            $data['desco_bill_payment'] = $this->common_model->getData($table_name);

            $table_name = 'add_house';
            $data['desco_meter'] = $this->common_model->getData($table_name);
            $table_name = 'house_client';
            $data['project_data'] = $this->common_model->getData($table_name);

            
           $this->load->view('common/header', $data);
            $this->load->view('tenant_payment_report/tenant_payment_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('tenant_payment_report/js_tenant_payment_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }


    public function searchData() {

        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Billing Reports';
            $data['active_sub_menu'] = 'Tenant Payment';

            $table_name = 'add_house';
            $data['desco_meter'] = $this->common_model->getData($table_name);

            $data['dtfrm'] = $date_from = $this->input->post('date_from');
            $data['dtto'] = $date_to = $this->input->post('date_to');
            $data['house'] = $desco_meter=$this->input->post('desco_meter');
            $table_name = 'bill_payment';
            

            if($this->input->post('details')){
                
               $data['desco_bill_payment'] = $this->common_model->getData($table_name);    
                
               if($desco_meter!="" && $date_from!="" && $date_to!=""){
    				
    				$result= $this->db->query("select * from bill_payment where  pay_date between '$date_from' and '$date_to' and hid='$desco_meter'");
                    $data['desco_bill_payment'] = $result->result();
    			}
    			if($date_from!="" && $date_to!="" && $desco_meter==""){ //echo 'ok'; die();
                    
    				$result= $this->db->query("select * from bill_payment where pay_date between '$date_from' and '$date_to'");
                    $data['desco_bill_payment'] = $result->result();
                }
    			if($date_from=="" && $date_to=="" && $desco_meter!=""){
                    
    				$table_name = 'bill_payment';
                    $data['desco_bill_payment'] = $this->common_model->getDataWhere($table_name,'hid',$desco_meter);
                } 
            }
            if($this->input->post('summary')){
                
               
                $data['desco_bill_payment'] = $this->db->group_by('hid')->get($table_name)->result();
                
                if($desco_meter!="" && $date_from!="" && $date_to!=""){
    				
    				$result= $this->db->query("select * from bill_payment where  pay_date between '$date_from' and '$date_to' and hid='$desco_meter' group by hid");
                    $data['desco_bill_payment'] = $result->result();
    			}
    			if($date_from!="" && $date_to!="" && $desco_meter==""){ //echo 'ok'; die();
                    
    				$result= $this->db->query("select * from bill_payment where pay_date between '$date_from' and '$date_to' group by hid");
                    $data['desco_bill_payment'] = $result->result();
                }
    			if($date_from=="" && $date_to=="" && $desco_meter!=""){
                    
    				$table_name = 'bill_payment';
                    $data['desco_bill_payment'] = $this->db->group_by('hid')->where('hid',$desco_meter)->get($table_name)->result();
                } 
            }

            $this->load->view('common/header', $data);
            if($this->input->post('details')){
                
                $this->load->view('tenant_payment_report/tenant_payment_report', $data);
            }
            if($this->input->post('summary')){
                
                $this->load->view('tenant_payment_report/tenant_payment_summary.php', $data);
            }
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('tenant_payment_report/js_tenant_payment_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

 public function tenant_print_eng()
    {     
    
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Billing Reports';
            $data['active_sub_menu'] = 'Tenant Payment';
          
           // $this->load->view('common/header', $data);
            $table_name = 'bill_payment';
            $clinet_id = $this->uri->segment(3);
            $data['clinet_id'] = $clinet_id;

            $data['clinet_payments'] = $this->common_model->getDataWhere_payment($table_name,'id',$clinet_id);


            $this->load->view('tenant_payment_report/tenant_print_eng',$data);
            //$this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);

            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
    }

    public function tenant_print()
    {     
    
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Billing Reports';
            $data['active_sub_menu'] = 'Tenant Payment';
          
           // $this->load->view('common/header', $data);
            $table_name = 'bill_payment';
            $clinet_id = $this->uri->segment(3);
            $data['clinet_id'] = $clinet_id;

            $data['clinet_payments'] = $this->common_model->getDataWhere_payment($table_name,'id',$clinet_id);


            $this->load->view('tenant_payment_report/tenant_print',$data);
            //$this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);

            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
    }

      public function cancelpayment(){  
		$id = $this->input->post('id');
		//$bill_payment = $this->db->where('id',)->get('bill_payment')->row();
		if($this->db->where('table_id', $id)->where('table_type', 7)->where('transaction_type', 1)->delete('master_detail')){			
			
			$this->db->where('id', $id)->delete('bill_payment');
			echo 'Payment Deleted Successfuly';
		}
	
	}

       public function getprint(){  
           
           error_reporting(0);
		  
		  $advance = 0;
		$rent_t = 0;
		$service = 0;
		$garage = 0;
		$current_due = 0;
		$total_total = 0;
		$electrict = 0;
		$gas = 0;
		$water = 0;
		$utility_due = 0;
		$total_utitotal = 0;
		$late_total=0;
		$advance_t =0;
		$pre_due=0;  $rent_pay_tot =0;	   $current_due_tot =0; $pre_uti_due_tot =0;  $uti_pay_tot=0;			   
		$total_pre_due =0; $total_total_amount =0; $total_pay_amount =0; $total_uti_due =0;
		  
		$html = '<table class="display table table-bordered" id="hidden-table-info">
			<thead>
				<tr>						
					<th>House</th>
					<th>Space</th>										 
					<th>Date</th>
					<th>Month</th>										
					<th>Name</th>
					<th>Advance</th>                               
					<th>Rent</th>                               
					<th>Service</th>                  
					<th>Garage</th>
					<th>Previous Arreas</th>
					<th>Total</th>
					<th>Pay Total</th>
					<th>Rent Arreas</th>
						
					<th>Late</th>
					<th></th> 
					
					<th>Desco Bill</th>
					<th>Titas Bill</th>                  
					<th>Wasa Bill </th>
					<th>Previous Arreas</th>
					<th>Total</th>
				
					<th>Pay Total</th>
					<th>Utility Arreas</th>
					<th></th>
					<th>Previous Arreas</th>
					<th>Total</th>
					<th>Pay Total</th>
					<th>Current Arrears</th>
					
					<th>Note</th>
				</tr>
			</thead> 
			<tbody>'; 
			
			

		foreach(json_decode($this->input->post('paymentarray')) as $row){
		    $rent = 0;$advance =0;
			  
			   $hosclient = $this->db->where('id', $row->clinet_id)->get('house_client')->row();
			   if($hosclient->room != ''){
							
					$flat = $this->db->where('id', $hosclient->room)->get('add_room')->row()->room_name;
			   }else{
					
					$flat = $this->db->where('id', $hosclient->flat)->get('add_flat')->row()->flat_name;
			   }
			   
			   $cuurent_due_rent = $this->db->where('clinet_id', $row->clinet_id)->where('bill_id', 7)->get('bill')->row()->amount;
			   $cuurent_due_util = $this->db->where('clinet_id', $row->clinet_id)->where('bill_id', 10)->get('bill')->row()->amount;
			   
			   $total  = (int)$hosclient->pre_due + (int)$row->rent + (int)$row->service + (int)$row->garage;
			   $utitotal = (int)$hosclient->pre_uti_due + (int)$row->water + (int)$row->gas + (int)$row->electrict;
			   
			   $pay_renttotal  = (int)$row->rent_pay;
			   $pay_utitotal = (int)$row->utility_pay;
			   
			   $tot_pre_due = $hosclient->pre_uti_due+$hosclient->pre_due;
			   $tot_pre_uti_due = $row->utility_due + $row->current_due;
			   
               if($row->mont!=''){
                   
                    $mo = explode('/',$row->mont);
			        $m = date("M", mktime(0, 0, 0, $mo[0], 10)); 
			        $month = $m.'/'.$mo[1];   
                   
                    }else{ $month='';  
			   }
			   if($row->note!='Advance'){
			       
			       $rent = $row->rent; 	   }else{  $advance = $row->rent;
			   }
			   $html .= '<tr>
					
					<td>'. $this->db->where('id', $row->hid)->get('add_house')->row()->house_name .'</td>
					<td>'. $hosclient->code.'</td>
					<td>'. $row->pay_date .'</td>
					<td>'. $month .'</td>
					<td>'. $hosclient->client_name .'</td>
					<td>'. $advance .'</td>
					<td>'. $rent .'</td>
					<td>'. $row->service .'</td>
					<td>'. $row->garage .'</td>
					<td>'. $hosclient->pre_due .'</td>
					<td>'. $total .'</td>
					<td>'. $pay_renttotal .'</td>
					<td>'. $cuurent_due_rent .'</td>
					<td>'. $row->late .'</td>
					
					<td></td>
					
					<td>'. $row->electrict .'</td>
					<td>'. $row->gas .'</td>
					<td>'. $row->water .'</td>
					<td>'. $hosclient->pre_uti_due .'</td>
					<td>'. $utitotal .'</td>
					<td>'. $pay_utitotal .'</td>
					<td>'. $row->utility_due .'</td>
					
					<td></td>
					
					<td>'. $tot_pre_due .'</td>
					<td>'. $hosclient->totalamount .'</td>
					<td>'. $row->pay_amount .'</td>
					<td>'. $tot_pre_uti_due .'</td>
					
					
					<td>'. $row->note .'</td>
			   </tr>';
			   
			   $rent_t += $rent;
			   $advance_t += $advance;
			   $service += $row->service;
			   $garage  += $row->garage;
			   $current_due += $cuurent_due_rent;
			   $total_total += $total;
			   $electrict += $row->electrict;
			   $gas += $row->gas;
			   $water += $row->water;
			   $utility_due += $row->utility_due;
			   $total_utitotal += $utitotal;
			   $late_total += $row->late;
			   
			   
			   $pre_due += $hosclient->pre_due;
			   $rent_pay_tot += $pay_renttotal;
			   $current_due_tot += $cuurent_due_rent;			   
			   $pre_uti_due_tot += $hosclient->pre_uti_due;			    
			   $uti_pay_tot += $pay_utitotal;
			   
			   $total_pre_due += $tot_pre_due;
			   $total_total_amount += $hosclient->totalamount;
			   $total_pay_amount += $row->pay_amount;
			   $total_uti_due += $tot_pre_uti_due;
					 
			   
			    
		  }
		  
		  $html .= '<tr>
				<td colspan="5" align="right"><strong>Total</strong></td>
			    <td><strong>'. $advance_t .'</strong></td>
				<td><strong>'. $rent_t .'</strong></td>
				<td><strong>'. $service .'</strong></td>
				<td><strong>'. $garage .'</strong></td>
				<td><strong>'. $pre_due .'</strong></td>
				<td><strong>'. $total_total .'</strong></td>
				
				<td><strong>'. $rent_pay_tot .'</strong></td>
				<td><strong>'. $current_due_tot .'</strong></td>
				
				<td><strong>'. $late_total .'</strong></td>
				<td></td>
				<td><strong>'. $electrict .'</strong></td>
				<td><strong>'. $gas .'</strong></td>
				<td><strong>'. $water .'</strong></td>
				<td><strong>'. $pre_uti_due_tot .'</strong></td>
				<td><strong>'. $total_utitotal .'</strong></td>					
				<td><strong>'. $uti_pay_tot .'</strong></td>
				<td><strong>'. $utility_due .'</strong></td>			 
				<td></td>
				
				<td><strong>'. $total_pre_due .'</strong></td>
				<td><strong>'. $total_total_amount .'</strong></td>
				<td><strong>'. $total_pay_amount .'</strong></td>
				<td><strong>'. $total_uti_due .'</strong></td>
				 
				
				<td></td>
		   </tr>';
		  
		  
		  $html .= '</tbody></table>';	
		  echo $html;
	 }
}

?>

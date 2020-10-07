<?php

class Common_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertData($table_name, $data) {
        return $this->db->insert($table_name, $data);
    }

    public function updateData($table_name, $data, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
        return $this->db->update($table_name, $data);
    }

    public function updateData2($table_name, $data, $column_name, $column_value, $column_name2, $column_value2) {
        $this->db->where($column_name, $column_value);
        $this->db->where($column_name2, $column_value2);
        return $this->db->update($table_name, $data);
    }

    public function insertDataGetId($table_name, $data) {
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }

    public function getData($table_name) {
        $query = $this->db->get($table_name);
        return $query->result();
    }
	
	
	  public function getDataWhere4($table_name, $column_name, $column_value)
	  {
        $this->db->where($column_name, $column_value);
        $query = $this->db->get($table_name);
        return $query->result();
      }
     public function getDataWhere_room($table_name, $column_name, $column_value)
     {
        
        $this->db->where($column_name, $column_value);
        $this->db->order_by("hid", "asc");
        $query = $this->db->get($table_name);
        return $query->result(); 

          
    }
	
	
     public function getDataWhere_floor($table_name, $column_name, $column_value) {
        // $this->db->where($column_name, $column_value);
        // $this->db->order_by("hid", "asc");
        // $query = $this->db->get($table_name);
        // return $query->result();

        $this->db->select('*');
		$this->db->from('add_house');
		//$this->db->where('add_house.status','add_floor.status', 1);
		$this->db->join('add_floor', 'add_floor.hid = add_house.id');
		//$query = $this->db->get();
		//$this->db->where('status', 1);
        $this->db->order_by("hid", "asc");
		$query = $this->db->get()->result();
        return $query;

        
    }
    public function getDataWhere($table_name, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
        $query = $this->db->get($table_name);
        return $query->result();
    }
    public function getDataWhere_flat($table_name, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
       $this->db->order_by("hid", "asc");
        $query = $this->db->get($table_name);
        
        return $query->result();
    }
   public function getDataWhere_getRoomData($table_name, $column_value) {
      

	    $this->db->select('*');
	    $this->db->from('add_room'); 
	    $this->db->join('add_flat', 'add_flat.id=add_room.fltid');
	    $this->db->join('add_floor', 'add_floor.id=add_room.floid');
	    $this->db->join('add_house', 'add_house.id=add_room.hid');
	    $this->db->where('add_room.id',$column_value);          
	    $query = $this->db->get()->result(); 
	    return $query;

    }
    public function getDataWhere2($table_name, $column_name, $column_value, $column_name2, $column_value2) {
        $this->db->where($column_name, $column_value);
        $this->db->where($column_name2, $column_value2);
        $query = $this->db->get($table_name);
        return $query->result();
    }
	
	public function getproject($project_id) {
       
			$rows='';
			 $query_22 = $this->db->query("select * from project where id='$project_id'");
             $result_22 = $query_22->result();
			
			foreach($result_22 as $valu){
				
				$rows .= $valu->name;
			}
		
		return $rows;
    }
	
	
	
	
	
	
	
		public function getbillupdate($id) {
       
			 $query_22 = $this->db->query("select house_client.id as id,house_client.client_id as client_id, house_client.elec_rate, house_client.client_name as client_name,house_client.code as code, house_client.status as status, house_client.advance as advance, bill.bill_id as bill_id,bill.amount as amount  from house_client,bill where house_client.id='$id' and house_client.id=bill.clinet_id ");
             $result_22 = $query_22->result();
			
			
		
		return $result_22;
    }
	
	
	
	
	
	
	
	
	
	
	
	
public function getSelectedDataWhere($emp_id) { 
        
		$rows='';
			
			 $query_22 = $this->db->query("select *,sum(due) as due,sum(payment) as payment from broker_payment where broker_id='$emp_id' group by project_id");
             $result_22 = $query_22->result();
			
			foreach($result_22 as $valu){
				$d = $valu->due;
				$p = $valu->payment;
				$cm = $d -$p;
				$rows .= '<tr><td>'. $this->common_model->getproject($valu->project_id ).'</td><td>'. $valu->due .'</td><td>'. $valu->payment .'</td><td>'.$cm .'</td>
				</tr>';
			}
		
		return $rows;
    }
	
	public function getDeductDataWhere($emp_id) { 
        
	$rows='';
			
			 $query_22 = $this->db->query("select *,sum(due) as due,sum(payment) as payment from broker_payment where broker_id='$emp_id' group by project_id");
             $result_22 = $query_22->result();
			
			foreach($result_22 as $valu){
				
				$rows .= '<tr><td>'. $this->common_model->getproject($valu->project_id ).'</td><td>'. $valu->due .'</td>
				</tr>';
			}
		
		return $rows;
    }

public function getDataWhere_payment($table_name, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($table_name);
        return $query->result();
    }

}

?>

<?php
/**
 * created by aemin on 27FEB20
 */
class Main_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
	public $listTable= "lists";
	public $categoryTable="category";
	public function select($where,$join,$order){ 
		$sWhere= array(
			'whichlist' =>$where ,
			'active' 	=> "1"
		);
		$this->db->select('*');
		$this->db->from($this->listTable);
		$this->db->where($sWhere);
		$this->db->join('users', 'users.user_id = lists.'.$join)->order_by('lists.'.$order, 'DESC');
		return $this->db->get()->result();
	}
	public function existance($data=array()){
		$tableName = $data['tableName'];
		$column    = $data['column'];
		$columnData= $data['column_data'];
	/*	$column_2 = $data['column_2'];
		$columnData_2 = $data['column_data_2'];	*/
		

		if($data['column_data']){ 
			$sWhere = array(
				$data['column'] => $data['column_data'] ,
				$data['column_2'] => $data['column_data_2']
				 );
		} else { 
			$sWhere = array(
				$data['column'] => $data['column_data'] ,
			);

		}


		$this->db->select('*');
		$this->db->from($tableName);
		$this->db->where($sWhere);
		//$this->db->where($column_2,$columnData_2);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;			
		}
	}
	/*88888888888888888888888888888888888888888888888888888888888888888888*/
	public function select_w($data=array()){
		$this->load->model("Main_model");
		echo $this->Main_model->existance(array('tableName' =>"users",'column'=>"user_id",'column_data'=>"0" ));
		$this->db->select("*");
		$this->db->from($data['dbname']);
		$this->db->where($data['dbname'].".".$data['where'],$data['cat_id']);
		$this->db->where($data['dbname'].".active","1");
		if(!empty($data['join_table'])){
			$this->db->join($data['join_table'],$data['join_table'].".".$data['join_column']." = ".$data['dbname'].".".$data['join_column_main']);}
			if(!empty($data['join_table_2'])){$this->db->join($data['join_table_2'],$data['join_table_2'].".".$data['join_column_2']." = ".$data['dbname'].".".$data['join_column_main_2']);}
			$this->db->order_by($data['order_table'].".".$data['order_column'],$data['order_type']);
			return $this->db->get()->result();
		}
		public function select_singular($data=array()){
			$query = $this->db->get_where($data['tableName'], array($data['column'] => $data['column_data']));
			return $query->row();
		}
		public function delete_w($data=array()){
			$update = array(
				"active" =>"0" ,
			);
			$this->db->where($data['column'], $data['column_data']);
			return $this->db->update($data['tableName'], $update);
		}

		public function lists_contents($data=array()){

//sanırım buna gerek kalmayacak.
			$this->db->select('*');
			$this->db->from("owners");
			$this->db->where('');

		}

		/*888888888888888888888888888888888888888888888888888888888888888888888*/
		public function select_category(){
			$sWhere = array('active' =>'1');
			$this->db->select('*');
			$this->db->from($this->categoryTable);
			$this->db->where($sWhere);
			$this->db->where('active',"1");
			$this->db->order_by('cat_id','DESC');
			return $this->db->get()->result();
		}
		public function insert($db,$data){
			return $this->db->insert($db, $data);
		}
		public function delete($id){
			$data = array(
				"active" =>"0" ,
			);
			$this->db->where('lists_id', $id);
			return $this->db->update($this->listTable, $data);
		//return $this->db->delete($this->listTable,$data);
		}
		public function update($db,$data){
			$updateData =array(
				'list_type'=>$data['column'],
				'update_date'=>$data['update_date'],
				);
		$this->db->where($data['column_w'], $data['column_data_w']);
		return $this->db->update($db, $updateData);
	}
	public function rowcount($data){
		$sWhere= array(
			'whichlist' =>$data ,
			'active' 	=> "1"
		);
		$this->db->from($this->listTable);
		return $this->db->where($sWhere)->count_all_results();
	}
}
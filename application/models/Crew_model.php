<?php 
/**
 * created by aemin on FEB2820
 */

class Crew_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public $usersTable ="users";
	public $listsTable ="lists";
	public $contentsTable = "contents";

	public function select(){
		$this->db->select('*');
		$this->db->from($this->usersTable);
		return $this->db->get()->result();

	} 

	public function load_list($data){
		$this->db->select('*');
		$this->db->from($this->contentsTable)->group_start();
		$this->db->where('owner_id',$data);
		$this->db->where('active','1')->group_end();
		$this->db->order_by('cat_id', 'desc')->order_by('list_type', 'asc');
		return $this->db->get()->result();

	}
}
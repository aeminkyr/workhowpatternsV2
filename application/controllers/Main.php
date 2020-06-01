<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(isset($_SESSION['logged_in'])) {redirect('main/category');}
		$viewdata = array(
			'title' 	=> $this->teamName." Teknofest Work How",
			'logourl'	=> base_url('assets/img/loginlogo.png'),
			'actionurl'	=>base_url('auth/login_verify')
		);
		$this->load->view('auth/login',$viewdata);
	}

	public $teamName= "Squadron";

	public function register(){
		if(isset($_SESSION['logged_in'])){redirect('main');}
		$viewdata = array(
			'title' 	=> $this->teamName." Teknofest Kayıt",
			'logourl'	=> base_url('assets/img/loginlogo.png'),
			'actionurl'	=>base_url('auth/register')
		);
		$this->load->view('auth/register',$viewdata);

	}

	public function home()
	{
		if(!isset($_SESSION['logged_in'])){redirect("main");}
		
		$this->load->model("main_model");
		$select = $this->main_model->select_category();
		$viewdata = array(
			'title' =>$this->teamName." | Kategori",
			'select'=>$select
		);

		$this->load->view("category",$viewdata);
	}

	public function lists($cat_id){
			//yaz
		$column = 'cat_id';

		$selectList = array(		
			'where'		 	 		=>"cat_id",
			$column 		 		=>$cat_id,
			'dbname'		 		=>"lists",
			'order_table'	 		=>"lists",
			'order_column'	 		=>"lists_id",
			'order_type'	 		=>"ASC",
			'join_table'     		=>"users",
			'join_column'	 		=>"user_id",
			'join_column_main'		=>"creator_id",
		);

		$selectContent = array(
			'where'		 	 		=>"cat_id",
			$column 		 		=>$cat_id,
			'dbname'		 		=>"contents",
			'order_table'	 		=>"contents",
			'order_column'	 		=>"reg_date",
			'order_type'	 		=>"DESC",
			'join_table'     		=>"users",
			'join_column'	 		=>"user_id",
			'join_column_main'		=>"owner_id",
		);

		



		$this->load->model("main_model");
		$selectListName = $this->main_model->select_w($selectList);
		$selectListContent = $this->main_model->select_w($selectContent); 

		$single_data = array(
			'tableName'		=>"category",
			'column' 	    =>"cat_id",
			'column_data'	=>$cat_id 
		);
		$cat_name =$this->main_model->select_singular($single_data);

		$viewdata = array(
			'title' =>$this->teamName ,
			'select'=> $selectListName,
			'select_content' => $selectListContent,
			'percent'=>"50",
			'single_data'=>$cat_name
		);
		$this->load->view("lists",$viewdata);

	}



	public function category(){


		$this->load->model("main_model");

		$data1 = array(
			'tableName' =>"category" ,
			'column'=>"cat_id",
			'column_data'=>"1"
		);
		//$this->main_model->existance($data1);


		$select = $this->main_model->select_category();
		$viewdata = array(
			'title' =>$this->teamName." | Kategori",
			'select'=>$select
		);

		$this->load->view("category",$viewdata);

	}

	public function insert(){
		$postWhere = $this->input->post("where");
		$this->load->model("main_model");
		if($postWhere=="lists0"){
			$post = $this->input->post("content");
			$data = array(
				'content' =>$post,
				'user_id' => $_SESSION['id'],
				'active'  => "1" 
			);
			$db= "lists";
			$insert = $this->main_model->insert($db,$data);
			if($insert){
				redirect("main");
			}} else if($postWhere=="category"){

				$content = $this->input->post("content");
				$description = $this->input->post("description");
				$data = array(
					'cat_name' =>$content,
					'cat_description'=> $description,
					'active'  => "1" 
				);
				$db= "category";
				$insert = $this->main_model->insert($db,$data);
				if($insert){
					redirect("main/category");
				}

			}else if($postWhere=="lists") {
				$content = $this->input->post("content");
				$select = $this->input->post("selectrole");
				$cat_id = $this->input->post("category_id");
				$db="lists";
				$data = array(
					'cat_id'	=>$cat_id,
					'list_name'	=>$content,
					'creator_id'=>$_SESSION['id'],
					'list_type'	=>$select,
					'active'	=>'1'

				);
				$insert = $this->main_model->insert($db,$data);
				if($insert){
					redirect("main/lists/".$cat_id);
				}


			} else if($postWhere=="contents"){
				$content = $this->input->post("content");
				$cat_id = $this->input->post("category_id");
				$list_id= $this->input->post("list_id");
				$db="contents";
				$data = array(
					'cat_id' =>$cat_id,
					'list_type'=>$list_id,
					'owner_id' => $_SESSION['id'],
					'active' =>"1",
					'content' =>$content

				);

				$insert = $this->main_model->insert($db,$data);
				if($insert){redirect("main/lists/".$cat_id);}






			} else {
				echo "hatalı giriş";
			}

		}
		public function delete($id){
			$this->load->model("main_model");
			//$data = array('lists_id' =>$id);
			$delete = $this->main_model->delete($id);
			if($delete){
				redirect("main");
			}
		}

		public function delete_w($lists_id,$id){
			$this->load->model("main_model");
			$model_data = array(
				'tableName'  	=>"lists" ,
				'column' 		=> "lists_id",
				'column_data'   => $id
			);

			$update = $this->main_model->delete_w($model_data);

			if($update){
				redirect('main/lists/'.$lists_id);
			}



		}

		public function delete_content($lists_id,$id){
			$this->load->model("main_model");
			$model_data = array(
				'tableName'  	=>"contents" ,
				'column' 		=> "contents_id",
				'column_data'   => $id
			);

			$update = $this->main_model->delete_w($model_data);

			if($update){
				redirect('main/lists/'.$lists_id);
			}
		}

		public function delete_category($id){
			$this->load->model("main_model");
			$model_data = array(
				'tableName'  	=>"category" ,
				'column' 		=> "cat_id",
				'column_data'   => $id
			);

			$update = $this->main_model->delete_w($model_data);

			if($update){
				redirect('main/category');
			}
		}

		public function update($id,$which){
			$this->load->helper('date');
			$turkey = now("Turkey");
			$update_date = mdate("%Y-%m-%d %H:%i:%s",$turkey);

			$data = array(
				'column_w' 		=>"list_type",
				'column_data_w' =>$which,
				'column' 		=>"list_type",
				'column_data'   =>"1",
				'update_date'	=> $update_date );
			$db= "contents";
			$this->load->model("main_model");
			$update= $this->main_model->update($id,$data);
			if($update){redirect("main");}
		}

		public function adopt($cat_id,$contents_id){
			//burası content sahiplenmek isteyenler için
			$this->load->helper('date');
			$turkey = now("Turkey");
			$update_date = mdate("%Y-%m-%d %H:%i:%s",$turkey);

			$db= "owners";

			$data = array(
				'user_id'	 =>$_SESSION['id'],
				'content_id' =>$contents_id
			);
			$data_exist = array(
				'tableName'		=>$db,
			 	'column'   		=>"user_id",
			 	'column_data' 	=>$_SESSION['id'],
			 	'column_2'		=>'content_id',
			 	'column_data_2' =>$contents_id
 		
			 );
			$this->load->model("main_model");

			$exist = $this->main_model->existance($data_exist);

			if($exist){ echo "you already adopt this tag!"; } else {
			$insert = $this->main_model->insert($db,$data);
			if($insert){redirect($_SERVER['HTTP_REFERER']);} }

		}




		public function rowcount($data){
			$modeldata = array('whichlist' =>$data );
			$this->load->model("main_model");
			echo $this->main_model->rowcount($modeldata);
		}
	}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		$CI->load->library('session');
		$this->load->helper('url');
		$this->load->model('Adminmodel');
	}

	public function index(){ 
		if($this->session->userdata('4k_id')) {
			redirect(base_url().'index.php/admin/dashboard');
		}else{
			$this->load->view("admin/login");
		}
	}

	public function adminlogin(){
		$email= $this->input->post('email');
		$password= $this->input->post('password');
		$where='password="'.$password.'" and email="'.$email.'"';
		$where .= " and level = 1";
		$result = $this->Adminmodel->admin_varify($where);
// 		echo $this->upload->display_errors();
		if(count($result) > 0) {
			$this->session->set_userdata('gs_email',$result[0]->email);
			$this->session->set_userdata('gs_id',$result[0]->id);	
			$this->session->set_userdata('gs_name',$result[0]->fullname);	
			$this->session->set_userdata('gs_app_id',$result[0]->app_id);
			$this->session->set_userdata('gs_app_key',$result[0]->key_app);		
			echo '100';
		} else {
			echo '200'; 
		}
	}

	public function logout(){
		$this->session->unset_userdata('4k_email');
		$this->session->unset_userdata('4k_id');
		redirect(base_url().'index.php/admin');
	}

	public function dashboard(){
		
		/*for wallpaper Count*/
		$where='type="tv"';
		$id_user = $this->session->userdata('gs_id');			
	

		$result = $this->Adminmodel->tvshow($where);
		$data['tvshow']=sizeof($result);

		$where='v_type="tv"';
		
		$result = $this->Adminmodel->tvvideo($where);
		$data['tvshowvideo']=sizeof($result);

		$where =" id_user = ".$id_user;
		$result = @$this->Adminmodel->movievideo_cnt($where);
		$data['movielist']=sizeof($result);

		$result = @$this->Adminmodel->sportvideo_cnt($where);
		$data['sportlist']=sizeof($result);

		$result = $this->Adminmodel->newsvideo_cnt($where);
		$data['newslist']=sizeof($result);

		$result = $this->Adminmodel->channellist();
		$data['channellist']=sizeof($result);

		/*for category Count*/
		$result = $this->Adminmodel->category_list_where($where);
		$data['category']=sizeof($result); 

		/*Register User*/
		$result = $this->Adminmodel->userlist();
		$data['register_user']=sizeof($result);

		$this->load->view("admin/dashboard", $data);

	}

	public function categorylist(){
		$id_user = $this->session->userdata('gs_id');			
		$where=" id_user = ".$id_user;

		$data['categorydata'] = $this->Adminmodel->category_list_where($where);
		// echo $data[0]->id;
		$this->load->view("admin/categorylist",$data);
	}

	public function addcategory(){
		$this->load->view("admin/addcategory");
	}

	public function savecategory(){
		$category_name=$_POST['category_name'];

		
			$data = array(
				'cat_name' => $category_name,
				'cat_image' => $_POST['category_image'],
				'c_date'=>date('Y-m-d h:i:s'),
				'c_status'=>'enable',
				'id_user'=> $this->session->userdata('gs_id'),
			);
			
			$cat_id=$this->Adminmodel->add_category($data);
		

		

		return $cat_id;
	}

	public function userlist(){
		$data['userlist'] = $this->Adminmodel->userlist();
		$this->load->view("admin/userlist",$data);
	}

	public function earnpoints(){
		$data['userlist'] = $this->Adminmodel->earnlist();
		$this->load->view("admin/earnpoints",$data);
	}

	public function editwallpaper(){
		$id=$_GET['id'];
		$data['categorylist'] = $this->Adminmodel->category_list();
		
		$where='id="'.$id.'"';

		$data['wallpaperlist'] = $this->Adminmodel->wallpaper_by_id($where);
		$this->load->view("admin/editwallpaper",$data);
	}

	public function addwallpaper(){
		$data['wallpaperlist'] = $this->Adminmodel->wallpaperall();
		$data['categorylist'] = $this->Adminmodel->category_list();

		$this->load->view("admin/addwallpaper",$data);
	}

	public function savewallpaper(){
		$wallpaper_name = $_POST['wallpaper_title'];
		$wall_point = $_POST['wall_point'];
		$wall_cat_id = $_POST['wall_category'];
		$wall_type = $_POST['wall_type'];
		$wall_cost = $_POST['wall_cost'];

		if (isset($_FILES['wallpaper_thumbnail']) && !empty($_FILES['wallpaper_thumbnail'])) {
			$config = array(
				'allowed_types' => 'jpg|jpeg|gif|png',
				'upload_path' => FCPATH . 'assets/images/wallpaper',
				'max_size' => '100000',
				'max_width' => '10000',
				'max_height' => '10000'
			);

		/* 	$fileinfo = @getimagesize($_FILES["wallpaper_thumbnail"]["tmp_name"]);
   			$width = $fileinfo[0];
    		$height = $fileinfo[1];

    		$filesize = @filesize($_FILES["wallpaper_thumbnail"]["tmp_name"]) ;*/

    		$data = array(
    			'title' => $wallpaper_name,
    			'imagepath' => $_FILES['wallpaper_thumbnail']['name'],
    			'point' => $wall_point,
    			'category_id'=> $wall_cat_id,
    			'field' => $wall_type,
    			'status' => $wall_cost
/*				'width' => $width,
				'height' => $height,
				'size' => $filesize
*/			);
				$id=$this->Adminmodel->add_wallpaper($data);
			}

			$this->load->library('upload');
			$this->upload->initialize($config);
			$this->upload->do_upload('wallpaper_thumbnail');
			echo $this->upload->display_errors();
			echo $id;

			return $id;
		}

		public function update_wallpaper(){
			$wallpaper_name = $_POST['wallpaper_title'];
			$wall_point = $_POST['wall_point'];
			$wall_cat_id = $_POST['wall_category'];
			$wall_type = $_POST['wall_type'];
			$wall_cost = $_POST['wall_cost'];
			$id = $_POST['id'];

			if (isset($_FILES['wallpaper_thumbnail']) && !empty($_FILES['wallpaper_thumbnail']['name'])) {
				$config = array(
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => FCPATH . 'assets/images/wallpaper',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);
				$wallpaper_thumbnail=$_FILES['wallpaper_thumbnail']['name'];
				// $where='id="'.$id.'"';

				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->do_upload('wallpaper_thumbnail');
				$this->upload->display_errors();
			}else{
				$wallpaper_thumbnail=  $_POST['video_thumbnailimage'];
			}
			$data = array(
				'title' => $wallpaper_name,
				'imagepath' =>$wallpaper_thumbnail,
				'point' => $wall_point,
				'category_id'=> $wall_cat_id,
				'field' => $wall_type,
				'status' => $wall_cost
			);
			$this->Adminmodel->update_wallpaper($data,$id);
		//	echo $id;	echo 'test';
			$res=array('status'=>'200','msg'=>'Sucessfully updated','id'=>$id);
			echo json_encode($res);
		//	return $id;
		}

		/**************************************************************************/

		public function tvshowlist(){

			$where='type="tv"';
			$where .= " and tv_serial.id_user = ".$this->session->userdata('gs_id');
			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where);
			// echo json_encode($data);
			$this->load->view("admin/tvshowlist",$data);
		}
		public function edittvshow(){
			$id=$_GET['id'];
			$where='tvs_id="'.$id.'"';

			$data['categorylist'] = $this->Adminmodel->category_list();

			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where);
			$this->load->view("admin/edittvshow",$data);
		}

		public function addtvshow(){
			$where = 'id_user='.$this->session->userdata('gs_id');
			$data['categorylist'] = $this->Adminmodel->category_list_where($where);
			$tvshow_title = @$_GET['tvshow_title'];
			$tvshow_category = @$_GET['tvshow_category'];
			$thumbnail = @$_GET['tvshow_thumbnail'];
			$showtype = "tv";
				if($tvshow_title){
						$data = array(
							'tvs_name' => $tvshow_title,
							'tvs_image' => $thumbnail,
							'type' => $showtype,
							'fc_id'=> $tvshow_category,
							'tvs_date'=>date('Y-m-d h:i:s'),
							'id_user'=>$this->session->userdata('gs_id')
						);
						$id=$this->Adminmodel->add_tvshow($data);

						// echo $id;
						// return $id;
						if($id){
							$res=array('status'=>'200','msg'=>'Sucessfully Added');
							echo json_encode($res);
						}else{
							$res=array('status'=>'400','msg'=>'fail');
							echo json_encode($res);
						}
					
				}

			$this->load->view("admin/addtvshow",$data);
		}

		public function savetvshow(){
			$tvshow_title = $_POST['tvshow_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$thumbnail = $_POST['tvshow_thumbnail'];
			$showtype = "tv";

			// if (isset($_FILES['tvshow_thumbnail']) && !empty($_FILES['tvshow_thumbnail']['name'])) {
			// 	$config = array(
			// 		'allowed_types' => 'jpg|jpeg|gif|png',
			// 		'upload_path' => FCPATH . 'assets/images/serial',
			// 		'max_size' => '100000',
			// 		'max_width' => '10000',
			// 		'max_height' => '10000'
			// 	);

			// 	$tvshow_thumbnail=$_FILES['tvshow_thumbnail']['name'];

			// 	$this->load->library('upload');
			// 	$this->upload->initialize($config);
			// 	$this->upload->do_upload('tvshow_thumbnail');
			// 	$this->upload->display_errors();
				
			// }

			$data = array(
				'tvs_name' => $tvshow_title,
				'tvs_image' => $thumbnail,
				'type' => $showtype,
				'fc_id'=> $tvshow_category,
				'tvs_date'=>date('Y-m-d h:i:s'),
			);
			$id=$this->Adminmodel->add_tvshow($data);

			// echo $id;
			// return $id;
			if($id){
				$res=array('status'=>'200','msg'=>'Sucessfully Added');
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail');
				echo json_encode($res);
			}
		}

		public function update_tvshow(){
			$tvshow_title = $_POST['tvshow_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$showtype = $_POST['showtype'];
			$id = $_POST['id'];

			
			$tvshow_thumbnail=  $_POST['tvshow_thumbnail'];

			$data = array(
				'tvs_name' => $tvshow_title,
				'tvs_image' => $tvshow_thumbnail,
				'type' => $showtype,
				'fc_id'=> $tvshow_category,
			);
			$this->Adminmodel->update_tvshow($data,$id);
		//	echo $id;	echo 'test';
			
			if($id){
				$res=array('status'=>'200','msg'=>'Sucessfully Added');
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail');
				echo json_encode($res);
			}

		}

		public function savetvshowEpisode(){
			$episode_title = $_POST['episode_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$tvshow_url = $_POST['show_url'];
			$tvshow_desc = $_POST['episode_desc'];
			$mp3_file_name = @$_POST['mp3_file_name'];
			$showtype = "tv";
			$tvv_video_type=$_POST['video_type'];
			$thumbnail = $_POST['tvshow_thumbnail'];

			
				$feature_video='0';
			

		

			if (isset($_FILES['mp3_local']) && !empty($_FILES['mp3_local']['name'])) {
				$config = array(
					'allowed_types' => '*',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);
				$mp3_file_name =$_FILES['mp3_local']['name'];
			}else{
				$mp3_file_name = @$_POST['mp3_file_name'];
			}
			

			if($tvv_video_type=="Server Video"){
				$tvshow_url="";
			}else{
				$mp3_file_name="";
			}

			$data = array(
				'tvv_name' => $episode_title,
				'tvv_thumbnail' => $thumbnail,
				'tvv_video'=>$mp3_file_name,
				'tvv_video_type'=>$tvv_video_type,
				'tvv_video_url'=>$tvshow_url,
				'v_type' => $showtype,
				'ftvs_id'=> $tvshow_category,
				'is_premium' => $feature_video,
				'tvv_description' => $tvshow_desc,
				'tvv_date'=>date('Y-m-d h:i:s'),
				'id_user'=>$this->session->userdata('gs_id')
			);

			$id=$this->Adminmodel->add_tvvideo($data);

		

			if($id){
				$res=array('status'=>'200','msg'=>'Sucessfully Added');
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail');
				echo json_encode($res);
			}

		}

		public function tvshowepisodelist(){
			
			$where='v_type="tv"';
			$where .= " and tv_video.id_user = ".$this->session->userdata('gs_id');

			$data['tvshowepisodelist'] = $this->Adminmodel->tvvideo_by_id($where);
			$this->load->view("admin/tvshowepisodelist",$data);

		}

		public function addtvshowepisode(){

			$where='type="tv"';
			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where);

			$this->load->view("admin/addtvshowepisode",$data);
		}

		public function edittvshowepisode(){
			$id=$_GET['id'];
			$where='tvv_id="'.$id.'"';
			$where1='type="tv"';

			
				$episode_title = @$_GET['episode_title'];
			if($episode_title){
				$tvshow_category = $_GET['tvshow_category'];
				$tvshow_desc = $_GET['episode_desc'];
				$tvv_video_type=$_GET['video_type'];
				$tvshow_url = $_GET['show_url'];
				$thumbnail = $_GET['tvshow_thumbnail'];
				$showtype = "tv";

				
					$feature_video='0';
			
				$mp3_file_name =@$_GET['mp3_file_name'];


				if($tvv_video_type=="Server Video"){
					$tvshow_url="";
				}else{
					$mp3_file_name="";
				}

				$data = array(
					'tvv_name' => $episode_title,
					'tvv_thumbnail' => $thumbnail,
					'tvv_video'=>$mp3_file_name,
					'tvv_video_type'=>$tvv_video_type,
					'tvv_video_url'=>$tvshow_url,
					'ftvs_id'=> $tvshow_category,
					'is_premium' => $feature_video,
					'tvv_description' => $tvshow_desc,
					'tvv_date'=>date('Y-m-d h:i:s')
				);

				$id=$this->Adminmodel->update_video($data,$id);

			

				$res=array('status'=>'200','msg'=>'Sucessfully updated','id'=>$id);
				echo json_encode($res);
		
			}
			$data['categorylist'] = $this->Adminmodel->category_list();

			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where1);

			$data['tvshowepisodelist'] = $this->Adminmodel->tvvideo_by_id($where);
			// echo json_encode($data['tvshowepisodelist']);

			$this->load->view("admin/edittvshowepisode",$data);
		}

		public function updatetvshowEpisode(){
			$id=$_POST['id'];
			$episode_title = $_POST['episode_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$tvshow_desc = $_POST['episode_desc'];
			$tvv_video_type=$_POST['video_type'];
			$tvshow_url = $_POST['show_url'];
			$thumbnail = $_POST['tvshow_thumbnail'];
			$showtype = "tv";

			
				$feature_video='0';
			

			if (isset($_FILES['mp3_local']) && !empty($_FILES['mp3_local']['name'])){
				$mp3_file_name =$_FILES['mp3_local']['name'];
			}else{
				$mp3_file_name =$_POST['mp3_file_name'];
			}


			if($tvv_video_type=="Server Video"){
				$tvshow_url="";
			}else{
				$mp3_file_name="";
			}

			$data = array(
				'tvv_name' => $episode_title,
				'tvv_thumbnail' => $thumbnail,
				'tvv_video'=>$mp3_file_name,
				'tvv_video_type'=>$tvv_video_type,
				'tvv_video_url'=>$tvshow_url,
				'ftvs_id'=> $tvshow_category,
				'is_premium' => $feature_video,
				'tvv_description' => $tvshow_desc,
				'tvv_date'=>date('Y-m-d h:i:s')
			);

			$id=$this->Adminmodel->update_video($data,$id);

		

			$res=array('status'=>'200','msg'=>'Sucessfully updated','id'=>$id);
			echo json_encode($res);
			return $id;
		}

		public function Savevideos(){
			if (isset($_FILES['mp3_local']) && !empty($_FILES['mp3_local'])) {
				$config = array(
					'allowed_types' => 'mp4|mp3|3gp|avi',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);


				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->do_upload('mp3_local');
				$this->upload->display_errors();
				echo $_FILES['mp3_local']['name'];
			}
		}

		/************************Movies*************************************************/

		public function addmovievideo(){
			$where = "id_user = ".$this->session->userdata('gs_id');
			$data['categorylist'] = $this->Adminmodel->category_list_where($where);

			$where='type="movie"';
			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where);

			$this->load->view("admin/addmovievideo",$data);
		}

		public function savemovieshow(){
			$episode_title = $_POST['episode_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$tvshow_url = $_POST['show_url'];
			$tvshow_desc = $_POST['episode_desc'];
			$mp3_file_name =$_POST['mp3_file_name'];
			$showtype = "movie";
			$tvv_video_type=$_POST['video_type'];
			$thumbnail = $_POST['tvshow_thumbnail'];

			if(isset($_POST['feature_video'])){
				$feature_video=$_POST['feature_video'];
			}else{
				$feature_video='0';
			}

			// if (isset($_FILES['tvshow_thumbnail']) && !empty($_FILES['tvshow_thumbnail']['name'])) {
			// 	$config = array(
			// 		'allowed_types' => '*',
			// 		'upload_path' => FCPATH . 'assets/images/serial',
			// 		'max_size' => '100000',
			// 		'max_width' => '10000',
			// 		'max_height' => '10000'
			// 	);
			// }

			if (isset($_FILES['mp3_local']) && !empty($_FILES['mp3_local']['name'])) {
				$config = array(
					'allowed_types' => '*',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);
				$mp3_file_name =$_FILES['mp3_local']['name'];
			}else{
				$mp3_file_name =$_POST['mp3_file_name'];
			}

			if($tvv_video_type=="Server Video"){
				$tvshow_url="";
			}else{
				$mp3_file_name="";
			}

			$data = array(
				'tvv_name' => $episode_title,
				'tvv_thumbnail' => $thumbnail ,
				'tvv_video'=>$mp3_file_name,
				'tvv_video_type'=>$tvv_video_type,
				'tvv_video_url'=>$tvshow_url,
				'v_type' => $showtype,
				'tvv_description' => $tvshow_desc,
				'is_premium' => $feature_video,
				'fc_id'=> $tvshow_category,
				'tvv_date'=>date('Y-m-d h:i:s'),
				'id_user'=>$this->session->userdata('gs_id')
			);

			$id=$this->Adminmodel->add_movievideo($data);

			// $this->load->library('upload');
			// $this->upload->initialize($config);
			// $this->upload->do_upload('tvshow_thumbnail');
			// $this->upload->display_errors();

			if($id){
				$res=array('status'=>'200','msg'=>'Sucessfully Added');
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail');
				echo json_encode($res);
			}
		}

		public function savemovie(){
			$episode = $_POST['episodename'];
			$descripation = $_POST['descripation'];
			$type = $_POST['type'];
			$show_name = $_POST['show_name'];


			if (isset($_FILES['movie_video']) && !empty($_FILES['movie_video'])) {
				$config = array(
					'allowed_types' => 'mp4|mp3|3gp|avi',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '1000000',
					'max_width' => '100000',
					'max_height' => '100000'
				);

				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->do_upload('movie_video');
				$this->upload->display_errors();
			}
			if (isset($_FILES['movie_thumbnail']) && !empty($_FILES['movie_thumbnail'])) {
				$config = array(
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);


				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->do_upload('movie_thumbnail');
				$this->upload->display_errors();
			}

			$data = array(
				'tvv_name' => $episode,
				'tvv_video' => $_FILES['movie_video']['name'],
				'tvv_thumbnail' => $_FILES['movie_thumbnail']['name'],
				'tvv_description' =>$descripation,
				'v_type' => $type,
				'ftvs_id'=> $show_name,
				'tvv_date'=>date('Y-m-d h:i:s'),
			);

			$id=$this->Adminmodel->add_video($data);
			return $id;
		}

		public function movievideolist(){
			
			$id_user = $this->session->userdata('gs_id');
			$where='v_type="movie"';
			$where.=" and movie_video.id_user = ".$id_user;
		
			$data['tvshowepisodelist'] = $this->Adminmodel->movievideo_by_id($where);
			$this->load->view("admin/movievideolist",$data);

		}

		public function editmovievideo(){
			$id=$_GET['id'];
			$where='tvv_id="'.$id.'"';
			$where1='type="movie"';

			$data['categorylist'] = $this->Adminmodel->category_list();

			// $data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where1);

			$data['tvshowepisodelist'] = $this->Adminmodel->movievideo_by_id($where);
			// echo json_encode($data);
			$this->load->view("admin/editmovievideo",$data);
		}

		public function update_movie(){
			$episode = $_POST['episodename'];
			$descripation = $_POST['descripation'];
			$type = $_POST['type'];
			$show_name = $_POST['show_name'];
			$id = $_POST['id'];
			$thumbnail = $_POST['tvshow_thumbnail'];
			$video = $_POST['show_url'];
		
			$data = array(
				'tvv_name' => $episode,
				'tvv_video' => $video ,
				'tvv_thumbnail' => $thumbnail,
				'tvv_description' =>$descripation,
				'v_type' => $type,
				'ftvs_id'=> $show_name,

			);
			$this->Adminmodel->update_video($data,$id);
		
			$res=array('status'=>'200','msg'=>'Sucessfully updated','id'=>$id);
			echo json_encode($res);

		}

		public function updatemovievideo(){
			$id=$_POST['id'];
			$episode_title = $_POST['episode_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$tvshow_desc = $_POST['episode_desc'];
			$tvv_video_type=$_POST['video_type'];
			$tvshow_url = $_POST['show_url'];
			$showtype = "movie";
			$thumbnail = $_POST['tvshow_thumbnail'];

			if(isset($_POST['feature_video'])){
				$feature_video=$_POST['feature_video'];
			}else{
				$feature_video='0';
			}


			

			$data = array(
				'tvv_name' => $episode_title,
				'tvv_thumbnail' => $thumbnail,
				'tvv_video'=>$tvshow_url,
				'tvv_video_type'=>$tvv_video_type,
				'tvv_video_url'=>$tvshow_url,
				'tvv_description' => $tvshow_desc,
				'fc_id'=> $tvshow_category,
				'is_premium' => $feature_video,
				'tvv_date'=>date('Y-m-d h:i:s'),
			);
			print_r($data);
			$id=$this->Adminmodel->update_movievideo($data,$id);

			if($id){
				$res=array('status'=>'200','msg'=>'Sucessfully Added');
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail');
				echo json_encode($res);
			}
		}


		/*************************************************************************/

		public function savesport(){
			$tvshow_title = $_POST['tvshow_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$showtype = "sport";

			if (isset($_FILES['tvshow_thumbnail']) && !empty($_FILES['tvshow_thumbnail']['name'])) {
				$config = array(
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);

				$tvshow_thumbnail=$_FILES['tvshow_thumbnail']['name'];

				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->do_upload('tvshow_thumbnail');
				$this->upload->display_errors();
				
			}

			$data = array(
				'tvs_name' => $tvshow_title,
				'tvs_image' => $_FILES['tvshow_thumbnail']['name'],
				'type' => $showtype,
				'fc_id'=> $tvshow_category,
				'tvs_date'=>date('Y-m-d h:i:s'),
			);
			$id=$this->Adminmodel->add_sport($data);

			// echo $id;
			// return $id;
			if($id){
				$res=array('status'=>'200','msg'=>'Sucessfully Added');
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail');
				echo json_encode($res);
			}
		}

		public function editsportshow(){
			$id=$_GET['id'];
			$where='tvs_id="'.$id.'"';

			$data['categorylist'] = $this->Adminmodel->category_list();

			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where);
			// echo json_encode($data);
			$this->load->view("admin/editsportshow",$data);
		}

// right
		public function addsportclip(){

			$where = "id_user = ".$this->session->userdata('gs_id');
			$data['categorylist'] = $this->Adminmodel->category_list_where($where);
			$where='type="sport"';
			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where);

			$this->load->view("admin/addsportclip",$data);
		}
// Right
		public function savesportclip(){
			$episode_title = $_POST['episode_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$tvshow_desc = $_POST['episode_desc'];
			$tvshow_url = $_POST['show_url'];
			$mp3_file_name =@$_POST['mp3_file_name'];
			$showtype = "sport";
			$tvv_video_type=$_POST['video_type'];
			$thumbnail = $_POST['tvshow_thumbnail'];

			if(isset($_POST['feature_video'])){
				$feature_video=$_POST['feature_video'];
			}else{
				$feature_video='0';
			}

			// if (isset($_FILES['tvshow_thumbnail']) && !empty($_FILES['tvshow_thumbnail'])) {
			// 	$config = array(
			// 		'allowed_types' => 'jpg|jpeg|gif|png',
			// 		'upload_path' => FCPATH . 'assets/images/serial',
			// 		'max_size' => '100000',
			// 		'max_width' => '10000',
			// 		'max_height' => '10000'
			// 	);
			// }

			// if (isset($_FILES['mp3_local']) && !empty($_FILES['mp3_local']['name'])) {
			// 	$config = array(
			// 		'allowed_types' => 'jpg|jpeg|gif|png',
			// 		'upload_path' => FCPATH . 'assets/images/serial',
			// 		'max_size' => '100000',
			// 		'max_width' => '10000',
			// 		'max_height' => '10000'
			// 	);
			// 	$mp3_file_name =$_FILES['mp3_local']['name'];
			// }else{
			// 	$mp3_file_name =@$_POST['mp3_file_name'];
			// }

			// if($tvv_video_type=="Server Video"){
			// 	$tvshow_url="";
			// }else{
			// 	$mp3_file_name="";
			// }

			$data = array(
				'tvv_name' => $episode_title,
				'tvv_thumbnail' => $thumbnail,
				'tvv_video'=>$tvshow_url,
				'tvv_video_type'=>$tvv_video_type,
				'tvv_video_url'=>$tvshow_url,
				'v_type' => $showtype,
				'fc_id'=> $tvshow_category,
				'tvv_description' => $tvshow_desc,
				'is_premium' => $feature_video,
				'tvv_date'=>date('Y-m-d h:i:s'),
				'id_user'=>$this->session->userdata('gs_id')
			);
			$id=$this->Adminmodel->add_sportvideo($data);

			// $this->load->library('upload');
			// $this->upload->initialize($config);
			// $this->upload->do_upload('tvshow_thumbnail');
			// $this->upload->do_upload('mp3_local');
			// $this->upload->display_errors();

			$res=array('status'=>'200','msg'=>'Sucessfully Added');
			echo json_encode($res);

			return $id;
		}

/*Right*/
		public function sportcliplist(){
			
			$where='v_type="sport"';

			$data['tvshowepisodelist'] = $this->Adminmodel->sportvideo_by_id($where);
			$this->load->view("admin/sportcliplist",$data);

		}
// Right
		public function editsportshoweclip(){
			$id=$_GET['id'];
			$where='tvv_id="'.$id.'"';
			
				
				$episode_title = @$_GET['episode_title'];
				$tvshow_category = @$_GET['tvshow_category'];
				$tvshow_desc = @$_GET['episode_desc'];
				$tvv_video_type= @$_GET['video_type'];
				$tvshow_url = @$_GET['show_url'];
				$showtype = "sport";
				$thumbnail = @$_GET['tvshow_thumbnail'];
				if($episode_title != ""){

					if(isset($_POST['feature_video'])){
						$feature_video=$_POST['feature_video'];
					}else{
						$feature_video='0';
					}

				
				

					if($tvv_video_type=="Server Video"){
						$tvshow_url="";
					}else{
						$mp3_file_name="";
					}

					$data = array(
						'tvv_name' => $episode_title,
						'tvv_thumbnail' => $thumbnail,
						'tvv_video'=>$mp3_file_name,
						'tvv_video_type'=>$tvv_video_type,
						'tvv_video_url'=>$tvshow_url,
						'fc_id'=> $tvshow_category,
						'tvv_description' => $tvshow_desc,
						'is_premium' => $feature_video,
						'tvv_date'=>date('Y-m-d h:i:s')
					);
					$id=$this->Adminmodel->update_sportvideo($data,$id);

				

					$res=array('status'=>'200','msg'=>'Sucessfully updated','id'=>$id);
					echo json_encode($res);
				
			}
			$data['categorylist'] = $this->Adminmodel->category_list();

			$data['tvshowepisodelist'] = $this->Adminmodel->sportvideo_by_id($where);
			// echo json_encode($data);
			$this->load->view("admin/editsportshoweclip",$data);
		}

// Right
		public function updatesportshowclip(){
			$id=$_POST['id'];
			$episode_title = $_POST['episode_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$tvshow_desc = $_POST['episode_desc'];
			$tvv_video_type=$_POST['video_type'];
			$tvshow_url = $_POST['show_url'];
			$showtype = "sport";

			if(isset($_POST['feature_video'])){
				$feature_video=$_POST['feature_video'];
			}else{
				$feature_video='0';
			}

			if (isset($_FILES['mp3_local']) && !empty($_FILES['mp3_local']['name'])){
				$mp3_file_name =$_FILES['mp3_local']['name'];
			}else{
				$mp3_file_name =$_POST['mp3_file_name'];
			}

			if (isset($_FILES['tvshow_thumbnail']) && !empty($_FILES['tvshow_thumbnail']['name'])) {
				$config = array(
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);

				$tvshow_thumbnail=$_FILES['tvshow_thumbnail']['name'];
			}else{
				$tvshow_thumbnail=  $_POST['videothumbnailimage'];
			}

			if($tvv_video_type=="Server Video"){
				$tvshow_url="";
			}else{
				$mp3_file_name="";
			}

			$data = array(
				'tvv_name' => $episode_title,
				'tvv_thumbnail' => $tvshow_thumbnail,
				'tvv_video'=>$mp3_file_name,
				'tvv_video_type'=>$tvv_video_type,
				'tvv_video_url'=>$tvshow_url,
				'fc_id'=> $tvshow_category,
				'tvv_description' => $tvshow_desc,
				'is_premium' => $feature_video,
				'tvv_date'=>date('Y-m-d h:i:s')
			);
			$id=$this->Adminmodel->update_sportvideo($data,$id);

			$this->load->library('upload');
			$this->upload->initialize($config);
			$this->upload->do_upload('tvshow_thumbnail');
			$this->upload->display_errors();

			$res=array('status'=>'200','msg'=>'Sucessfully updated','id'=>$id);
			echo json_encode($res);
			return $id;
		}

		/******************************News********************************************/

		public function savenews(){
			$tvshow_title = $_POST['tvshow_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$showtype = "news";

			if (isset($_FILES['tvshow_thumbnail']) && !empty($_FILES['tvshow_thumbnail']['name'])) {
				$config = array(
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);

				$tvshow_thumbnail=$_FILES['tvshow_thumbnail']['name'];

				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->do_upload('tvshow_thumbnail');
				$this->upload->display_errors();
				
			}

			$data = array(
				'tvs_name' => $tvshow_title,
				'tvs_image' => $_FILES['tvshow_thumbnail']['name'],
				'type' => $showtype,
				'fc_id'=> $tvshow_category,
				'tvs_date'=>date('Y-m-d h:i:s'),
			);
			$id=$this->Adminmodel->add_sport($data);

			if($id){
				$res=array('status'=>'200','msg'=>'Sucessfully Added');
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail');
				echo json_encode($res);
			}
		}

		public function newscliplist(){
			
			$where='v_type="news"';
			$where .= " and news_video.id_user = ".$this->session->userdata('gs_id');
			$data['tvshowepisodelist'] = $this->Adminmodel->newsvideo_by_id($where);
			$this->load->view("admin/newscliplist",$data);
		}

		public function addnewsclip(){
			$where = "id_user = ".$this->session->userdata('gs_id');
			$data['categorylist'] = $this->Adminmodel->category_list_where($where);

			$where='type="news"';
			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where);

			$this->load->view("admin/addnewsclip",$data);
		}

		public function savenewsclip(){
			$episode_title = $_POST['episode_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$tvshow_url = $_POST['show_url'];
			$tvshow_desc = $_POST['episode_desc'];
			$mp3_file_name = @$_POST['mp3_file_name'];
			$showtype = "news";
			$tvv_video_type=$_POST['video_type'];

			if(isset($_POST['feature_video'])){
				$feature_video=$_POST['feature_video'];
			}else{
				$feature_video='0';
			}

			if (isset($_FILES['tvshow_thumbnail']) && !empty($_FILES['tvshow_thumbnail'])) {
				$config = array(
					'allowed_types' => '*',
					'upload_path' => FCPATH . 'assets/images/serial',
					'max_size' => '100000',
					'max_width' => '10000',
					'max_height' => '10000'
				);
			}

			// if (isset($_FILES['mp3_local']) && !empty($_FILES['mp3_local']['name'])) {
			// 	$config = array(
			// 		'allowed_types' => '*',
			// 		'upload_path' => FCPATH . 'assets/images/serial',
			// 		'max_size' => '100000',
			// 		'max_width' => '10000',
			// 		'max_height' => '10000'
			// 	);

			// 	$this->load->library('upload');
			// 	$this->upload->initialize($config);
			// 	$this->upload->do_upload('mp3_local');
			// 	$this->upload->display_errors();

			// 	$mp3_file_name =$_FILES['mp3_local']['name'];
			// }else{
			// 	$mp3_file_name =$_POST['mp3_file_name'];
			// }

			if($tvv_video_type=="Server Video"){
				$tvshow_url="";
			}else{
				$mp3_file_name="";
			}
			
			$data = array(
				'tvv_name' => $episode_title,
				'tvv_thumbnail' => $_POST['tvshow_thumbnail'],
				'tvv_video'=>$mp3_file_name,
				'tvv_video_type'=>$tvv_video_type,
				'tvv_video_url'=>$tvshow_url,
				'v_type' => $showtype,
				'fc_id'=> $tvshow_category,
				'tvv_description' => $tvshow_desc,
				'is_premium' => $feature_video,
				'tvv_date'=>date('Y-m-d h:i:s'),
				'id_user'=>$this->session->userdata('gs_id')
			);
			$id=$this->Adminmodel->add_newsvideo($data);

			// $this->load->library('upload');
			// $this->upload->initialize($config);
			// $this->upload->do_upload('tvshow_thumbnail');
			// $this->upload->do_upload('mp3_local');
			// $this->upload->display_errors();

			if($id){	
				$res=array('status'=>'200','msg'=>'Sucessfully Added','$id'=>$id);
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail','$id'=>$id);
				echo json_encode($res);
			}
		}

		public function editnewsclipe(){
			$id=$_GET['id'];
			$episode_title = @$_GET['episode_title'];
			$tvshow_category = @$_GET['tvshow_category'];
			$tvshow_desc = @$_GET['episode_desc'];
			$tvv_video_type=@$_GET['video_type'];
			$tvshow_url = @$_GET['show_url'];
			$showtype = "news";
			if($episode_title != ""){
				$feature_video='0';			
				$tvshow_thumbnail=  $_GET['tvshow_thumbnail'];

				if($tvv_video_type=="Server Video"){
					$tvshow_url="";
				}else{
					$mp3_file_name="";
				}

				$data = array(
					'tvv_name' => $episode_title,
					'tvv_thumbnail' => $tvshow_thumbnail,
					'tvv_video'=>$mp3_file_name,
					'tvv_video_type'=>$tvv_video_type,
					'tvv_video_url'=>$tvshow_url,
					'fc_id'=> $tvshow_category,
					'tvv_description' => $tvshow_desc,
					'is_premium' => $feature_video,
					'tvv_date'=>date('Y-m-d h:i:s')
				);

				// print_r($data);
				
				$ida=$this->Adminmodel->update_newsvideo($data,$id);

				// $this->load->library('upload');
				// $this->upload->initialize($config);
				// $this->upload->do_upload('tvshow_thumbnail');
				// $this->upload->display_errors();
			
				if($ida){
					echo "sukses";
				}
				// 	$res=array('status'=>'200','msg'=>'Sucessfully Added');
				// 	echo json_encode($res);
				// }else{
				// 	$res=array('status'=>'400','msg'=>'fail');
				// 	echo json_encode($res);
				// }
			}

			$where='tvv_id="'.$id.'"';
			
			$data['categorylist'] = $this->Adminmodel->category_list();

			$data['tvshowepisodelist'] = $this->Adminmodel->newsvideo_by_id($where);
			// echo json_encode($data);

			$this->load->view("admin/editnewsclipe",$data);
		}

		public function updatenewsclipe(){
			$id=$_POST['id'];
			$episode_title = $_POST['episode_title'];
			$tvshow_category = $_POST['tvshow_category'];
			$tvshow_desc = $_POST['episode_desc'];
			$tvv_video_type=$_POST['video_type'];
			$tvshow_url = $_POST['show_url'];
			$showtype = "news";

			if(isset($_POST['feature_video'])){
				$feature_video=$_POST['feature_video'];
			}else{
				$feature_video='0';
			}

			if (isset($_FILES['mp3_local']) && !empty($_FILES['mp3_local']['name'])){
				$mp3_file_name =$_FILES['mp3_local']['name'];
			}else{
				$mp3_file_name =$_POST['mp3_file_name'];
			}

		
			$tvshow_thumbnail=  $_POST['tvshow_thumbnail'];

			if($tvv_video_type=="Server Video"){
				$tvshow_url="";
			}else{
				$mp3_file_name="";
			}

			$data = array(
				'tvv_name' => $episode_title,
				'tvv_thumbnail' => $tvshow_thumbnail,
				'tvv_video'=>$mp3_file_name,
				'tvv_video_type'=>$tvv_video_type,
				'tvv_video_url'=>$tvshow_url,
				'fc_id'=> $tvshow_category,
				'tvv_description' => $tvshow_desc,
				'is_premium' => $feature_video,
				'tvv_date'=>date('Y-m-d h:i:s')
			);

			$id=$this->Adminmodel->update_newsvideo($data,$id);

			// $this->load->library('upload');
			// $this->upload->initialize($config);
			// $this->upload->do_upload('tvshow_thumbnail');
			// $this->upload->display_errors();
		
			if($id){
				$res=array('status'=>'200','msg'=>'Sucessfully Added');
				echo json_encode($res);
			}else{
				$res=array('status'=>'400','msg'=>'fail');
				echo json_encode($res);
			}
		}

		public function editnewsshow(){
			$id=$_GET['id'];
			$where='tvs_id="'.$id.'"';

			$data['categorylist'] = $this->Adminmodel->category_list();

			$data['tvshowlist'] = $this->Adminmodel->tvshow_by_id($where);
			// echo json_encode($data);
			$this->load->view("admin/editnewsshow",$data);
		}


/**************************************************************************/


		public function channellist(){

			$where='';
			$id_user = $this->session->userdata('gs_id');			
			$where =" id_user = ".$id_user;


			$data['channellist'] = $this->Adminmodel->channel_by_id($where);
			$this->load->view("admin/channellist",$data);
		}
		public function editchannel(){
			$id=$_GET['id'];

				$channel_title = @$_GET['channel_title'];
				$channel_desc = @$_GET['channel_desc'];
				$channel_url = @$_GET['channel_url'];
			if($channel_title != ""){

			
					$feature_video='0';
				
		
				$channel_thumbnail=  $_GET['channel_thumbnail'];
				$data = array(
					'channel_name' => $channel_title,
					'channel_image' => $channel_thumbnail,
					'channel_desc' => $channel_desc,
					'channel_url'=> $channel_url,
					'is_premium' => $feature_video,
				);
				$this->Adminmodel->update_channel($data,$id);
				//	echo $id;	echo 'test';
				
				echo "sukses";
			}

			$where='id="'.$id.'"';

			$data['channellist'] = $this->Adminmodel->channel_by_id($where);
			$this->load->view("admin/editchannel",$data);
		}

		public function addchannel(){

			$this->load->view("admin/addchannel");
		}

		public function savechannel(){
			$channel_title = $_POST['Channel_title'];
			$channel_desc = $_POST['channel_desc'];
			$channel_url = $_POST['channel_url'];
			$channel_thumbnail = $_POST['channel_thumbnail'];
			$id_user = $this->session->userdata('gs_id');			

			if(isset($_POST['feature_video'])){
				$feature_video=$_POST['feature_video'];
			}else{
				$feature_video='0';
			}

			if (isset($channel_thumbnail)) {
				// $config = array(
				// 	'allowed_types' => 'jpg|jpeg|gif|png',
				// 	'upload_path' => FCPATH . 'assets/images/serial',
				// 	'max_size' => '100000',
				// 	'max_width' => '10000',
				// 	'max_height' => '10000'
				// );

		/* 	$fileinfo = @getimagesize($_FILES["wallpaper_thumbnail"]["tmp_name"]);
   			$width = $fileinfo[0];
    		$height = $fileinfo[1];

    		$filesize = @filesize($_FILES["wallpaper_thumbnail"]["tmp_name"]) ;*/

    		$data = array(
    			'channel_name' => $channel_title,
    			'channel_image' => $channel_thumbnail,
    			'channel_desc' => $channel_desc,
    			'channel_url'=> $channel_url,
    			'is_premium' => $feature_video,
				'status' => 'enable',
				'id_user'=>$id_user
    		);
    		$id=$this->Adminmodel->add_channel($data);
    	}

    	// $this->load->library('upload');
    	// $this->upload->initialize($config);
    	// $this->upload->do_upload('channel_thumbnail');
    	// $this->upload->display_errors();
    	echo $id;

    	return $id;
    }

    public function update_channel(){
    	$channel_title = $_POST['channel_title'];
    	$channel_desc = $_POST['channel_desc'];
    	$channel_url = $_POST['channel_url'];

    	$id = $_POST['id'];

    	if(isset($_POST['feature_video'])){
    		$feature_video=$_POST['feature_video'];
    	}else{
    		$feature_video='0';
    	}

    	if (isset($_FILES['channel_thumbnail']) && !empty($_FILES['channel_thumbnail']['name'])) {
    		$config = array(
    			'allowed_types' => 'jpg|jpeg|gif|png',
    			'upload_path' => FCPATH . 'assets/images/serial',
    			'max_size' => '100000',
    			'max_width' => '10000',
    			'max_height' => '10000'
    		);
    		$channel_thumbnail=$_FILES['channel_thumbnail']['name'];
				// $where='id="'.$id.'"';

    		$this->load->library('upload');
    		$this->upload->initialize($config);
    		$this->upload->do_upload('channel_thumbnail');
    		$this->upload->display_errors();
    	}else{
    		$channel_thumbnail=  $_POST['channel_thumbnailimage'];
    	}
    	$data = array(
    		'channel_name' => $channel_title,
    		'channel_image' => $channel_thumbnail,
    		'channel_desc' => $channel_desc,
    		'channel_url'=> $channel_url,
    		'is_premium' => $feature_video,
    	);
    	$this->Adminmodel->update_channel($data,$id);
		//	echo $id;	echo 'test';
    	$res=array('status'=>'200','msg'=>'Sucessfully updated','id'=>$id);
    	echo json_encode($res);
		//	return $id;
    }


    /*************************************************************************/


    public function addaudio(){
    	$this->load->view("admin/addaudio");
    }

    public function saveaudio(){
    	$channel_title = $_POST['Channel_title'];
    	$channel_desc = $_POST['channel_desc'];
    	$channel_url = $_POST['channel_url'];

    	if (isset($_FILES['channel_thumbnail']) && !empty($_FILES['channel_thumbnail']['name'])) {
    		$config = array(
    			'allowed_types' => '*',
    			'upload_path' => FCPATH . 'assets/images/serial',
    			'max_size' => '100000',
    			'max_width' => '10000',
    			'max_height' => '10000'
    		);

    		$data = array(
    			'audio_name' => $channel_title,
    			'audio_image' => $_FILES['channel_thumbnail']['name'],
    			'audio_desc' => $channel_desc,
    			'audio_url'=> $channel_url,
    			'status' => 'enable'
    		);
    	}

    	$id=$this->Adminmodel->add_audio($data);
    	$this->load->library('upload');
    	$this->upload->initialize($config);
    	$this->upload->do_upload('channel_thumbnail');
    	$this->upload->display_errors();
    	echo $id;

    	return $id;
    }

    public function audiolist(){
    	$where='';
    	$data['channellist'] = $this->Adminmodel->audio_by_id($where);
    	$this->load->view("admin/audiolist",$data);
			// echo json_encode($data);
    }

    public function editaudio(){
    	$id=$_GET['id'];
    	$where='id="'.$id.'"';

    	$data['channellist'] = $this->Adminmodel->audio_by_id($where);
    	$this->load->view("admin/editaudio",$data);
    }

    public function update_audio(){
    	$channel_title = $_POST['channel_title'];
    	$channel_desc = $_POST['channel_desc'];
    	$channel_url = $_POST['channel_url'];

    	$id = $_POST['id'];

    	if (isset($_FILES['channel_thumbnail']) && !empty($_FILES['channel_thumbnail']['name'])) {
    		$config = array(
    			'allowed_types' => '*',
    			'upload_path' => FCPATH . 'assets/images/serial',
    			'max_size' => '100000',
    			'max_width' => '10000',
    			'max_height' => '10000'
    		);
    		$channel_thumbnail=$_FILES['channel_thumbnail']['name'];
				// $where='id="'.$id.'"';

    		$this->load->library('upload');
    		$this->upload->initialize($config);
    		$this->upload->do_upload('channel_thumbnail');
    		$this->upload->display_errors();
    	}else{
    		$channel_thumbnail=  $_POST['channel_thumbnailimage'];
    	}
    	$data = array(
    		'audio_name' => $channel_title,
    		'audio_image' => $channel_thumbnail,
    		'audio_desc' => $channel_desc,
    		'audio_url'=> $channel_url,
    		'status' => 'enable',
    	);

    	$this->Adminmodel->update_audio($data,$id);
		//	echo $id;	echo 'test';
    	$res=array('status'=>'200','msg'=>'Sucessfully updated');
    	echo json_encode($res);
		//	return $id;

    }

    /*************************************************************************/

    public function settingpage(){
    	$data['settinglist'] = $this->Adminmodel->settings_data();
    	$this->load->view("admin/settings",$data);
    }

    public function savesetting(){
    	$app_name=$_POST['app_name'];
    	$app_image_logo=$_FILES['app_image']['name'];
    	$app_desc=$_POST['app_desc'];
    	$host_email=$_POST['host_email'];

    	if (isset($_FILES['app_image']) && !empty($_FILES['app_image']['name'])) {
    		$config = array(
    			'allowed_types' => 'jpg|jpeg|gif|png',
    			'upload_path' => FCPATH . 'assets/images/serial'
    		);
    		$this->load->library('upload');
    		$this->upload->initialize($config);
    		$this->upload->do_upload('app_image');
    		$data3 = array(					 
    			'value' => $app_image_logo,                  
    		);
               // $where3='key=';
    		$this->Adminmodel->update_general_setting($data3,'app_logo');

    	}
    	$data = array(					 
    		'value' => $host_email,                  
    	);
               // $where='key="host_email"';
    	$this->Adminmodel->update_general_setting($data,'host_email');
    	$data1 = array(					 
    		'value' => $app_desc,                  
    	);
                //$where='key="app_desripation"';
    	$this->Adminmodel->update_general_setting($data1,'app_desripation');

    	$data2 = array(					 
    		'value' => $app_name,                  
    	);
               // $where2='key="app_name"';
    	$this->Adminmodel->update_general_setting($data2,'app_name');
    }

    public function save_admob(){
    	$publisher_id=$_POST['publisher_id'];
    	$banner_ad=$_POST['banner_ad'];
    	$banner_ad_id=$_POST['banner_ad_id'];
    	$interstital_ad=$_POST['interstital_ad'];
    	$interstital_adid=$_POST['interstital_adid'];
    	$interstital_adid_click=$_POST['interstital_adid_click'];

    	$data3 = array(					 
    		'value' => $publisher_id,                  
    	);
               // $where3='key=';
    	$this->Adminmodel->update_general_setting($data3,'publisher_id');

    	$data = array(					 
    		'value' => $banner_ad,                  
    	);
               // $where='key="host_email"';
    	$this->Adminmodel->update_general_setting($data,'banner_ad');
    	$data1 = array(					 
    		'value' => $banner_ad_id,                  
    	);
                //$where='key="app_desripation"';
    	$this->Adminmodel->update_general_setting($data1,'banner_adid');
    	$data2 = array(					 
    		'value' => $interstital_ad,                  
    	);
               // $where2='key="app_name"';
    	$this->Adminmodel->update_general_setting($data2,'interstital_ad');
    	$data2 = array(					 
    		'value' => $interstital_adid,                  
    	);
               // $where2='key="app_name"';
    	$this->Adminmodel->update_general_setting($data2,'interstital_adid');

    	$data2 = array(					 
    		'value' => $interstital_adid_click,                  
    	);
               // $where2='key="app_name"';
    	$this->Adminmodel->update_general_setting($data2,'interstital_adid_click');

    }

    public function save_signal_noti(){
    	$one_signal=$_POST['one_signal'];
    	$rest_key=$_POST['rest_key'];

    	$data = array(					 
    		'value' => $one_signal,                  
    	);
               // $where='key="host_email"';
    	$this->Adminmodel->update_general_setting($data,'onesignal_apid');
    	$data1 = array(					 
    		'value' => $rest_key,                  
    	);
                //$where='key="app_desripation"';
    	$this->Adminmodel->update_general_setting($data1,'onesignal_rest_key');

    }

    public function editcategory(){
    	$id=$_GET['id'];

    	$where='c_id="'.$id.'"';
    	$data['category'] = $this->Adminmodel->get_category($where);
    	$this->load->view("admin/editCategory",$data);
    }
    public function updatecategory(){
    	$category_name=$_POST['category_name'];

    	if (isset($_FILES['category_image']) && !empty($_FILES['category_image']['name'])) {
    		$config = array(
    			'allowed_types' => 'jpg|jpeg|gif|png',
    			'upload_path' => FCPATH . 'assets/images/category',
    			'max_size' => '20000',
    			'max_height'=> '10000',
    			'max_width' => '10000'
    		);
    		$this->load->library('upload');
    		$this->upload->initialize($config);
    		$this->upload->do_upload('category_image');
    		echo $this->upload->display_errors();

    		$CatImage=$_FILES['category_image']['name'];	
    	}else{
    		$CatImage=$_POST['categoryimage'];	
    	}
    	$id=$_POST['id'];
    	$data = array(
    		'cat_name' => $category_name,
    		'cat_image' => $CatImage
    	);
    	$cat_id=$this->Adminmodel->update_status_category($id,$data);

    	return $cat_id;
    }

    public function delete_record(){
    	$id=$_POST['id'];
		$tablename=$_POST['tablename'];
    	if($tablename=='channel'){
    		$this->Adminmodel->delete_channel($id);
    	}elseif($tablename=='tv_serial'){
    		$this->Adminmodel->delete_tv_serial($id);
    	}elseif ($tablename=='category') {
    		$this->Adminmodel->delete_category($id);	
    	}elseif ($tablename=='video'){
    		$this->Adminmodel->delete_video($id);
    	}elseif ($tablename=='audio'){
    		$this->Adminmodel->delete_audio($id);
    	}elseif ($tablename=='sub'){
    		$this->Adminmodel->delete_sub($id);
    	}elseif ($tablename=='movie'){
    		$this->Adminmodel->delete_movievideo($id);
    	}elseif ($tablename=='sport'){
    		$this->Adminmodel->delete_sportvideo($id);
    	}elseif ($tablename=='news'){
    		$this->Adminmodel->delete_newsvideo($id);
		}elseif($tablename=='tvshowepisode'){
			$this->Adminmodel->deletetvepisode($id);
		}

    	return true;
    }

    public function notification(){
    	$this->load->view("admin/notification");
    }

    public function savenotification(){
    	

    	$ONESIGNAL_APP_ID=$this->session->userdata('gs_app_id');
		$ONESIGNAL_REST_KEY=$this->session->userdata('gs_app_key');
		
    	$big_picture=$_POST['video_thumbnail'];
    
    	$content = array(
    		"en" => $_POST['message']                                                 
    	);

    	if(isset($big_picture))
    	{
    	
    		$fields = array(
    			'app_id' =>  $ONESIGNAL_APP_ID,
    			'included_segments' => array('All'),                                            
    			'data' => array("foo" => "bar"),
    			'headings'=> array("en" => $_POST['title']),
    			'contents' => $content,
    			'big_picture' =>$big_picture                    
    		);
    	}else
    	{
    		$file_path = '';  
    		$fields = array(
    			'app_id' => $ONESIGNAL_APP_ID,
    			'included_segments' => array('All'),   
    			'data' => array("foo" => "bar"),
    			'headings'=> array("en" => $_POST['title']),
    			'contents' => $content,
    		);
    	}

    	$fields = json_encode($fields);    

    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
    		'Authorization: Basic '.$ONESIGNAL_REST_KEY));
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    	curl_setopt($ch, CURLOPT_HEADER, FALSE);
    	curl_setopt($ch, CURLOPT_POST, TRUE);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    	$response = curl_exec($ch);

    	curl_close($ch);
    	print_r($response);

    }

    // ==================Subscription===================//

    public function subscription(){
    	$data['subplan'] = $this->Adminmodel->subscription_data();
    	$this->load->view("admin/subscription",$data);
    }

     public function addplan(){
    	$this->load->view("admin/addplan");
    }

     public function saveplan(){
    	$plan_name = $_POST['plan_name'];
    	$plan_price = $_POST['plan_price'];
    	$price_type = $_POST['price_type'];
    	$plan_period = $_POST['plan_period'];
    	$plan_type = $_POST['plan_type'];

    	$data = array(
    		'sub_name' => $plan_name,
    		'sub_price' => $plan_price,
    		'currency_type' => $price_type,
    		'sub_type'=> $plan_type,
    		'sub_time' => $plan_period,
    		'sub_status' => '1',
    	);

    	$id=$this->Adminmodel->add_subscription($data);

    	$res=array('status'=>'200','msg'=>'Sucessfully updated');
    	echo json_encode($res);
    	
    }

    public function editplan(){
    	$id = $_GET['id'];
    	$where='sub_id="'.$id.'"';

    	$data['subplan'] = $this->Adminmodel->subscription_by_id($where);
    	$this->load->view("admin/editplan",$data);
    }

      public function updateplan(){
    	$id = $_POST['id'];
    	$plan_name = $_POST['plan_name'];
    	$plan_price = $_POST['plan_price'];
    	$price_type = $_POST['price_type'];
    	$plan_period = $_POST['plan_period'];
    	$plan_type = $_POST['plan_type'];

    	$data = array(
    		'sub_name' => $plan_name,
    		'sub_price' => $plan_price,
    		'currency_type' => $price_type,
    		'sub_type'=> $plan_type,
    		'sub_time' => $plan_period,
    		'sub_status' => '1',
    	);

    	$id=$this->Adminmodel->update_subscription($id,$data);

    	$res=array('status'=>'200','msg'=>'Sucessfully updated');
    	echo json_encode($res);
    	
    }
}

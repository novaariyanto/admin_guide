<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Apimodel');
		$this->load->helper('url');
		$this->load->helper('form'); 
	}

	public function index(){
		$this->load->view('welcome_message');
	}

	public function general_setting(){
		
		$resultr=$this->Apimodel->genaral_setting();

		if(sizeof($resultr)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$resultr);
		}else{
			$response=array('status'=>400,'message'=>'No Record Found','Result'=>$resultr);
		}
		echo json_encode($response);
	}
	
	public function login(){
		$email=$_REQUEST['email'];
		$password=$_REQUEST['password'];

		$where='password="'.$password.'" AND (fullname="'.$email.'" OR email="'.$email.'")';
		$resultr=$this->Apimodel->login_user($where);

		if(sizeof($resultr)>0){
			$uid= $resultr[0]->id;
			$where_premium='user_id="'.$uid.'" AND status="1" ';
			$result_premium=$this->Apimodel->premium_user($where_premium);

			if(sizeof($result_premium)>0){
				$response=array('status'=>200,'message'=>'Login Success','User_id'=>"".$uid,'is_premium'=>'1');
			}else{
				$response=array('status'=>200,'message'=>'Login Success','User_id'=>"".$uid,'is_premium'=>'0');
			}
		}else{
			$r=array();
			$response=array('status'=>400,'message'=>'Please enter valid Email OR Password','User_id'=>'');
		}
		// $response=array('status'=>200,'result'=>"".$user_id,'message'=>'Login Success');
		echo json_encode($response);
	}

	public function registration(){
		$fullname= $this->input->POST('fullname');
		$email= $this->input->POST('email');
		$password= $this->input->POST('password');
		$mobile_number= $this->input->POST('mobile_number');

		$where='email="'.$email.'"';
		$r = $this->Apimodel->login_user($where); 

		if(sizeof($r)>0){
			$response=array('status'=>400,'message'=>'Email address already exists.','User_id'=>'');
			echo json_encode($response);
		}else{
			$data = array(
				'fullname'=>$fullname,
				'email'=>$email,
				'password'=>$password,
				'mobile_number'=>$mobile_number,
				'c_date'=>date('Y-m-d H:i:s')
			);

			$user_id=$this->Apimodel->registration_api($data);

			$response=array('status'=>200,'message'=>'User registration sucessfuly','User_id'=>(string)$user_id);
			echo json_encode($response);

		}
	}

	public function profile(){
		
		$user_id=$_REQUEST['user_id'];
		$where='id="'.$user_id.'" ';

		$resultr=$this->Apimodel->profile($where);
		unset($resultr[0]->password);
		unset($resultr[0]->c_date);

		if(sizeof($resultr)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$resultr);
		}else{
			$response=array('status'=>400,'message'=>'User data not found','Result'=>$resultr);
		}
		// $response=array('status'=>200,'result'=>"".$user_id,'message'=>'Login Success');
		echo json_encode($response);
	}

	public function bannerlist(){
		
		$c_id=$_REQUEST['type'];
		$where='v_type="'.$c_id.'" ';
		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if($header == 'user_application'){
				 $id_user = $value;

			}
		}
		
		

		if($c_id =='all'){
			$resultr=$this->Apimodel->bannerlist($where);}
		else if($c_id =='tv'){
			$resultr=$this->Apimodel->bannerlist($where);}
		else if($c_id =='movie'){
			if(@$id_user!=""){
				$where .= ' and movie_video.id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->bannerlist_movie($where);
		}
		else if($c_id =='sport'){
			if(@$id_user!=""){
				$where .= ' and sport_video.id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->bannerlist_sport($where);}
		else if($c_id =='news'){
			if(@$id_user!=""){
				$where .= ' and news_video.id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->bannerlist_news($where);
		}
		$rk=array();
		foreach($resultr as $ra){
			if($c_id =='tv'){
				$ra->tvv_thumbnail=$ra->tvv_thumbnail;
				$ra->tvs_image=$ra->tvs_image;
				$rk[]= $ra;  
			}else if($c_id !='tv'){
				$ra->tvv_thumbnail=$ra->tvv_thumbnail;
				$ra->tvs_image=$ra->tvv_thumbnail;
				$rk[]= $ra;  
			}
		}
	

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function categorylist(){
		$resultr=$this->Apimodel->category();

		$rk=array();
		foreach($resultr as $ra){
			$ra->cat_image=base_url().'assets/images/category/'.$ra->cat_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function top_pick_for_you(){

		$type=$_REQUEST['type'];
		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if($header == 'user_application'){
				 $id_user = $value;

			}
		}
		
		
		if($type =='all'){
			// $where='type="'.$type.'" ';
			if(@$id_user!=""){
				$where = ' and tv_video.id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->top_pick_for_you($where);
		}else if($type =='tv'){
			$where='type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->top_pick_for_you_by_cat($where);
		}else if($type =='movie'){
			$where='v_type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->top_pick_for_you_movie($where);
		}else if($type =='sport'){
			$where='v_type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->top_pick_for_you_sport($where);
		}else if($type =='news'){
			$where='v_type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->top_pick_for_you_news($where);
		}

		$rk=array();
		foreach($resultr as $ra){
			if($type =='tv'){
				$ra->tvs_image=$ra->tvs_image;
				$rk[]= $ra;  
			}else{
				$ra->tvs_image=$ra->tvv_thumbnail;
				$rk[]= $ra; 
			}
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function popularshow(){

		$type=$_REQUEST['type'];
		
		$where='type="'.$type.'" ';
		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if($header == 'user_application'){
				 $id_user = $value;

			}
		}

		if($type =='all'){
			$where='type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->popularshow_by_type();
		}else if($type =='tv'){
			$where='type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->popularshow_by_type($where);
		}else if($type =='movie'){
			$where='v_type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->popularshow_by_movie($where);
		}else if($type =='sport'){
			$where='v_type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->popularshow_by_sport($where);
		}else if($type =='news'){
			$where='v_type="'.$type.'" ';
			if(@$id_user!=""){
				$where .= ' and id_user = '.$id_user;
			}
			$resultr=$this->Apimodel->popularshow_by_news($where);
		}

		$rk=array();
		foreach($resultr as $ra){
			if($type =='tv'){
				$ra->tvs_image= $ra->tvs_image;
				$rk[]= $ra;  
			}else{
				$ra->tvs_image= $ra->tvv_thumbnail;
				$rk[]= $ra; 
			}
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function new_on_gotstar(){

		// $c_id=$_REQUEST['cat_id'];
		// $where='c_id="'.$c_id.'" ';

		$resultr=$this->Apimodel->newongotstar();

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvs_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function popular_in(){

		$c_id=$_REQUEST['cat_id'];
		$type=$_REQUEST['type'];
		$where='fc_id="'.$c_id.'" ';
		$where1='type="'.$type.'" ';
		$where3 = 'v_type="'.$type.'"';

		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if($header == 'user_application'){
				 $id_user = $value;

			}
		}
		if(@$id_user!=""){
			$where .= ' and id_user = '.$id_user;
			$where1 .= ' and id_user = '.$id_user;
			$where3 .= ' and id_user= '.$id_user;
		}


		if($type =='all')
			$resultr=$this->Apimodel->popular_in($where);
		else if($type =='tv')
			$resultr=$this->Apimodel->popular_in_by_type($where,$where1);
		else if($type =='movie'){
			$where3 .='  AND fc_id="'.$c_id.'" ';
			$resultr=$this->Apimodel->popular_in_by_movie($where3);
		}else if($type =='sport'){
			echo $where3 .=' AND fc_id="'.$c_id.'" ';
			$resultr=$this->Apimodel->popular_in_by_sport($where3);
		}else if($type =='news'){
			$where3 .=' AND fc_id="'.$c_id.'" ';
			$resultr=$this->Apimodel->popular_in_by_news($where3);
		}

		$rk=array();
		foreach($resultr as $ra){
			if($type =='all'){
				$ra->tvs_image=$ra->tvs_image;
				$rk[]= $ra;  
			}else if($type =='tv'){
				$ra->tvs_image=$ra->tvs_image;
				$rk[]= $ra;  
			}else if($type =='movie'){
				$ra->tvv_thumbnail=$ra->tvv_thumbnail;
				$ra->tvs_image=$ra->tvv_thumbnail;
				$rk[]= $ra;  
			}else if($type =='sport'){
				$ra->tvv_thumbnail=$ra->tvv_thumbnail;
				$ra->tvs_image=$ra->tvv_thumbnail;
				$rk[]= $ra;  
			}else if($type =='news'){
				$ra->tvv_thumbnail=$ra->tvv_thumbnail;
				$ra->tvs_image=$ra->tvv_thumbnail;
				$rk[]= $ra;  
			}
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function episode_by_id(){

		$tvs_id=$_REQUEST['ftvs_id'];
		$where='ftvs_id="'.$tvs_id.'" ';

		$resultr=$this->Apimodel->episode_by_id($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvs_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function sport_by_id(){

		$fc_id=$_REQUEST['fc_id'];
		$where='fc_id="'.$fc_id.'" ';

		$resultr=$this->Apimodel->sport_by_id($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvv_thumbnail;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function movie_by_id(){

		$fc_id=$_REQUEST['fc_id'];
		$where='fc_id="'.$fc_id.'" ';

		$resultr=$this->Apimodel->movie_by_id($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvv_thumbnail;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function news_by_id(){

		$fc_id=$_REQUEST['fc_id'];
		$where='fc_id="'.$fc_id.'" ';

		$resultr=$this->Apimodel->news_by_id($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvv_thumbnail;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function popular_epi_by_id(){

		$tvs_id=$_REQUEST['tvs_id'];
		$where='ftvs_id="'.$tvs_id.'" ';

		$resultr=$this->Apimodel->popular_epi_by_id($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=base_url().'assets/images/category/'.$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvs_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function show_by_cat(){

		$c_id=$_REQUEST['cat_id'];
		$where='fc_id="'.$c_id.'" ';

		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if($header == 'user_application'){
				 $id_user = $value;

			}
		}
		if(@$id_user!=""){
			$where .= ' and id_user = '.$id_user;
			
		}

		$resultr=$this->Apimodel->show_by_cat($where);

		$rk=array();
		$resultr_serial=array();
		foreach($resultr as $ra){
			// $ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvs_image;
			$rk[]= $ra; 		

		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function tv_video_by_serial_id(){

		echo $ftvs_id=$_REQUEST['ftvs_id'];
		// $ftvs_id = 158;
	
		$where='ftvs_id="'.$ftvs_id.'" ';

		$resultr=$this->Apimodel->tv_video_by_serial_id($where);

		$rk=array();
		$resultr_serial=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvs_image;
			$rk[]= $ra; 		
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function tv_video_by_serial_id_msn(){

		$ftvs_id=$_REQUEST['tvv_id'];
		$type=$_REQUEST['type'];
		$where='tvv_id="'.$ftvs_id.'" ';

		if($type=="sport")
			$resultr=$this->Apimodel->tv_video_by_serial_id_sport($where);
		else if($type=="movie")
			$resultr=$this->Apimodel->tv_video_by_serial_id_movie($where);
		else if($type=="news")
			$resultr=$this->Apimodel->tv_video_by_serial_id_news($where);

		$rk=array();
		$resultr_serial=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvs_image=$ra->tvv_thumbnail;
			if($ra->tvv_video_type == "Facebook Video"){
				$url_facebook = $ra->tvv_video_url;
				$get_video_facebook = $this->get_video_facebook($url_facebook);
				$ra->tvv_video_url = $get_video_facebook;
			}
			$rk[]= $ra; 		
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function Channellist(){

		
		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if($header == 'user_application'){
				 $id_user = $value;

			}
		}
		if(@$id_user!=""){
			$where = ' id_user = '.$id_user;
		}

		$resultr=$this->Apimodel->channel_where($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->channel_image=$ra->channel_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function PopularChannellist(){
		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if($header == 'user_application'){
				 $id_user = $value;

			}
		}
		if(@$id_user!=""){
			$where = ' id_user = '.$id_user;
		}

		$resultr=$this->Apimodel->popularchannel_where($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->channel_image=$ra->channel_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function AddChannelView(){

		$resultr=$this->Apimodel->view_add_by_user_channel();

		$rk=array();
		foreach($resultr as $ra){
			$ra->channel_image=$ra->channel_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function points_add_by_user(){

		$id=$_REQUEST['id'];

		$where='id="'.$id.'" ';

		$result_total=$this->Apimodel->channelpoints($where);

		if(!empty($result_total)){
			$points= $result_total[0]->channel_view;
			$a=$points+1;

			$resultr=$this->Apimodel->view_add_by_user_channel($where,$a);
		}
		else{
			$a=1;

			$data = array(
				'id'=>$id,
				'channel_view'=>1
			);

			$resultr=$this->Apimodel->view_add_by_user_channel($data);
		}

		if(sizeof($resultr)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$resultr);
		}else{
			$response=array('status'=>400,'message'=>'No Record Found','Result'=>$resultr);
		}
		echo json_encode($response);
	}

	public function get_all_news(){

		$type=$_REQUEST['type'];
		$where='v_type="'.$type.'" ';
		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if($header == 'user_application'){
				 $id_user = $value;
			}
		}
		if(@$id_user!=""){
			$where .= ' and news_video.id_user = '.$id_user;
		}


		$resultr=$this->Apimodel->get_all_news($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function Audiolist(){

		$resultr=$this->Apimodel->audiolist();

		$rk=array();
		foreach($resultr as $ra){
			$ra->audio_image=$ra->audio_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function Popularaudiolist(){

		$resultr=$this->Apimodel->popularaudio();

		$rk=array();
		foreach($resultr as $ra){
			$ra->audio_image=$ra->audio_image;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}

	public function add_download(){

		$user_id=$_REQUEST['user_id'];
		$tv_id=$_REQUEST['tv_id'];
		$a_id=$_REQUEST['a_id'];

		$data = array(
			'user_id'=>$user_id,
			'tv_id'=>$tv_id,
			'a_id'=>$a_id
		);

		$user_id=$this->Apimodel->download_video($data);

		$response=array('status'=>200,'message'=>'Video Download Success');
		echo json_encode($response);
	}

	public function getdownload(){

		$user_id=$_REQUEST['user_id'];
		$where='user_id="'.$user_id.'" ';

		$resultr=$this->Apimodel->get_download($where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
		}

		if(sizeof($resultr)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$resultr);
		}else{
			$response=array('status'=>200,'message'=>'Record not found','Result'=>$resultr);
		}
		echo json_encode($response);

	}

	public function add_watchlist(){

		$user_id=$_REQUEST['user_id'];
		$tv_id=$_REQUEST['tv_id'];
		$a_id=$_REQUEST['a_id'];
		$c_id=$_REQUEST['c_id'];
		$where='user_id="'.$user_id.'" and tv_id="'.$tv_id.'" and a_id="'.$a_id.'" and c_id="'.$c_id.'"';
		$resultr=$this->Apimodel->get_watchlist($where);

		if(sizeof($resultr)>0){
			$response=array('status'=>200,'message'=>'already added to watchlist');
			echo json_encode($response);
		}else{
			$response=array('status'=>400,'message'=>'Record not found','Result'=>$resultr);

			$data = array(
				'user_id'=>$user_id,
				'tv_id'=>$tv_id,
				'a_id'=>$a_id,
				'c_id'=>$c_id,
			);

			$user_id=$this->Apimodel->watch_video($data);

			$response=array('status'=>200,'message'=>'Video added to watchlist Success');
			echo json_encode($response);
		}
	}

	public function getwatchlist(){

		$user_id=$_REQUEST['user_id'];
		$where='user_id="'.$user_id.'" ';

		$resultr=$this->Apimodel->get_watchlist($where);

		$rk=array();
		foreach($resultr as $ra){
			if($ra->tv_id==0 && $ra->c_id==0){
				$ra->tvv_name=$ra->audio_name;
				$ra->tvv_description=$ra->audio_desc;
				$ra->tvv_view = $ra->audio_view;
				$ra->tvv_thumbnail = $ra->audio_image;
				$ra->tvv_video_url = $ra->audio_url;
				$ra->type='audio';
				$ra->tvv_id ='';
				$ra->tvv_video ='';
				$ra->tvv_video_type ='';
				$ra->tvv_download ='';
				$ra->v_type ='';
				$ra->tvv_date ='';
				$ra->ftvs_id ='';
				$ra->tvs_id ='';
				$ra->tvs_name ='';
				$ra->tvs_image ='';
				$ra->tvs_view ='';
				$ra->tvs_date ='';
				$ra->fc_id ='';

			}else if($ra->a_id==0 && $ra->c_id==0){
				$ra->type='video';
			}else{
				$ra->tvv_name=$ra->channel_name;
				$ra->tvv_description=$ra->channel_desc;
				$ra->tvv_view = $ra->channel_view;
				$ra->tvv_thumbnail = $ra->channel_image;
				$ra->tvv_video_url = $ra->channel_url;

				$ra->tvv_id ='';
				$ra->tvv_video ='';
				$ra->tvv_video_type ='';
				$ra->tvv_download ='';
				$ra->v_type ='';
				$ra->tvv_date ='';
				$ra->ftvs_id ='';
				$ra->tvs_id ='';
				$ra->tvs_name ='';
				$ra->tvs_image ='';
				$ra->tvs_view ='';
				$ra->tvs_date ='';
				$ra->fc_id ='';

				$ra->type='channel';
			}
			unset($ra->audio_desc); 
			unset($ra->audio_name);
			unset($ra->audio_image);
			unset($ra->audio_url);
			unset($ra->audio_view);
			unset($ra->status);
			unset($ra->id);

			unset($ra->channel_name);
			unset($ra->channel_desc);
			unset($ra->channel_image);
			unset($ra->channel_url);
			unset($ra->channel_view);
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
		}

		if(sizeof($resultr)>0){

			$response=array('status'=>200,'message'=>'Success','Result'=>$resultr);
		}else{
			$response=array('status'=>400,'message'=>'Record not found','Result'=>$resultr);
		}
		echo json_encode($response);

	}

	public function remove_watchlist(){

		$w_id=$_REQUEST['w_id'];

		$id=$this->Apimodel->delete_watch_item($w_id);

		$response=array('status'=>200,'message'=>'sucessfuly deleted',
			'Result'=>$id);
		echo json_encode($response);
	}

	public function get_subplan(){

		$resultr=$this->Apimodel->sub_plan();

		$response=array('status'=>200,'message'=>'Success',
			'Result'=>$resultr);

		echo json_encode($response);
	}

	public function add_transacation(){

		$user_id=$_REQUEST['user_id'];
		$sub_id=$_REQUEST['sub_id'];
		$where ='sub_id="'.$sub_id.'"';
		$resultr=$this->Apimodel->sub_plan($where);

		$resultr[0]->sub_type;
		if( $resultr[0]->sub_type=='month'){
			$subtime =  $resultr[0]->sub_time.' month';
		}else{
			$subtime = ( $resultr[0]->sub_time*12).' month';
		}


		$data = array(
			'user_id'=>$user_id,
			'sub_id'=>$sub_id,
			'status'=>'1',
			'tran_date'=>date('Y-m-d H:i:s'),
			'due_date'=>date("Y-m-d", strtotime("+ ". $subtime, strtotime(date('Y-m-d H:i:s'))))
		);

		$where='user_id="'.$user_id.'" AND status="1"';
		$resultr=$this->Apimodel->premium_user($where);

		if(sizeof($resultr)>0){
			$subid= $resultr[0]->sub_id;
			if($subid==$sub_id){
				$response=array('status'=>200,'message'=>'You have already buy Premium membership');
			}else{
				$user_id=$this->Apimodel->update_transacation($where,$data);
				$response=array('status'=>200,'message'=>'Premium membership Upgrade');
			}

		}else{
			$user_id=$this->Apimodel->add_transacation($data);
			$response=array('status'=>200,'message'=>'Subscription Success');
		}
		echo json_encode($response);
	}

	public function updateStatus(){
		$where='status="1"';
		$resultr=$this->Apimodel->premium_user($where);

		foreach($resultr as $res){
			$date_now = date("Y-m-d"); 

			if ( $date_now > $res->due_date ) {
				$where ='tran_id="'.$res->tran_id.'"';
				$data = array(
					'status'=>'0',
				);
				$this->Apimodel->update_transacation($where,$data);

			}
		}
		$response=array('status'=>200,'message'=>'Subscription Success');
		echo json_encode($response);
	}

	public function premium_video(){

		$type=$_REQUEST['type'];
		$where='v_type="'.$type.'" AND is_premium=1 ';

		if($type=='tv')
			$resultr=$this->Apimodel->premium_video("tv_video",$where);
		else if($type=='movie')
			$resultr=$this->Apimodel->premium_video("movie_video",$where);
		else if($type=='sport')
			$resultr=$this->Apimodel->premium_video("sport_video",$where);
		else if($type=='news')
			$resultr=$this->Apimodel->premium_video("news_video",$where);

		$rk=array();
		foreach($resultr as $ra){
			$ra->tvv_thumbnail=$ra->tvv_thumbnail;
			$ra->tvv_video=$ra->tvv_video;
			$ra->tvv_video_url=$ra->tvv_video_url;
			$rk[]= $ra;  
		}

		if(sizeof($rk)>0){
			$response=array('status'=>200,'message'=>'Success','Result'=>$rk);
		}else{
			$response=array('status'=>400,'message'=>'category not found','Result'=>$rk);
		}
		echo json_encode($response);
	}
function get_video_facebook($url){

	$msg = [];

		try {
			// $url = $_POST['url'];
			// $url = "https://www.facebook.com/watch/?v=1324811454574455";

			if (empty($url)) {
				throw new Exception('Please provide the URL', 1);
			}

			$context = [
				'http' => [
					'method' => 'GET',
					'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.47 Safari/537.36',
				],
			];
			$context = stream_context_create($context);
			$data = file_get_contents($url, false, $context);

			$msg['success'] = true;

			$msg['id'] = $this->generateId($url);
			$msg['title'] = $this->getTitle($data);
		
		
			if ($hdLink = $this->getHDLink($data)) {
				$msg['links']['hd'] = $hdLink;
			}
			if ($sdLink = $this->getSDLink($data)) {
				$msg['links']['hq'] = $sdLink;
			}
			if($hdLink != ""){
				$link = $hdLink;
			}else{
				if($sdLink != ""){
					$link = $sdLink;
				}else{
					$link = "link video tidak ditemukan";
				}
			}
			$msg['link'] = $link;

			
		} catch (Exception $e) {
			$msg['success'] = false;
			$msg['message'] = $e->getMessage();
		}

		return $link;
	}

function generateId($url)
{
    $id = '';
    if (is_int($url)) {
        $id = $url;
    } elseif (preg_match('#(\d+)/?$#', $url, $matches)) {
        $id = $matches[1];
    }

    return $id;
}

function cleanStr($str)
{
    return html_entity_decode(strip_tags($str), ENT_QUOTES, 'UTF-8');
}

function getSDLink($curl_content)
{
    $regexRateLimit = '/sd_src_no_ratelimit:"([^"]+)"/';
    $regexSrc = '/sd_src:"([^"]+)"/';

    if (preg_match($regexRateLimit, $curl_content, $match)) {
        return $match[1];
    } elseif (preg_match($regexSrc, $curl_content, $match)) {
        return $match[1];
    } else {
        return false;
    }
}

function getHDLink($curl_content)
{
    $regexRateLimit = '/hd_src_no_ratelimit:"([^"]+)"/';
    $regexSrc = '/hd_src:"([^"]+)"/';

    if (preg_match($regexRateLimit, $curl_content, $match)) {
        return $match[1];
    } elseif (preg_match($regexSrc, $curl_content, $match)) {
        return $match[1];
    } else {
        return false;
    }
}

function getTitle($curl_content)
{
    $title = null;
    if (preg_match('/h2 class="uiHeaderTitle"?[^>]+>(.+?)<\/h2>/', $curl_content, $matches)) {
        $title = $matches[1];
    } elseif (preg_match('/title id="pageTitle">(.+?)<\/title>/', $curl_content, $matches)) {
        $title = $matches[1];
    }

    return $this->cleanStr($title);
}

function getDescription($curl_content)
{
    if (preg_match('/span class="hasCaption">(.+?)<\/span>/', $curl_content, $matches)) {
        return $this->cleanStr($matches[1]);
    }

    return false;
}
}

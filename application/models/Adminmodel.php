<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminmodel extends CI_Model{

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function admin_varify($where){
		$this->db->select("*");
		$this->db->from("gs_user");		  
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}

	public function videoall(){
		$this->db->select("*,tv_video.tvv_id");
		$this->db->from("tv_video");	
		    // $this->db->join('category', 'category.c_id = tv_video.category_id');
		$q = $this->db->get();
		return $q->result();
	}

	public function tvshow($where){
		$this->db->select("*");
		$this->db->from("tv_serial");	
		$this->db->where($where);	  
		$q = $this->db->get();
		return $q->result();
	}

	public function tvvideo($where){
		$this->db->select("*");
		$this->db->from("tv_video");	
		$this->db->where($where);	  
		$q = $this->db->get();
		return $q->result();
	}

	public function channellist(){
		$this->db->select("*");
		$this->db->from("channel");	
		$q = $this->db->get();
		return $q->result();
	}

	public function wallpaperall_download(){
		$this->db->select("SUM(downcount) AS downcount");
		$this->db->from("wl_wallpaperlist");	
		    // $this->db->join('wl_category', 'wl_category.id = wl_wallpaperlist.category_id');
		$q = $this->db->get();
		return $q->result();
	}

	public function userlist(){
		$this->db->select("*");
		$this->db->from("gs_user");	
		$q = $this->db->get();
		return $q->result();
	}

	public function earnlist(){
		$this->db->select("*");
		$this->db->from("wl_user");	
		$this->db->join('wl_points', 'wl_points.user_id = wl_user.id');
		$q = $this->db->get();
		return $q->result();
	}

	public function category_list(){
		$this->db->select("*");
		$this->db->from("category");
		$q = $this->db->get();
		return $q->result();
	}
	public function category_list_where($where){
		$this->db->select("*");
		$this->db->from("category");
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}

	public function add_category($data){
		$query = $this->db->insert('category',$data);
		return $this->db->insert_id();	
	}

	public function channel_by_id($where){
		$this->db->select("*");
		$this->db->from("channel");	
		    // $this->db->join('wl_category', 'wl_category.id = wl_wallpaperlist.category_id');
		if($where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}

	public function audio_by_id($where){
		$this->db->select("*");
		$this->db->from("audio");	
		if($where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}

	public function tvvideo_by_id($where){
		$this->db->select("*,tv_serial.tvs_name");
		$this->db->from("tv_video");	
		$this->db->join('tv_serial', 'tv_serial.tvs_id = tv_video.ftvs_id');
		if($where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}
	public function tvshow_by_id($where){
		$this->db->select("*");
		$this->db->from("tv_serial");	
		$this->db->join('category', 'category.c_id = tv_serial.fc_id');
		if($where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}

	public function add_sport($data){
		$query = $this->db->insert('tv_serial',$data);
		return $this->db->insert_id();	
	}

	public function sport_by_id($where){
		$this->db->select("*,category.cat_name as categoryname");
		$this->db->from("tv_serial");	
		$this->db->join('category', 'category.c_id = tv_serial.fc_id');
		if($where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}

	public function add_channel($data){
		$query = $this->db->insert('channel',$data);
		return $this->db->insert_id();	
	}
	public function add_tvshow($data){
		$query = $this->db->insert('tv_serial',$data);
		return $this->db->insert_id();	
	}
	
	public function add_video($data){
		$query = $this->db->insert('tv_video',$data);
		return $this->db->insert_id();	
	}
		
	public function add_tvvideo($data){
		$query = $this->db->insert('tv_video',$data);
		return $this->db->insert_id();	
	}

	/*===================Movie Videos=====================*/

	public function add_movievideo($data){
		$query = $this->db->insert('movie_video',$data);
		return $this->db->insert_id();	
	}

	public function movievideo_by_id($where){
		$this->db->select("*");
		$this->db->from("movie_video");	
		$this->db->join('category', 'category.c_id = movie_video.fc_id');
		if($where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}

	public function update_movievideo($data,$where){
		$this->db->where('tvv_id', $where);
		return $this->db->update('movie_video', $data);
	}

	public function delete_movievideo($id){
		$this->db->delete('movie_video', array('tvv_id' => $id)); 
	}

	/*================Sports==========================*/

	public function add_sportvideo($data){
		$query = $this->db->insert('sport_video',$data);
		return $this->db->insert_id();	
	}

	public function sportvideo_by_id($where){
		$this->db->select("*");
		$this->db->from("sport_video");	
		$this->db->join('category', 'category.c_id = sport_video.fc_id');
		if($where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}

	public function update_sportvideo($data,$where){
		$this->db->where('tvv_id', $where);
		$this->db->update('sport_video', $data);
	}

	public function delete_sportvideo($id){
		$this->db->delete('sport_video', array('tvv_id' => $id)); 
	}

	/*===============End Sports============================*/
	
	// count 
	public function newsvideo_cnt($where){
		$this->db->select("*");
		$this->db->from("news_video");
		
		if(@$where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}
	public function sportvideo_cnt($where){
		$this->db->select("*");
		$this->db->from("sport_video");
		if(@$where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}
	public function movievideo_cnt($where){
		$this->db->select("*");
		$this->db->from("movie_video");
		if(@$where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}
	// end count

	/*===============News==============================*/

	public function newsvideo_by_id($where){
		$this->db->select("*");
		$this->db->from("news_video");	
		$this->db->join('category', 'category.c_id = news_video.fc_id');
		if($where!=''){
			$this->db->where($where);
		}
		$q = $this->db->get();
		return $q->result();
	}

	public function add_newsvideo($data){
		$query = $this->db->insert('news_video',$data);
		return $this->db->insert_id();	
	}

	public function update_newsvideo($data,$where){
		$this->db->where('tvv_id', $where);
		return $this->db->update('news_video', $data);
	}

	public function delete_newsvideo($id){
		$this->db->delete('news_video', array('tvv_id' => $id)); 
	}


	/*================End News===========================*/

	
	public function update_video($data,$where){
		$this->db->where('tvv_id', $where);
		return $this->db->update('tv_video', $data);
    	//echo $this->db->last_query();
	}
	public function update_channel($data,$where){
		$this->db->where('id', $where);
		$this->db->update('channel', $data);
    	//echo $this->db->last_query();
	}
	public function update_tvshow($data,$where){
		$this->db->where('tvs_id', $where);
		$this->db->update('tv_serial', $data);
    	//echo $this->db->last_query();
	}

	public function add_audio($data){
		$query = $this->db->insert('audio',$data);
		return $this->db->insert_id();	
	}

	public function update_audio($data,$where){
		$this->db->where('id', $where);
		$this->db->update('audio', $data);
		echo $this->db->last_query();
	}

	public function settings_data(){
		$this->db->select("*");
		$this->db->from("gs_general_setting");	
		$q = $this->db->get();
		return $q->result();
	}

	public function update_general_setting($data,$where){
	 	//$this->db->where($where);
		$this->db->where('key', $where);
		$this->db->update('gs_general_setting', $data);
		return true;
	}
	public function get_category($where){
		$this->db->select("*");
		$this->db->from("category");
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}
	public function update_status_category($id,$status){
		$this->db->where('c_id', $id);
		$this->db->update('category', $status);
    	//echo $this->db->last_query();
		return true;
	}
	public function delete_category($id){
		$this->db->delete('category', array('c_id' => $id)); 
	}
	public function delete_channel($id){
		$this->db->delete('channel', array('id' => $id)); 
	}
	public function delete_tv_serial($id){
		$this->db->delete('tv_serial', array('tvs_id' => $id)); 
	}
	public function delete_video($id){
		$this->db->delete('movie_video', array('tvv_id' => $id)); 
	}
	public function deletetvepisode($id){
		$this->db->delete('tv_video', array('tvv_id' => $id)); 
	}
	public function delete_audio($id){
		$this->db->delete('audio', array('id' => $id)); 
	}

	public function subscription_data(){
		$this->db->select("*");
		$this->db->from("sub_plan");	
		$q = $this->db->get();
		return $q->result();
	}

	public function add_subscription($data){
		$query = $this->db->insert('sub_plan',$data);
		return $this->db->insert_id();	
	}

	public function subscription_by_id($where){
		$this->db->select("*");
		$this->db->from("sub_plan");
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();	
	}

	public function update_subscription($where,$data){
		$this->db->where('sub_id', $where);
		$this->db->update('sub_plan', $data);
	}

	public function delete_sub($id){
		$this->db->delete('sub_plan', array('sub_id' => $id)); 
	}
}
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class apimodel extends CI_Model{

	public function __construct() {
		$this->load->database();
	}

	public function login_user($where){
		$this->db->select("*");
		$this->db->from("gs_user");		  
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}

	

	public function genaral_setting(){
		$this->db->select("*");
		$this->db->from("gs_general_setting");
		$q = $this->db->get();
		return $q->result_array();
	}
	public function registration_api($data){
		$query = $this->db->insert('gs_user',$data);
		return $this->db->insert_id();
	}

	public function profile($where){
		$this->db->select("*");
		$this->db->from("gs_user");		  
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}

	
	public function bannerlist($where){
		$this->db->select("*");
		$this->db->from("tv_video");
		$this->db->where($where);
		$this->db->join('tv_serial', 'tv_video.ftvs_id = tv_serial.tvs_id');
		$this->db->join('category', 'tv_serial.fc_id = category.c_id');
		$this->db->order_by("tvv_view","DESC");  
		$this->db->order_by("tvv_date","DESC");  
		$this->db->limit(5); 		  
		$q = $this->db->get();
		return $q->result();
	}

	public function bannerlist_movie($where){
		$this->db->select("*");
		$this->db->from("movie_video");
		$this->db->where($where);
		$this->db->join('category', 'category.c_id = movie_video.fc_id');
		$this->db->order_by("tvv_view","DESC");  
		$this->db->order_by("tvv_date","DESC");  
		$this->db->limit(5); 		  
		$q = $this->db->get();
		return $q->result();
	}

	public function bannerlist_sport($where){
		$this->db->select("*");
		$this->db->from("sport_video");
		$this->db->where($where);
		$this->db->join('category', 'sport_video.fc_id = category.c_id');
		$this->db->order_by("tvv_view","DESC");  
		$this->db->order_by("tvv_date","DESC");  
		$this->db->limit(5); 		  
		$q = $this->db->get();
		return $q->result();
	}

	public function bannerlist_news($where){
		$this->db->select("*");
		$this->db->from("news_video");
		$this->db->where($where);
		$this->db->join('category', 'news_video.fc_id = category.c_id');
		$this->db->order_by("tvv_view","DESC");  
		$this->db->order_by("tvv_date","DESC");  
		$this->db->limit(5); 		  
		$q = $this->db->get();
		return $q->result();
	}

	public function bannerlist_by_cat($where){
		$this->db->select("*");
		$this->db->from("tv_video");
		$this->db->where($where);
		$this->db->join('tv_serial', 'tv_video.ftvs_id = tv_serial.tvs_id');
		$this->db->join('category', 'tv_serial.fc_id = category.c_id');
		$this->db->order_by("tvv_view","DESC");  
		$this->db->order_by("tvv_date","DESC");  
		$this->db->limit(5); 		  
		$q = $this->db->get();
		return $q->result();
	}

	public function category(){
		$this->db->select("*");
		$this->db->from("category");		  
		$q = $this->db->get();
		return $q->result();
	}

	public function channel(){
		$this->db->select("*");
		$this->db->from("channel");		  
		$q = $this->db->get();
		return $q->result();
	}
	public function channel_where($where){
		$this->db->select("*");
		$this->db->from("channel");		 
		$this->db->where($where); 
		$q = $this->db->get();
		return $q->result();
	}

	public function popularchannel(){
		$this->db->select("*");
		$this->db->from("channel");	
		$this->db->order_by("channel_view","DESC");	  
		$q = $this->db->get();
		return $q->result();
	}
	public function popularchannel_where($where){
		$this->db->select("*");
		$this->db->from("channel");	
		$this->db->where($where);
		$this->db->order_by("channel_view","DESC");	  
		$q = $this->db->get();
		return $q->result();
	}

	// public function top_pick_for_you(){
	// 		$this->db->select("*");
	// 	    $this->db->from("tv_video");
	// 	    $this->db->join('tv_serial', 'tv_video.ftvs_id = tv_serial.tvs_id');
	// 	    $this->db->join('category', 'tv_serial.fc_id = category.c_id');
	// 	    $this->db->order_by("tvv_view","DESC");  
	// 	    $q = $this->db->get();
	// 	    return $q->result();
	// }

	public function top_pick_for_you($where){
	
		$this->db->select("*");
		$this->db->from("tv_serial");
		if(@$where != ""){
			$this->db->where($where);	
		}
		$this->db->order_by("tvs_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function top_pick_for_you_by_cat($where){
		$this->db->select("*");
		$this->db->from("tv_serial");
		$this->db->where($where);
		$this->db->order_by("tvs_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function top_pick_for_you_movie($where){
		$this->db->select("*");
		$this->db->from("movie_video");
		$this->db->where($where);
		$this->db->order_by("tvv_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function top_pick_for_you_sport($where){
		$this->db->select("*");
		$this->db->from("sport_video");
		$this->db->where($where);
		$this->db->order_by("tvv_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function top_pick_for_you_news($where){
		$this->db->select("*");
		$this->db->from("news_video");
		$this->db->where($where);
		$this->db->order_by("tvv_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function popularshow(){
		$this->db->select("*");
		$this->db->from("tv_serial");
		$this->db->order_by("tvs_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}
	

	public function popularshow_by_type($where){
		$this->db->select("*");
		$this->db->from("tv_serial");
		$this->db->where($where);
		$this->db->order_by("tvs_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function popularshow_by_movie($where){
		$this->db->select("*");
		$this->db->from("movie_video");
		$this->db->where($where);
		$this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function popularshow_by_sport($where){
		$this->db->select("*");
		$this->db->from("sport_video");
		$this->db->where($where);
		$this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function popularshow_by_news($where){
		$this->db->select("*");
		$this->db->from("news_video");
		$this->db->where($where);
		$this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function newongotstar(){
		$this->db->select("*");
		$this->db->from("tv_video");
		$this->db->join('tv_serial', 'tv_video.ftvs_id = tv_serial.tvs_id');
		$this->db->join('category', 'tv_serial.fc_id = category.c_id');
		$this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function popular_in($where){
		$this->db->select("*");
		$this->db->from("tv_serial");
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}

	public function popular_in_by_type($where,$where1){
		$this->db->select("*");
		$this->db->from("tv_serial");
		$this->db->where($where);
		$this->db->where($where1);
		$q = $this->db->get();
		return $q->result();
	}

	public function popular_in_by_movie($where){
		$this->db->select("*");
		$this->db->from("movie_video");
		$this->db->where($where);
		$this->db->order_by("tvv_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function popular_in_by_sport($where1){
		$this->db->select("*");
		$this->db->from("sport_video");
		$this->db->where($where1);
		$this->db->order_by("tvv_view","ASC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function popular_in_by_news($where1){
		$this->db->select("*");
		$this->db->from("news_video");
		$this->db->where($where1);
		$this->db->order_by("tvv_view","ASC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function episode_by_id($where){
		$this->db->select("*");
		$this->db->from("tv_video");
		$this->db->where($where);
		$this->db->join('tv_serial', 'tv_video.ftvs_id = tv_serial.tvs_id');
		$this->db->join('category', 'tv_serial.fc_id = category.c_id');
		$this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function sport_by_id($where){
		$this->db->select("*");
		$this->db->from("sport_video");
		$this->db->where($where);
		$this->db->join('category', 'sport_video.fc_id = category.c_id');
		$this->db->order_by("tvv_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function movie_by_id($where){
		$this->db->select("*");
		$this->db->from("movie_video");
		$this->db->where($where);
		$this->db->join('category', 'movie_video.fc_id = category.c_id');
		$this->db->order_by("tvv_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function news_by_id($where){
		$this->db->select("*");
		$this->db->from("news_video");
		$this->db->where($where);
		$this->db->join('category', 'news_video.fc_id = category.c_id');
		$this->db->order_by("tvv_view","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function popular_epi_by_id($where){
		$this->db->select("*");
		$this->db->from("tv_video");
		$this->db->where($where);
		$this->db->join('tv_serial', 'tv_video.ftvs_id = tv_serial.tvs_id');
		$this->db->join('category', 'tv_serial.fc_id = category.c_id');
		$this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function show_by_cat($where){
		$this->db->select("*");
		$this->db->from("tv_serial");
		$this->db->where($where);
		    // $this->db->join('category', 'tv_serial.fc_id = category.c_id');
		    // $this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function tv_video_by_serial_id($where){
		$this->db->select("*");
		$this->db->from("tv_video");
		$this->db->where($where);
		$this->db->join('tv_serial', 'tv_video.ftvs_id = tv_serial.tvs_id');
		$this->db->join('category', 'tv_serial.fc_id = category.c_id');
		    // $this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function tv_video_by_serial_id_sport($where){
		$this->db->select("*");
		$this->db->from("sport_video");
		$this->db->where($where);
		$this->db->join('category', 'sport_video.fc_id = category.c_id');
		$q = $this->db->get();
		return $q->result();
	}

	public function tv_video_by_serial_id_movie($where){
		$this->db->select("*");
		$this->db->from("movie_video");
		$this->db->where($where);
		$this->db->join('category', 'movie_video.fc_id = category.c_id');
		$q = $this->db->get();
		return $q->result();
	}

	public function tv_video_by_serial_id_news($where){
		$this->db->select("*");
		$this->db->from("news_video");
		$this->db->where($where);
		$this->db->join('category', 'news_video.fc_id = category.c_id');
		$q = $this->db->get();
		return $q->result();
	}

	public function view_add_by_user_channel($where,$add_point){

		$this->db->set('channel_view', $add_point, FALSE);
		$this->db->where($where);
		$this->db->update('channel');
			// $q = $this->db->get();
		    // return $q->result();
		return true;
	}

	public function channelpoints($where){
		$this->db->select("*");
		$this->db->from("channel");	
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}

	public function get_all_news($where){
		$this->db->select("*");
		$this->db->from("news_video");
		$this->db->where($where);
		$this->db->join('category', 'news_video.fc_id = category.c_id');
		$this->db->order_by("tvv_date","DESC");  
		$q = $this->db->get();
		return $q->result();
	}

	public function audiolist(){
		$this->db->select("*");
		$this->db->from("audio");		  
		$this->db->order_by("audio_view","DESC");	  
		$q = $this->db->get();
		return $q->result();
	}

	public function popularaudio(){
		$this->db->select("*");
		$this->db->from("audio");	
		$this->db->order_by("audio_view","DESC");	  
		$q = $this->db->get();
		return $q->result();
	}

	public function download_video($data){
		$query = $this->db->insert('download',$data);
		return $this->db->insert_id();
	}

	public function get_download($where){
		$this->db->select("*");
		$this->db->from("download");
		$this->db->where($where);
		$this->db->join('tv_video', 'tv_video.tvv_id = download.tv_id');
		$this->db->join('tv_serial', 'tv_serial.tvs_id = tv_video.ftvs_id');
		$q = $this->db->get();
		return $q->result();
	}

	public function delete_download_item($id){
		$this->db-> where('d_id', $id);
		$this->db-> delete('download');
	}

	public function watch_video($data){
		$query = $this->db->insert('watchlist',$data);
		return $this->db->insert_id();
	}

	public function get_watchlist($where){
		$this->db->select("*");
		$this->db->from("watchlist");
		$this->db->where($where);
		$this->db->join('tv_video', 'tv_video.tvv_id = watchlist.tv_id','left');
		$this->db->join('audio', 'audio.id = watchlist.a_id','left');
		$this->db->join('channel', 'channel.id = watchlist.c_id','left');
		$this->db->join('tv_serial', 'tv_serial.tvs_id = tv_video.ftvs_id','left');
		$q = $this->db->get();
		return $q->result();
	}

	public function delete_watch_item($id){
		$this->db-> where('w_id', $id);
		$this->db-> delete('watchlist');
	}

	public function sub_plan($where=''){
		$this->db->select("*");
		$this->db->from("sub_plan");		  
		if($where!=''){
		$this->db->where($where);
		}
		$q = $this->db->get();
		
		return $q->result();
	}

	public function add_transacation($data){
		$query = $this->db->insert('transaction',$data);
		return $this->db->insert_id();
	}

	public function update_transacation($where,$data){
		$this->db->where($where);
		$this->db->update('transaction',$data);
		return true;
	}

	public function premium_user($where){
		$this->db->select("*");
		$this->db->from("transaction");		  
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}

	public function premium_video($table,$where){
		$this->db->select("*");
		$this->db->from($table);		  
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result();
	}
}

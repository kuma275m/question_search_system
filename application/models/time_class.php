<?php

class Time_class extends CI_Model {
	
	public function time_trans($time) 
	{
		$now_time = strtotime(date("Y-m-d H:i:s", time()+2*60*60));
		$show_time = strtotime($time);
		$dur = $now_time-$show_time;
		if($dur < 60){
			return $dur.' seconds before';
		}
		else if($dur < 3600){
			return floor($dur/60).' minutes before';
		}
		else if($dur < 86400){
			return floor($dur/3600).' hours before';
		}
		else if($dur < 259200){//3 days
			return floor($dur/86400).' days before';
		}
		else {
      		return $time;
		}

	} 
}

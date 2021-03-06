<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016-12-10
 * Time: 12:06
 */
if(!function_exists('load_routes')) {

	function load_routes($dir)
	{
		foreach (glob($dir . '/*') as $filename) {
			if (is_dir($filename)) {
				load_routes($filename);
			} elseif (is_file($filename)) {
				require $filename;
			}
		}
	}

}

if(!function_exists('snake_case2')){

	function snake_case2($str){
		return snake_case($str, '-');
	}
}

function time_tran($the_time) {
    $now_time = date("Y-m-d H:i:s", time());
    //echo $now_time;
    $now_time = strtotime($now_time);
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    if ($dur < 259200) {//3天内
                        return floor($dur / 86400) . '天前';
                    } else {
                        return '3天前';
                    }
                }
            }
        }
    }
}

function time_diff($time){
//    $year   = floor($time / 60 / 60 / 24 / 365);
//    $time  -= $year * 60 * 60 * 24 * 365;
//    $month  = floor($time / 60 / 60 / 24 / 30);
//    $time  -= $month * 60 * 60 * 24 * 30;
//    $week   = floor($time / 60 / 60 / 24 / 7);
//    $time  -= $week * 60 * 60 * 24 * 7;
//    $day    = floor($time / 60 / 60 / 24);
//    $time  -= $day * 60 * 60 * 24;
    $hour   = floor($time / 60 / 60);
    $time  -= $hour * 60 * 60;
    $minute = floor($time / 60);
    $time  -= $minute * 60;

    return $hour.'小时'.$minute.'分'.$time.'秒';
}
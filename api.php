<?php
/**
* api
* @author zhusaidong [zhusaidong@gmail.com]
* @version 0.3.0.0
*/
date_default_timezone_set('Asia/Shanghai');

require("config.php");
require("function.php");
require('lib/Calendar.php');
require('lib/YearHoliday.php');
require('./vendor/autoload.php');

!isset($_GET['date']) and error(-1,'输入日期');

$dates = $_GET['date'];
$dates == "" and $dates = date('Y-m-d',time());

$calendar  = new Calendar();
$lunar = new \ChineseLunar\Lunar();
$yearHoliday = new YearHoliday();

$return = [];
foreach(explode(',',$dates) as $key => $date)
{
	//不正确的日期格式
	if(($timestamp = strtotime($date)) === FALSE)
	{
		error(-2,'不正确的日期格式:'.$date);
	}
	
	$date    = date('Y-m-d',$timestamp);
	
	//返回的格式
	$return[$key]['date'] = $date;
	//工作日
	$return[$key]['code'] = 0;
	$return[$key]['info'] = '工作日';
	$return[$key]['name'] = '周一至周五';
	
	$holidays = $yearHoliday->get(date('Y',$timestamp));
	foreach($holidays as $holiday)
	{
		if($holiday['time'] == $timestamp)
		{
			$return[$key]['code'] = 1;
			$return[$key]['info'] = '节假日';
			$return[$key]['name'] = $holiday['name'];
			break;
		}
	}
	//不是节假日,则判断是否为非工作日(周六周日)
	if($return[$key]['code'] == 0)
	{
		//星期
		$w = date('w',$timestamp);
		if($w == 0 || $w == 6)
		{
			//双休日
			$return[$key]['code'] = 2;
			$return[$key]['info'] = '双休日';
			$return[$key]['name'] = '周六周日';
		}
	}
}
output($return);

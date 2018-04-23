<?php
/**
* TODO 节假日重叠问题
* 
* @author zhusaidong [zhusaidong@gmail.com]
* @version 0.3.0.0
*/
date_default_timezone_set('Asia/Shanghai');

require_once('lib/Calendar.php');
require_once('lib/Lunar.php');
require_once("config.php");
require_once("function.php");

!isset($_GET['date']) and error(-1,'输入日期');

$dates = $_GET['date'];
$dates == "" and $dates = date('Y-m-d',time());

$lunar  = new Lunar();
$calendar  = new Calendar();

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
	$return[$key]['describe'] = ['name'=>'周一至周五'];
	//判断是否为阳历节假日
	foreach($gregorian_calendar as $gregorian_calendar_list)
	{
		//time
		$time = strtotime(date('Y',$timestamp).'-'.$gregorian_calendar_list["time"]);
		//start end
		$start= $time;
		$end  = $time + $gregorian_calendar_list["days"] * 86400 - 1;
		//判断
		if($timestamp >= $start && $timestamp <= $end)
		{
			//节假日
			if($gregorian_calendar_list["days"] > 0)
			{
				$return[$key]['code'] = 1;
				$return[$key]['info'] = '节假日';
			}
			$return[$key]['describe'] = $gregorian_calendar_list;
			break;
		}
	}
	//判断是否为特殊节假日
	foreach($special_gregorian_calendar as $special_gregorian_calendar_list)
	{
		//time
		$time = $special_gregorian_calendar_list["time"];
		preg_match('/^(.*)月(.*)星期(.*)$/iUs',$time,$match);
		if(!isset($match[2]))
		{
			break;
		}
		$_day = $match[2];
		$_day == "最后一个" and $_day = 7;
		
		do
		{
			if($_day <= 0)
			{
				break 2;
			}
			$gdwnm = $calendar->getDateByWeekOfMonth($timestamp,$_day,$calendar->getWeekChinese2Number($match[3]));
			$_day--;
		}while(date('m',$gdwnm) == date('m',$timestamp));
		
		$time = $gdwnm;
		//start end
		$start= $time;
		$end  = $time + $special_gregorian_calendar_list["days"] * 86400 - 1;
		//判断
		if($timestamp >= $start && $timestamp <= $end)
		{
			//节假日
			if($special_gregorian_calendar_list["days"] > 0)
			{
				$return[$key]['code'] = 1;
				$return[$key]['info'] = '节假日';
			}
			$return[$key]['describe'] = $special_gregorian_calendar_list;
			break;
		}
	}
	//判断是否为阴历节假日
	foreach($lunar_calendar as $lunar_calendar_list)
	{
		//time
		$time = $lunar_calendar_list["time"];
		$time = explode('月',$time);
		//农历转数字
		$year = date('Y',$timestamp);
		$lunar_calendar_list["name"] == '除夕' and $year--;//除夕是上一年的阴历日期
		$time = $lunar->convertLunarToSolar($year,$calendar->getLunarMonth2Number($time[0]),$calendar->getLunarDay2Number($time[1]));
		$time = strtotime(implode('-',$time));
		//start end
		$start= $time;
		$end  = $time + $lunar_calendar_list["days"] * 86400 - 1;
		//判断
		if($timestamp >= $start && $timestamp <= $end)
		{
			//节假日
			if($lunar_calendar_list["days"] > 0)
			{
				$return[$key]['code'] = 1;
				$return[$key]['info'] = '节假日';
			}
			if(isset($return[$key]['describe']['time']))
			{
				$_describe = []; 
				$_describe[] = $return[$key]['describe'];
				$_describe[] = $lunar_calendar_list;
				$return[$key]['describe'] = $_describe;
			}
			else
			{
				$return[$key]['describe'] = $lunar_calendar_list;
			}
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
			$return[$key]['describe'] = ['name'=>'周六周日'];
		}
	}
}
output($return);

<?php
/**
* TODO 节假日重叠问题
* 
* @author zhusaidong [zhusaidong@gmail.com]
* @version 0.3.0.0
*/
date_default_timezone_set('Asia/Shanghai');

require_once('lib/Calendar.php');
require_once("config.php");
require_once("function.php");
require('./vendor/autoload.php');

!isset($_GET['date']) and error(-1,'输入日期');

$dates = $_GET['date'];
$dates == "" and $dates = date('Y-m-d',time());

$calendar  = new Calendar();
$lunar = new \ChineseLunar\Lunar();

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
		preg_match('/^(.*)月(.*)星期(.*)$/iUs',$special_gregorian_calendar_list["time"],$match);
		if(!isset($match[2]))
		{
			break;
		}
		if(strpos($match[2],'最后一个') !== FALSE)
		{
			$_day_number = 'last';
		}
		else
		{
			$_day_number = $calendar->getChineseNumber2Number(str_replace(['第','个'],'',$match[2]));
		}
		$_week = $calendar->weeks[$calendar->getWeekChinese2Number($match[3])];
		
		$time = strtotime($_day_number.' '.$_week,mktime(0,0,0,$match[1],1,date('Y',$timestamp)));
		
		//start end
		$start= $time;
		$end  = $time + ($special_gregorian_calendar_list["days"] + 1) * 86400 - 1;
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
		$time = $lunar->toSolarDate($year,$time[0].'月',$time[1]);
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
	
	//节气节日
	foreach($solarterms_calendar as $solarterms)
	{
		$time = $solarterms["time"];
		$year = date('Y',$timestamp);
		$time = $lunar->getSolarTerms($year,$time);
		$time = strtotime($time);
		//start end
		$start= $time;
		$end  = $time + $solarterms["days"] * 86400 - 1;
		//判断
		if($timestamp >= $start && $timestamp <= $end)
		{
			//节假日
			if($solarterms["days"] > 0)
			{
				$return[$key]['code'] = 1;
				$return[$key]['info'] = '节假日';
			}
			if(isset($return[$key]['describe']['time']))
			{
				$_describe = []; 
				$_describe[] = $return[$key]['describe'];
				$_describe[] = $solarterms;
				$return[$key]['describe'] = $_describe;
			}
			else
			{
				$return[$key]['describe'] = $solarterms;
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
			!isset($return[$key]['describe']) and $return[$key]['describe'] = ['name'=>'周六周日'];
		}
		else
		{
			!isset($return[$key]['describe']) and $return[$key]['describe'] = ['name'=>'周一至周五'];
		}
	}
}
output($return);

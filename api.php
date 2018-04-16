<?php
/**
* 加入节假日时间段,节假日不放假
* 	1.节假日当天前后几天能放假的都算节假日
* 		如:10.1国庆节,但是放假7天,所以10.1-10.7都算节假日
* 	2.有些节假日不放假,算工作日
* 		如:2.2世界湿地日,但是不放假,所以算工作日
* 修正返回格式
* 节假日配置
* 
* @author Zsdroid [635925926@qq.com]
* @package com.zsdroid
* @since
* @access public
* @version 0.1.0.0
*/
date_default_timezone_set('Asia/Shanghai');
require_once("./config.php");
require_once("./function.php");
require_once("./Lunar.class.php");

!isset($_GET['date']) and exit(json_encode([
	'code'=>-1,
	'info'=>'输入日期',
	'describe'=>[],
],JSON_UNESCAPED_UNICODE));

$dates = $_GET['date'];
$dates == "" and $dates = date('Y-m-d',time());

$lunar  = new Lunar();

$return = [];
foreach(explode(',',$dates) as $key => $date)
{
	$oldDate = $date;
	$date    = date('Y-m-d',strtotime($date));
	//返回的格式
	$return[$key]['date'] = $date;
	//工作日
	$return[$key]['code'] = 0;
	$return[$key]['info'] = '工作日';
	$return[$key]['describe'] = ['Name'=>'周一至周五'];
	//判断是否为阳历节假日
	foreach($GregorianCalendarHoliday as $GregorianCalendarHolidayList)
	{
		//time
		$time = $GregorianCalendarHolidayList["Time"];
		$time = date('Y-',strtotime($oldDate)).str_replace(array('月','日'),array('-',''),$time);
		$time = strtotime($time);
		//start end
		$start= $time - abs($GregorianCalendarHolidayList["Start"]) * 86400;
		$end  = $time + abs($GregorianCalendarHolidayList["End"]) * 86400;
		//判断
		if(strtotime($date) >= $start && strtotime($date) <= $end)
		{
			//节假日
			if($GregorianCalendarHolidayList["IsNotWork"])
			{
				$return[$key]['code'] = 1;
				$return[$key]['info'] = '节假日';
			}
			$return[$key]['describe'] = $GregorianCalendarHolidayList;
			break;
		}
	}
	//判断是否为特殊节假日
	foreach($SpecialHoliday as $SpecialHolidaylist)
	{
		//time
		$time = $SpecialHolidaylist["Time"];
		preg_match('/^(.*)月(.*)星期(.*)$/iUs',$time,$match);
		if(!isset($match[2]))
		{
			break;
		}
		if($match[2] == "最后一个")
		{
			$match[2] = 7;
		}
		$gdwnm = GetDateByWeekNumberOfMonth(strtotime($oldDate),$match[2],WeekChinese2Number($match[3]));
		if(date('m',$gdwnm) != date('m',strtotime($date)))
		{
			$match[2] = 6;
			$gdwnm = GetDateByWeekNumberOfMonth(strtotime($oldDate),$match[2],WeekChinese2Number($match[3]));
		}
		$time = $gdwnm;
		//start end
		$start= $time - abs($SpecialHolidaylist["Start"]) * 86400;
		$end  = $time + abs($SpecialHolidaylist["End"]) * 86400;
		//判断
		if(strtotime($date) >= $start && strtotime($date) <= $end)
		{
			//节假日
			if($SpecialHolidaylist["IsNotWork"])
			{
				$return[$key]['code'] = 1;
				$return[$key]['info'] = '节假日';
			}
			$return[$key]['describe'] = $SpecialHolidaylist;
			break;
		}
	}
	//判断是否为阴历节假日
	foreach($LunarCalendarHoliday as $LunarCalendarHolidayList)
	{
		//time
		$time = $LunarCalendarHolidayList["Time"];
		$time = explode('月',$time);
		//农历转数字
		$y    = date('Y',strtotime($date));
		$LunarCalendarHolidayList["Name"] == '除夕' and $y--;//除夕是上一年的阴历日期
		$time = $lunar->convertLunarToSolar($y,LMonName($time[0]),LDayName($time[1]));
		$time = strtotime(implode('-',$time));
		//start end
		$start= $time - abs($LunarCalendarHolidayList["Start"]) * 86400;
		$end  = $time + abs($LunarCalendarHolidayList["End"]) * 86400;
		//判断
		if(strtotime($date) >= $start && strtotime($date) <= $end)
		{
			//节假日
			if($LunarCalendarHolidayList["IsNotWork"])
			{
				$return[$key]['code'] = 1;
				$return[$key]['info'] = '节假日';
			}
			$return[$key]['describe'] = $LunarCalendarHolidayList;
			break;
		}
	}
	//不是节假日,则判断是否为非工作日(周六周日)
	if($return[$key]['code'] == 0)
	{
		//星期
		$w = date('w',strtotime($date));
		if($w == 0 || $w == 6)
		{
			//双休日
			$return[$key]['code'] = 2;
			$return[$key]['info'] = '双休日';
			$return[$key]['describe'] = ['Name'=>'周六周日'];
		}
	}
}
echo json_encode($return,JSON_UNESCAPED_UNICODE);

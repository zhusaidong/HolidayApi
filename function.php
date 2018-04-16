<?php
/**
* 
* @author Zsdroid [635925926@qq.com]
* @package com.zsdroid
* @since 
* @access public
* @version 0.1.0.0
*/
/**
* 本月第几天
* @param int $timestamp 时间戳
* 
* @return int 第几天
*/
function weekNumber($timestamp = 0)
{
	$timestamp == 0 and $timestamp = time();
	return date("z", $timestamp) - date("z", strtotime(date("Y-m-01", $timestamp))) + 1;
}
/**
* 获取本月第m个星期n
* @param int $time
* @param int $day
* @param int $week
* 
* @return int 时间戳
*/
function GetDateByWeekNumberOfMonth($time,$day,$week)
{
	$time = strtotime(date('Y-m-01',$time));
	return $time + 86400 * ($week - date('w',$time)) + 86400 * (7 * ($day - 1));
}
/**
* 获取时间在本月的第m个星期n
* @param int 时间戳
* 
* @return array number=>第m个 week=>星期n
*/
function GetWeekNumberByDate($time = 0)
{
	$time == 0 and $time = time();
	
	$return = [];
	$day = date('d',$time) - 1;
	$return['week'] = (date('w',strtotime(date('Y-m-01',$time))) + $day % 7) % 7;
	$return['number'] = floor($day / 7) + 1;
	$return['chineseNumber'] = '第'.Number2ChineseNumber($return['number']).'个';
	if($day + 1 + 7 >= date('t',$time))
	{
		$return['lastWeek'] = 1;
	}
	return $return;
}
function Number2ChineseNumber($number = -1)
{
	($number == -1 || $number > 10) and $number = 0;
	$chineseNumber = ["零","一","二","三","四","五","六","七","八","九","十"];
	return $chineseNumber[$number];
}
function ChineseNumber2Number($number = '零')
{
	$chineseNumber = ["零","一","二","三","四","五","六","七","八","九","十"];
	!in_array($number,$chineseNumber) and $number = '零';
	$chineseNumber = array_flip($chineseNumber);
	return $chineseNumber[$number];
}
/**
* 星期中文转数字
* @param undefined $week
* 
* @return int 星期数字
*/
function WeekChinese2Number($week = '日')
{
	$weekChineses = ["日","一","二","三","四","五","六"];
	$weekChineses = array_flip($weekChineses);
	!in_array($week,$weekChineses) and $week = '日';
	return $weekChineses[$week];
}
/**
* 星期数字转中文
* 
* @param int $weekNumber 星期数字
* @param string $weekPrefix 中文星期前缀 [周|星期]
* 
* @return string 中文星期
*/
function WeekNumber2Chinese($weekNumber = 0,$weekPrefix = "周")
{
	$weekChineses = ["日","一","二","三","四","五","六"];
	($weekNumber < 0 || $weekNumber > count($weekChineses)) and $weekNumber = 0;
	return $weekPrefix.$weekChineses[$weekNumber];
}
function LMonName($month)
{
	$month == "腊" and $month = "十二";
	$Name = array(1=>"正","二","三","四","五","六","七","八","九","十","十一","十二");
	$Name = array_flip($Name);
	return $Name[$month];
}

function LDayName($day)
{
	$Name = array(1=>
		"初一","初二","初三","初四","初五","初六","初七","初八","初九","初十",
		"十一","十二","十三","十四","十五","十六","十七","十八","十九","二十",
		"廿一","廿二","廿三","廿四","廿五","廿六","廿七","廿八","廿九","三十"
	);
	$Name = array_flip($Name);
	return $Name[$day];
}

<?php
/**
 * api
 *
 * @author  zhusaidong [zhusaidong@gmail.com]
 * @version 3.0
 */
date_default_timezone_set('Asia/Shanghai');

require("function.php");
require('lib/Calendar.php');
require('lib/YearHoliday.php');
require('vendor/autoload.php');

//输入
switch(true)
{
	case !isset($_GET['date']):
		error(-1, '输入日期');
		break;
	case empty($_GET['date']):
		$dates = date('Y-m-d', time());
		break;
	default:
		$dates = $_GET['date'];
		break;
}

$yearHoliday = new YearHoliday();

$infoConf = [
	0 => '工作日',
	1 => '节假日',
	2 => '双休日',
];

$return = [];
foreach(explode(',', $dates) as $date)
{
	//不正确的日期格式
	if(($timestamp = strtotime($date)) === false)
	{
		error(-2, '不正确的日期格式:' . $date);
	}
	
	$return_date = date('Y-m-d', $timestamp);
	//工作日
	$return_code = 0;
	
	$holidays = $yearHoliday->get(date('Y', $timestamp));
	
	$_holidays = [];
	foreach($holidays as $holiday)
	{
		if($holiday['time'] == $timestamp)
		{
			$_holidays[] = $holiday;
		}
	}
	foreach($_holidays as $_holiday)
	{
		if($_holiday['work'] == NOT_WORK)
		{
			$return_code = 1;
			break;
		}
	}
	
	//不是节假日,则判断是否为非工作日(周六周日)
	if($return_code == 0)
	{
		//星期
		$w = date('w', $timestamp);
		if($w == 0 || $w == 6)
		{
			//双休日
			$return_code = 2;
		}
	}
	
	if(!empty($_holidays))
	{
		$name = implode(',', array_column($_holidays, 'name'));
	}
	else
	{
		$name = $return_code == 1 ? '周一至周五' : '周六周日';
	}
	
	$return[] = [
		'date' => $return_date,
		'code' => $return_code,
		'info' => $infoConf[$return_code],
		'name' => $name,
	];
}
output($return);

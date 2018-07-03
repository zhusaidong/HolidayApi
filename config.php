<?php
/**
* 节假日配置
* 	array(
* 		time	=>时间,
* 		name	=>名称,
* 		days	=>放假天数
* 	)
*
* @author zhusaidong [zhusaidong@gmail.com]
* @version 0.3.0.0
*/

//阳历
$gregorian_calendar = array(
	array (
		'time'=> '1-1',
		'name'=> '元旦',
		'days'=> 1,
	),
	array (
		'time'=> '5-1',
		'name'=> '国际劳动节',
		'days'=> 1,
	),
	array (
		'time'=> '10-1',
		'name'=> '国庆节',
		'days'=> 5,
	),
);

//特殊阳历:a月第b个星期c
$special_gregorian_calendar = array(
	
);

//阴历
$lunar_calendar = array(
	array (
		'time'=> '正月初一',
		'name'=> '春节',
		'days'=> 6,
	),
	array (
		'time'=> '五月初五',
		'name'=> '端午节',
		'days'=> 1,
	),
	array (
		'time'=> '八月十五',
		'name'=> '中秋节',
		'days'=> 1,
	),
	array (
		'time'=> '十二月三十',
		'name'=> '除夕',
		'days'=> 1,
	),
);

//节气节日
$solarterms_calendar = array(
	array (
		'time'=> '清明',
		'name'=> '清明节',
		'days'=> 1,
	),
);

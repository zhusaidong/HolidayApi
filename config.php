<?php
/**
* 节假日配置
* 	array(
* 		time	=>时间,
* 		name	=>名称,
* 		days	=>放假天数，0表示不放假，不算放假
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
		'time'=> '2-2',
		'name'=> '世界湿地日',
		'days'=> 0,
	),
	array (
		'time'=> '2-14',
		'name'=> '情人节',
		'days'=> 0,
	),
	array (
		'time'=> '3-3',
		'name'=> '全国爱耳日',
		'days'=> 0,
	),
	array (
		'time'=> '3-5',
		'name'=> '青年志愿者服务日',
		'days'=> 0,
	),
	array (
		'time'=> '3-8',
		'name'=> '国际妇女节',
		'days'=> 0,
	),
	array (
		'time'=> '3-9',
		'name'=> '保护母亲河日',
		'days'=> 0,
	),
	array (
		'time'=> '3-12',
		'name'=> '中国植树节',
		'days'=> 0,
	),
	array (
		'time'=> '3-14',
		'name'=> '白色情人节',
		'days'=> 0,
	),
	array (
		'time'=> '3-14',
		'name'=> '国际警察日',
		'days'=> 0,
	),
	array (
		'time'=> '3-15',
		'name'=> '世界消费者权益日',
		'days'=> 0,
	),
	array (
		'time'=> '3-21',
		'name'=> '世界森林日',
		'days'=> 0,
	),
	array (
		'time'=> '3-21',
		'name'=> '世界睡眠日',
		'days'=> 0,
	),
	array (
		'time'=> '3-22',
		'name'=> '世界水日',
		'days'=> 0,
	),
	array (
		'time'=> '3-23',
		'name'=> '世界气象日',
		'days'=> 0,
	),
	array (
		'time'=> '3-24',
		'name'=> '世界防治结核病日',
		'days'=> 0,
	),
	array (
		'time'=> '4-1',
		'name'=> '愚人节',
		'days'=> 0,
	),
	array (
		'time'=> '4-5',
		'name'=> '清明节',
		'days'=> 1,
	),
	array (
		'time'=> '4-7',
		'name'=> '世界卫生日',
		'days'=> 0,
	),
	array (
		'time'=> '4-22',
		'name'=> '世界地球日',
		'days'=> 0,
	),
	array (
		'time'=> '4-26',
		'name'=> '世界知识产权日',
		'days'=> 0,
	),
	array (
		'time'=> '5-1',
		'name'=> '国际劳动节',
		'days'=> 1,
	),
	array (
		'time'=> '5-3',
		'name'=> '世界哮喘日',
		'days'=> 0,
	),
	array (
		'time'=> '5-4',
		'name'=> '中国青年节',
		'days'=> 0,
	),
	array (
		'time'=> '5-8',
		'name'=> '世界红十字日',
		'days'=> 0,
	),
	array (
		'time'=> '5-12',
		'name'=> '国际护士节',
		'days'=> 0,
	),
	array (
		'time'=> '5-15',
		'name'=> '国际家庭日',
		'days'=> 0,
	),
	array (
		'time'=> '5-17',
		'name'=> '世界电信日',
		'days'=> 0,
	),
	array (
		'time'=> '5-20',
		'name'=> '全国学生营养日',
		'days'=> 0,
	),
	array (
		'time'=> '5-23',
		'name'=> '国际牛奶日',
		'days'=> 0,
	),
	array (
		'time'=> '5-31',
		'name'=> '世界无烟日',
		'days'=> 0,
	),
	array (
		'time'=> '6-1',
		'name'=> '国际儿童节',
		'days'=> 0,
	),
	array (
		'time'=> '6-5',
		'name'=> '世界环境日',
		'days'=> 0,
	),
	array (
		'time'=> '6-6',
		'name'=> '全国爱眼日',
		'days'=> 0,
	),
	array (
		'time'=> '6-17',
		'name'=> '世界防治荒漠化和干旱日',
		'days'=> 0,
	),
	array (
		'time'=> '6-23',
		'name'=> '国际奥林匹克日',
		'days'=> 0,
	),
	array (
		'time'=> '6-25',
		'name'=> '全国土地日',
		'days'=> 0,
	),
	array (
		'time'=> '6-26',
		'name'=> '国际禁毒日',
		'days'=> 0,
	),
	array (
		'time'=> '7-1',
		'name'=> '建党节',
		'days'=> 0,
	),
	array (
		'time'=> '7-1',
		'name'=> '国际建筑日',
		'days'=> 0,
	),
	array (
		'time'=> '7-7',
		'name'=> '中国人民抗日战争纪念日',
		'days'=> 0,
	),
	array (
		'time'=> '7-11',
		'name'=> '世界人口日',
		'days'=> 0,
	),
	array (
		'time'=> '8-1',
		'name'=> '建军节',
		'days'=> 0,
	),
	array (
		'time'=> '8-12',
		'name'=> '国际青年节',
		'days'=> 0,
	),
	array (
		'time'=> '9-8',
		'name'=> '国际扫盲日',
		'days'=> 0,
	),
	array (
		'time'=> '9-10',
		'name'=> '中国教师节',
		'days'=> 0,
	),
	array (
		'time'=> '9-16',
		'name'=> '中国脑健康日',
		'days'=> 0,
	),
	array (
		'time'=> '9-16',
		'name'=> '国际臭氧层保护日',
		'days'=> 0,
	),
	array (
		'time'=> '9-20',
		'name'=> '全国爱牙日',
		'days'=> 0,
	),
	array (
		'time'=> '9-21',
		'name'=> '世界停火日',
		'days'=> 0,
	),
	array (
		'time'=> '9-27',
		'name'=> '世界旅游日',
		'days'=> 0,
	),
	array (
		'time'=> '10-1',
		'name'=> '国庆节',
		'days'=> 5,
	),
	array (
		'time'=> '10-1',
		'name'=> '国际音乐日',
		'days'=> 0,
	),
	array (
		'time'=> '10-1',
		'name'=> '国际老年人日',
		'days'=> 0,
	),
	array (
		'time'=> '10-4',
		'name'=> '世界动物日',
		'days'=> 0,
	),
	array (
		'time'=> '10-5',
		'name'=> '世界教师日',
		'days'=> 0,
	),
	array (
		'time'=> '10-8',
		'name'=> '全国高血压日',
		'days'=> 0,
	),
	array (
		'time'=> '10-9',
		'name'=> '世界邮政日',
		'days'=> 0,
	),
	array (
		'time'=> '10-10',
		'name'=> '世界精神卫生日',
		'days'=> 0,
	),
	array (
		'time'=> '10-14',
		'name'=> '世界标准日',
		'days'=> 0,
	),
	array (
		'time'=> '10-15',
		'name'=> '国际盲人节',
		'days'=> 0,
	),
	array (
		'time'=> '10-15',
		'name'=> '世界农村妇女日',
		'days'=> 0,
	),
	array (
		'time'=> '10-16',
		'name'=> '世界粮食日',
		'days'=> 0,
	),
	array (
		'time'=> '10-17',
		'name'=> '国际消除贫困日',
		'days'=> 0,
	),
	array (
		'time'=> '10-24',
		'name'=> '联合国日',
		'days'=> 0,
	),
	array (
		'time'=> '10-24',
		'name'=> '世界发展新闻日',
		'days'=> 0,
	),
	array (
		'time'=> '10-28',
		'name'=> '中国男性健康日',
		'days'=> 0,
	),
	array (
		'time'=> '10-29',
		'name'=> '国际生物多样性日',
		'days'=> 0,
	),
	array (
		'time'=> '10-31',
		'name'=> '万圣节',
		'days'=> 0,
	),
	array (
		'time'=> '11-8',
		'name'=> '中国记者节',
		'days'=> 0,
	),
	array (
		'time'=> '11-9',
		'name'=> '消防宣传日',
		'days'=> 0,
	),
	array (
		'time'=> '11-14',
		'name'=> '世界糖尿病日',
		'days'=> 0,
	),
	array (
		'time'=> '11-17',
		'name'=> '国际大学生节',
		'days'=> 0,
	),
	array (
		'time'=> '11-25',
		'name'=> '国际消除对妇女的暴力日',
		'days'=> 0,
	),
	array (
		'time'=> '12-1',
		'name'=> '世界爱滋病日',
		'days'=> 0,
	),
	array (
		'time'=> '12-3',
		'name'=> '世界残疾人日',
		'days'=> 0,
	),
	array (
		'time'=> '12-4',
		'name'=> '全国法制宣传日',
		'days'=> 0,
	),
	array (
		'time'=> '12-9',
		'name'=> '世界足球日',
		'days'=> 0,
	),
	array (
		'time'=> '12-25',
		'name'=> '圣诞节',
		'days'=> 0,
	),
	array (
		'time'=> '12-29',
		'name'=> '国际生物多样性日',
		'days'=> 0,
	),
);

//特殊阳历:a月第b个星期c
$special_gregorian_calendar = array(
	array (
		'time'=> '1月最后一个星期日',
		'name'=> '国际麻风节',
		'days'=> 0,
	),
	array (
		'time'=> '3月最后一个完整周的星期一',
		'name'=> '中小学生安全教育日',
		'days'=> 0,
	),
	array (
		'time'=> '5月第二个星期日',
		'name'=> '母亲节',
		'days'=> 0,
	),
	array (
		'time'=> '5月第三个星期日',
		'name'=> '全国助残日',
		'days'=> 0,
	),
	array (
		'time'=> '6月第三个星期日',
		'name'=> '父亲节',
		'days'=> 0,
	),
	array (
		'time'=> '9月第三个星期二',
		'name'=> '国际和平日',
		'days'=> 0,
	),
	array (
		'time'=> '9月第三个星期六',
		'name'=> '全国国防教育日',
		'days'=> 0,
	),
	array (
		'time'=> '9月第四个星期日',
		'name'=> '国际聋人节',
		'days'=> 0,
	),
	array (
		'time'=> '10月第一个星期一',
		'name'=> '世界住房日',
		'days'=> 0,
	),
	array (
		'time'=> '10月第二个星斯一',
		'name'=> '加拿大感恩节',
		'days'=> 0,
	),
	array (
		'time'=> '10月第二个星期三',
		'name'=> '国际减轻自然灾害日',
		'days'=> 0,
	),
	array (
		'time'=> '10月第二个星期四',
		'name'=> '世界爱眼日',
		'days'=> 0,
	),
	array (
		'time'=> '11月最后一个星期四',
		'name'=> '美国感恩节',
		'days'=> 0,
	),
);

//阴历
$lunar_calendar = array(
	array (
		'time'=> '正月初一',
		'name'=> '春节',
		'days'=> 6,
	),
	array (
		'time'=> '正月十五',
		'name'=> '元宵节',
		'days'=> 0,
	),
	array (
		'time'=> '五月初五',
		'name'=> '端午节',
		'days'=> 1,
	),
	array (
		'time'=> '七月初七',
		'name'=> '乞巧节',
		'days'=> 0,
	),
	array (
		'time'=> '八月十五',
		'name'=> '中秋节',
		'days'=> 1,
	),
	array (
		'time'=> '九月初九',
		'name'=> '重阳节',
		'days'=> 0,
	),
	array (
		'time'=> '腊月初八',
		'name'=> '腊八节',
		'days'=> 0,
	),
	array (
		'time'=> '十二月三十',
		'name'=> '除夕',
		'days'=> 1,
	),
);

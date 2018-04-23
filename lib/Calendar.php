<?php
/**
* Calendar类
* @author zhusaidong [zhusaidong@gmail.com]
* @version 0.3.0.0
*/
class Calendar
{
	private $chineseNumber 	= ["零","一","二","三","四","五","六","七","八","九","十"];
	private $weekChineses 	= ["日","一","二","三","四","五","六"];
	private $lunarMonth 	= array(1=>"正","二","三","四","五","六","七","八","九","十","十一","十二");
	private $lunarDay 		= array(1=>
		"初一","初二","初三","初四","初五","初六","初七","初八","初九","初十",
		"十一","十二","十三","十四","十五","十六","十七","十八","十九","二十",
		"廿一","廿二","廿三","廿四","廿五","廿六","廿七","廿八","廿九","三十"
	);
	
	/**
	* 本月第几天
	* @param int $timestamp 时间戳
	*
	* @return int 第几天
	*/
	public function getDayOfMonth($timestamp = 0)
	{
		$timestamp == 0 and $timestamp = time();
		return date("d", $timestamp);
	}
	
	/**
	* 获取本月第m个星期n
	* @param int $time
	* @param int $day
	* @param int $week
	*
	* @return int 时间戳
	*/
	public function getDateByWeekOfMonth($time,$day,$week)
	{
		$time = strtotime(date('Y-m-01',$time));
		return $time + 86400 * ($week - date('w',$time)) + 86400 * (7 * ($day - 1));
	}
	
	/**
	* 获取时间在本月的第m个星期n
	* @param int $time 时间戳
	*
	* @return array number=>第m个 week=>星期n
	*/
	public function getWeekNumberByDate($time = 0)
	{
		$time == 0 and $time   = time();

		$return = [];
		$day    = date('d',$time) - 1;
		$return['week'] = (date('w',strtotime(date('Y-m-01',$time))) + $day % 7) % 7;
		$return['number'] = floor($day / 7) + 1;
		$return['chineseNumber'] = '第'.$this->getNumber2ChineseNumber($return['number']).'个';
		if($day + 1 + 7 >= date('t',$time))
		{
			$return['lastWeek'] = 1;
		}
		return $return;
	}
	
	/**
	* 阿拉伯数字转中文数字
	* @param int $number
	* 
	* @return
	*/
	public function getNumber2ChineseNumber($number = - 1)
	{
		($number == - 1 || $number > 10) and $number = 0;
		return $this->chineseNumber[$number];
	}
	
	/**
	* 中文数字转阿拉伯数字
	* @param string $number
	* 
	* @return
	*/
	public function getChineseNumber2Number($number = '零')
	{
		!in_array($number,$this->chineseNumber) and $number = '零';
		$chineseNumber = array_flip($this->chineseNumber);
		return $chineseNumber[$number];
	}
	
	/**
	* 星期中文转数字
	* @param string $week
	*
	* @return int 星期数字
	*/
	public function getWeekChinese2Number($week = '日')
	{
		$weekChineses = array_flip($this->weekChineses);
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
	public function getWeekNumber2Chinese($weekNumber = 0,$weekPrefix = "周")
	{
		($weekNumber < 0 || $weekNumber > count($this->weekChineses)) and $weekNumber = 0;
		return $weekPrefix.$this->weekChineses[$weekNumber];
	}
	
	/**
	* 农历月份转数字月份
	* @param string $month 农历月份
	* 
	* @return
	*/
	public function getLunarMonth2Number($month)
	{
		$month == "腊" and $month = "十二";
		$lunarMonth = array_flip($this->lunarMonth);
		return $lunarMonth[$month];
	}
	
	/**
	* 农历日期转数字日期
	* @param string $day 农历日期
	* 
	* @return
	*/
	public function getLunarDay2Number($day)
	{
		$lunarDay = array_flip($this->lunarDay);
		return $lunarDay[$day];
	}
}

<?php

use ChineseLunar\Lunar;

/**
 * 某一年的所有节假日
 *
 * @author zhusaidong [zhusaidong@gmail.com]
 */
class YearHoliday
{
	private $cache = 'holiday_cache/';
	private $year;
	private $holidayData;
	private $calendar;
	
	public function __construct()
	{
		if(!is_dir($this->cache))
		{
			mkdir($this->cache);
		}
		$this->calendar    = new Calendar();
		$this->holidayData = include('config.php');
	}
	
	public function get($year)
	{
		$this->setYear($year);
		if(!is_file($this->cache . $this->year . '.json'))
		{
			$data = $this->calc($this->holidayData['gregorian_holiday'], $this->holidayData['lunar_holiday'], $this->holidayData['solarterms_holiday'], $this->holidayData['special_gregorian_holiday']);
			$this->setFile($data);
		}
		
		return $this->getFile();
	}
	
	private function getFile()
	{
		return json_decode(file_get_contents($this->cache . $this->year . '.json'), true);
	}
	
	private function setFile($data)
	{
		file_put_contents($this->cache . $this->year . '.json', json_encode($data, JSON_UNESCAPED_UNICODE));
	}
	
	private function setYear($year)
	{
		$this->year = $year;
		
		return $this;
	}
	
	private function calc($gregorian, $lunar, $solarterms, $special_gregorian)
	{
		$lunarLib = new Lunar();
		$return   = [];
		
		//阴历节假日
		foreach($lunar as $_lunar)
		{
			//time
			$time = $_lunar["time"];
			$time = explode('月', $time);
			//农历转数字
			$year = $this->year;
			
			//上年的阴历在新的阳历年里
			in_array($_lunar["name"], ['除夕', '北方小年', '南方小年', '腊八节']) and $year--;
			
			try
			{
				$time = $lunarLib->toSolarDate($year, $time[0] . '月', $time[1]);
			}
			catch(Exception $e)
			{
			}
			
			$time = strtotime(implode('-', $time));
			//start end
			$start = $time;
			$end   = $time + $_lunar["days"] * 86400 - 1;
			for($i = $start; $i < $end; $i += 86400)
			{
				$return[] = [
					'time' => $i,
					'date' => date('Y-m-d', $i),
					'name' => $_lunar['name'],
					'work' => $_lunar['work'],
				];
			}
		}
		//阳历节假日
		foreach($gregorian as $_gregorian)
		{
			if($this->year < $_gregorian["start_year"])
			{
				continue;
			}
			$time = strtotime($this->year . '-' . $_gregorian["time"]);
			
			$start = $time;
			$end   = $time + $_gregorian["days"] * 86400 - 1;
			for($i = $start; $i < $end; $i += 86400)
			{
				//节假日重叠问题；目前只发现2017-10-04
				if(in_array($i, array_column($return, 'time')))
				{
					$end += 86400;
				}
				else
				{
					$return[] = [
						'time' => $i,
						'date' => date('Y-m-d', $i),
						'name' => $_gregorian['name'],
						'work' => $_gregorian['work'],
					];
				}
			}
		}
		//特殊阳历节假日
		foreach($special_gregorian as $_gregorian)
		{
			if($this->year < $_gregorian["start_year"])
			{
				continue;
			}
			
			preg_match('/^(.*)月(.*)星期(.*)$/iUs', $_gregorian["time"], $match);
			if(!isset($match[2]))
			{
				break;
			}
			if($match[2] == "最后一个")
			{
				$match[2] = 7;
			}
			else
			{
				$match[2] = $this->calendar->getChineseNumber2Number(mb_substr($match[2], 1, 1));
			}
			$gdwnm = $this->calendar->getDateByWeekOfMonth(strtotime($this->year . '-' . $match[1] . '-01'), $match[2], $this->calendar->getWeekChinese2Number($match[3]));
			if($match[2] == 7 and date('m', $gdwnm) != $match[1])
			{
				$match[2] = 6;
				$gdwnm    = $this->calendar->getDateByWeekOfMonth(strtotime($this->year . '-' . $match[1] . '-01'), $match[2], $this->calendar->getWeekChinese2Number($match[3]));
			}
			$time = $gdwnm;
			
			$start = $time;
			$end   = $time + $_gregorian["days"] * 86400 - 1;
			for($i = $start; $i < $end; $i += 86400)
			{
				$return[] = [
					'time' => $i,
					'date' => date('Y-m-d', $i),
					'name' => $_gregorian['name'],
					'work' => $_gregorian['work'],
				];
			}
		}
		//节气节日
		foreach($solarterms as $_solarterms)
		{
			$time = $_solarterms["time"];
			$year = $this->year;
			
			try
			{
				$time = $lunarLib->getSolarTerms($year, $time);
			}
			catch(Exception $e)
			{
			}
			$time = strtotime($time);
			//start end
			$start = $time;
			$end   = $time + $_solarterms["days"] * 86400 - 1;
			for($i = $start; $i < $end; $i += 86400)
			{
				$return[] = [
					'time' => $i,
					'date' => date('Y-m-d', $i),
					'name' => $_solarterms['name'],
					'work' => $_solarterms['work'],
				];
			}
		}
		
		return $return;
	}
}

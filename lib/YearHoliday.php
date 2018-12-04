<?php
/**
* 某一年的所有节假日
* @author zhusaidong [zhusaidong@gmail.com]
*/
class YearHoliday
{
	private $cache = 'calendar_cache/';
	private $year;
	public function __construct()
	{
		if(!is_dir($this->cache))
		{
			mkdir($this->cache);
		}
	}
	public function get($year)
	{
		$this->setYear($year);
		if(!is_file($this->cache.$this->year.'.json'))
		{
			require('config.php');
			$data = $this->calc($gregorian_calendar,$lunar_calendar,$solarterms_calendar);
			$this->setFile($data);
		}
		return $this->getFile($year);
	}
	
	private function getFile()
	{
		return json_decode(file_get_contents($this->cache.$this->year.'.json'),TRUE);
	}
	private function setFile($data)
	{
		file_put_contents($this->cache.$this->year.'.json',json_encode($data,JSON_UNESCAPED_UNICODE));
	}
	private function setYear($year)
	{
		$this->year = $year;
		return $this;
	}
	private function calc($gregorian,$lunar,$solarterms)
	{
		$lunarLib = new \ChineseLunar\Lunar();
		$return = [];
		
		//判断是否为阴历节假日
		foreach($lunar as $_lunar)
		{
			//time
			$time = $_lunar["time"];
			$time = explode('月',$time);
			//农历转数字
			$year = $this->year;
			$_lunar["name"] == '除夕' and $year--;//除夕是上一年的阴历日期
			$time = $lunarLib->toSolarDate($year,$time[0].'月',$time[1]);
			$time = strtotime(implode('-',$time));
			//start end
			$start= $time;
			$end  = $time + $_lunar["days"] * 86400 - 1;
			for($i = $start; $i < $end; $i+= 86400)
			{
				if($_lunar["days"] > 0)
				{
					$return[] = [
						'time'=>$i,
						'date'=>date('Y-m-d',$i),
						'name'=>$_lunar['name'],
					];
				}
			}
		}
		//节气节日
		foreach($solarterms as $_solarterms)
		{
			$time = $_solarterms["time"];
			$year = $this->year;
			$time = $lunarLib->getSolarTerms($year,$time);
			$time = strtotime($time);
			//start end
			$start= $time;
			$end  = $time + $_solarterms["days"] * 86400 - 1;
			for($i = $start; $i < $end; $i+= 86400)
			{
				if($_solarterms["days"] > 0)
				{
					$return[] = [
						'time'=>$i,
						'date'=>date('Y-m-d',$i),
						'name'=>$_solarterms['name'],
					];
				}
			}
		}
		//判断是否为阳历节假日
		foreach($gregorian as $_gregorian)
		{
			if($this->year < $_gregorian["start_year"])
			{
				continue;
			}
			$time = strtotime($this->year.'-'.$_gregorian["time"]);
			
			$start= $time;
			$end  = $time + $_gregorian["days"] * 86400 - 1;
			for($i = $start; $i < $end; $i+= 86400)
			{
				if($_gregorian["days"] > 0)
				{
					//节假日重叠问题；目前只发现2017-10-04
					if(in_array($i,array_column($return,'time')))
					{
						$end += 86400; 
					}
					else
					{
						$return[] = [
							'time'=>$i,
							'date'=>date('Y-m-d',$i),
							'name'=>$_gregorian['name'],
						];
					}
				}
			}
		}
		return $return;
	}
}

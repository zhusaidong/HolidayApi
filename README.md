# HolidayApi
节假日api


> 运行index.php

* demo

<a target="_blank" href="http://holiday.zhusaidong.cn/">DEMO</a>

* 返回json

```
[
  {
    "date":"2017-10-05",
    "code":1,
    "info":"节假日",
    "describe":
    {
      "Time":"10月1日",
      "Name":"国庆节",
      "EnglishName":"National Day",
      "IsNotWork":1,
      "Start":0,
      "End":7
    }
  }
]
```

* 说明

```
code = 0
  工作日:周一至周五
code = 1
  节假日
code = 2
  双休日:周六周日
```

* 功能

```
 加入节假日时间段,节假日不放假
 	1.节假日当天前后几天能放假的都算节假日
 		如:10.1国庆节,但是放假7天,所以10.1-10.7都算节假日
 	2.有些节日不放假,算工作日
 		如:2.2世界湿地日,但是不放假,所以算工作日
```

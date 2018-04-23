# HolidayApi
节假日api

* demo

[demo](http://holiday.zhusaidong.cn/)

* 返回json

```
[
  {
    "date":"2017-10-05",
    "code":1,
    "info":"节假日",
    "describe":
    {
      "time":"10-1",
      "name":"国庆节",
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

* TODO

```
1. 节假日叠加问题
	 因为国庆节和中秋节重叠，使得2017.10.8也属于节假日
2. 调休问题
3. 区分节假日和双休日
	 如，国庆7天，实际上是节假日5天，双休日2天
```

* V3.0 CHANGELOG

> 删除配置的字段 `EnglishName`, `Start`

> 规范化变量名称



# HolidayApi
节假日api


> 运行index.html 或者 api.php?date=2017-01-01

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

*说明

```
code = 0
  工作日:周一至周五
code = 1
  节假日
code = 2
  双休日:周六周日
```



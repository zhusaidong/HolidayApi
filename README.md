# HolidayApi
节假日api

## demo

[demo](http://holiday.zhusaidong.cn/)

## Usage

```php
composer update
```

## 返回格式

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

## 说明

```
code = 0
  工作日:周一至周五
code = 1
  节假日
code = 2
  双休日:周六周日
```

## TODO


- [x] 添加节气节假日

	清明节
	
- [ ] 有起始时间点的节假日

	1949年之前没有国庆节
	
- [ ] 节假日叠加问题

	因为国庆节和中秋节重叠，使得2017.10.8也属于节假日
	
- [ ] 调休问题
- [ ] 区分节假日,双休日,调休日

	如，国庆节7天，实际上是法定节假日3天+双休日2天+调休2天


## CHANGELOG

> 删除配置的字段 `EnglishName`, `Start`

> 规范化变量名称

> 添加节气节假日-清明节



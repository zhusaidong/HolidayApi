# HolidayApi

节假日api

## demo

[demo](http://holiday.zhusaidong.cn/v3/)

## Usage

```shell
composer update
```

## 返回格式

```json
[
  {
    "date":"2017-10-08",
    "code":1,
    "info":"节假日",
    "name":"国庆节"
  }
]
```

## 说明

```ini
;工作日:周一至周五
code = 0
;节假日
code = 1
;双休日:周六周日
code = 2
```

## TODO

- [ ] 从政府官网匹配节假日来解决调休问题


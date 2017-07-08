<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>
			节假日api
		</title>
		<meta name="author" content="zsdroid">
		<style>
			html, body
			{
				height: 100%;
			}
			body
			{
				margin: 0;
				padding: 0;
				width: 100%;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}
			.container
			{
				margin:0 auto;
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}
			.content
			{
				text-align: center;
				display: inline-block;
			}
			.title
			{
				font-size: 25px;
			}
			a
			{
				text-decoration: none;
			}
		</style>
		<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="container" style="margin-top: 50px;">
			<h3>
				节假日api(
				<a target="_blank" href="https://github.com/zhusaidong/HolidayApi">
					fork github
				</a>)
			</h3>
			<h5>
				能判断某个时间是否是节假日
			</h5>
			<div style="margin:0 auto;width: 500px;text-align: left;">
				<fieldset>
					<legend>
						注:
					</legend>
<pre>
	加入节假日时间段,节假日不放假
		1.节假日当天前后几天能放假的都算节假日
			如:10.1国庆节,但是放假7天,所以10.1-10.7都算节假日
		2.有些节假日不放假,算工作日
			如:2.2世界湿地日,但是不放假,所以算工作日
</pre>
				</fieldset>
			</div>
			<br />
			<div>
				<span class="content">
					api中所指的双休日即周六周日,工作日即周一至周五,节假日即法定节假日.
				</span>
				<br />
				接口地址:
				<?php
				$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
				?>
				<?php echo $url;?>api.php?date=<font color="red">日期</font>
				<br /><br />
				demo1:
				<a target="_blank" href="<?php echo $url;?>api.php?date=<?php echo date('Y-m-d');?>">
					<?php echo $url;?>api.php?date=<?php echo date('Y-m-d');?>
				</a>
				<br />
				demo2:
				选择日期:<input type="date" class="HolidayApi-DEMO" />
				<br />
				<span class="HolidayApi-DEMO-info"></span>
			</div>
		</div>
	</body>
	<script>
		$('.HolidayApi-DEMO').change(function()
			{
				console.log($(this).val());
				$.ajax(
					{
						url:'api.php',
						data:
						{
							date:$(this).val()
						},
						success:function(data)
						{
							data = eval(data);
							var text = '你选的日期是：' + data[0].date + ',' + data[0].info + '(' + data[0].describe.Name + ')';
							$('.HolidayApi-DEMO-info').text(text);
						}
					});
			});
	</script>
</html>

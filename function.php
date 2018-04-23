<?php
/**
* function
* @author zhusaidong [zhusaidong@gmail.com]
* @version 0.3.0.0
*/
function output($data)
{
	exit(json_encode($data,JSON_UNESCAPED_UNICODE));
}
function error($error_code,$error_msg)
{
	output([
		'code'		=>$error_code,
		'info'		=>$error_msg,
		'describe'	=>[],
	]);
}

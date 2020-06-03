<?php
/**
 * output
 *
 * @param $data
 *
 * @version 0.3.0.0
 * @author  zhusaidong [zhusaidong@gmail.com]
 */
function output($data)
{
	exit(json_encode($data, JSON_UNESCAPED_UNICODE));
}

function error($error_code, $error_msg)
{
	output([
		'code'     => $error_code,
		'info'     => $error_msg,
		'describe' => [],
	]);
}

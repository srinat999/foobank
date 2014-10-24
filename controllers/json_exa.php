<?php
	$json="{\"transactions\": [{\"destacc\": 123,\"amount\": 345}, {\"destacc\": 234,\"amount\": 456}],\"sum\": 801}";
	$decode=json_decode($json);
	//print_r($decode);
	print_r($decode->sum);
?>
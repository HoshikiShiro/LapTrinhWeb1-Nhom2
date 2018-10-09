<?php
	require "data.php";
	require "config.php";

	$db = new DB;
	$arr = $db->user();
	foreach ($arr as $value) {
		echo $value['username']."<br>";
	}
	var_dump($arr);
?>
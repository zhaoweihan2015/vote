<?php
require_once ('config.php');
if(!$mysql = mysqli_connect(HOST, USER, PASSWORD, DATABASE)){
	echo mysqli_error();
};
$mysql->query('set names utf8');
header("Content-Type: text/html; charset=UTF-8");
?>
<?php
require_once ('config.php');
if(!$mysql = mysqli_connect(HOST, USER, PASSWORD, DATABASE)){
	echo mysqli_error();
};
$mysql->query('set header utf8');
?>
<?php
	header("content-type:text/html;charset=utf-8");

	$conn=mysql_connect("localhost","root","");
	mysql_set_charset("utf8");
	mysql_select_db("message_board");
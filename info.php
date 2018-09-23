<?php
	if($_COOKIE['islogin']!=1){
		header("location:login.php");
	}
		
	require("connect.php");
	$username=$_COOKIE['username'];
	$sql="select * from user where username='{$username}'";
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="Css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="Js/jquery.js"></script>
</head>
<body>
	<div class="container">
		<h2 class="text-center" style="height:100px;line-height:100px;">用户信息</h2>
		<table class="table">
			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">头像：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><img src="<?php echo './img/'.$row['imgpath']; ?>" width='150' height='150'></td>
			</tr>

			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">用户名：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><?php echo $row['username'] ?></td>
			</tr>

			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">密码：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">保密</td>
			</tr>
			<tr class="row">
				<td colspan="2"></td>
			</tr>
		</table>
		<div class="row text-center">
			<a href="editinfo.php" class="btn btn-success">修改信息</a>
			<a href="index.php" class="btn btn-default">返回首页</a>
		</div>
	</div>
</body>
</html>
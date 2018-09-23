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
	<script type="text/javascript" src="Js/style.js"></script>
</head>
<body>
	<div class="container">
		<h2 class="text-center" style="height:100px;line-height:100px;">用户信息修改</h2>
		<table class="table">
			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">头像：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><img src="<?php echo './img/'.$row['imgpath']; ?>" width='150' height='150'></td>
			</tr>

			<form action="action.php?a=updateinfo" method="post" enctype="multipart/form-data">
				<tr class="row">
					<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">更换头像：</td>
					<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<input type="file" name="imgpath" id="file">
					</td>
				</tr>

				<tr class="row">
					<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">头像预览：</td>
					<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<img src="" id="img" width="250"/>
						<input type="submit" value="上传头像" />
					</td>
				</tr>
			</form>

			<form action="action.php?a=updateuser" method="post">
			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">用户名：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<input type="text" name="username" value="<?php echo $row['username']; ?>" class="form-control" required placeholder="请输入修改后的用户名">
				</td>
			</tr>

			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">密码：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<input type="password" name="userpass" class="form-control" required placeholder="请输入输入原始密码或重置密码">
				</td>
			</tr>
			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">确认密码：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<input type="password" name="reuserpass" class="form-control" required placeholder="再次输入密码">
				</td>
			</tr>
			<tr class="row">
				<td colspan="2"></td>
			</tr>
		</table>
		<div class="row text-center">
			<input type="submit" value="确认修改" class="btn btn-success">
			<a href="info.php" class="btn btn-default">取消</a>&nbsp;&nbsp;
			<a href="index.php" style="font-size:12px;">返回首页</a>
		</div>
		</form>
	</div>
</body>
</html>
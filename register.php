<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="Css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="Js/jquery.js"></script>
	<script type="text/javascript" src="Js/style.js"></script>
</head>
<body style="margin-top:5%">
	<center>
		<h5>已有账号？前往<a href="login.php">登录</a></h5>
		<h3 style="line-height:80px;height:80px;">用户注册</h3>
		<form action="action.php?a=register" method="post" enctype="multipart/form-data">
		<div class="col-lg-4 col-md-4 col-lg-offset-4">
			<table border="0" width="450" class="table">
				<tr>
					<td>用户头像：</td>
					<td><input type="file" name="imgpath" id="file" required><span style="font-size:12px;color:#888;">(文件类型只能为jpg,jpeg,png,gif)</span></td>
				</tr>
				<tr>
					<td>用户头像预览：</td>
					<td><img src=""  id="img" width="250" /></td>
				</tr>
				<tr>
					<td>用户名：</td>
					<td><input type="text" name="username" class="form-control" required id="username"></td>
				</tr>
				<tr>
					<td>密码：</td>
					<td><input type="password" name="userpass" class="form-control" required></td>
				</tr>
				<tr>
					<td>确定密码：</td>
					<td><input type="password" name="confirm_pass" class="form-control"></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="注册" class="btn btn-success">
						<input type="reset" value="取消" class="btn btn-default">
					</td>
				</tr>
			</table>
		</div>
		</form>
	</center>

</body>
</html>
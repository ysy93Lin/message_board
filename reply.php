<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="Css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container">
		<h3 align="center">我的回复</h3><br/>
		<div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-1">
		<form action="action.php?a=reply&message_id=<?php echo $_GET['message_id'];?>" method="post">
			<textarea cols="110" rows="4" name="reply_content" placeholder="留下你的回复吧...." class="form-control"></textarea><br />
			<input type="submit" value="回复" class="btn btn-success">
			<a href="index.php" class="btn btn-default">取消</a>
		</form>
	</div>
</body>
</html>
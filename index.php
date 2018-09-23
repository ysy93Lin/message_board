<?php
	if($_COOKIE['islogin']!=1){
		header("location:login.php");
	}
		
	require("connect.php");
	$username=$_COOKIE['username'];
	$sql_img="select * from user where username='{$username}'";
	$result_img=mysql_query($sql_img);
	$row_img=mysql_fetch_assoc($result_img);
	$imgpath="./img/".$row_img['imgpath'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>留言板</title>
	<link href="Css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="Js/jquery.js"></script>
	<style type="text/css">
		.reply_btn{
			border:none;
			background:none;
			color:#337ab7;
		}
		.reply_btn:hover{
			border:none;
			cursor: pointer;
			text-decoration: underline;
			color: #ba1a09;
		}
	</style>
</head>
<body>
	<div align="right" style="padding:10px 50px;background:#81A849;">
		<h6 style="height:60px;line-height:60px;color:#fff;">欢迎&nbsp;&nbsp;<a href="info.php" target="_blank"><img src="<?php echo $imgpath; ?>" alt="头像" width="60" height="60" class="img-circle"/></a>&nbsp;&nbsp;<a href="info.php" target="_blank" style="color:#fff;"><?php echo $username; ?></a>&nbsp;登录留言板<span>&nbsp;&nbsp;&nbsp;<a href="action.php?a=quit" style="color:#fff;">退出登录</a></span></h6>
	</div>
	<div class="container">
		<h3 align="center">留言板</h3>
		<div class="col-lg-8 col-md-6 col-lg-offset-2 col-md-offset-1">
			<form action="action.php?a=message" method="post">
				<textarea name="message_content" cols="110" rows="5" class="form-control" placeholder="你想说些什么..." required></textarea><br /><br />
				<input type="submit" value="留言" class="btn btn-success">
				<input type="reset" value="取消" class="btn btn-default">
			</form>
		</div>
	</div>
	<br />
		
	<h3 align="center">留言内容</h3>
	<div class="container" style="padding-left:150px;">
		<?php
		//分页的函数
		function news($pageNum=1, $pageSize=5){
		    $array=array();
		    $conn=mysqli_connect("localhost", "root");
		    mysqli_select_db($conn,"message_board");
		    mysqli_set_charset($conn,"utf8");
		    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
		    $rs="select message.*,user.imgpath from message,user where user.id=message.id order by message.message_id limit ".(($pageNum - 1) * $pageSize).",".$pageSize;
		    $r=mysqli_query($conn,$rs);
		    while($obj=mysqli_fetch_object($r)){
		        $array[]=$obj;
		    }
		    mysqli_close($conn,"message_board");
		    return $array;
		}
		 
		//显示总页数的函数
		function allNews(){
		    $conn=mysqli_connect("localhost","root");
		    mysqli_select_db($conn,"message_board");
		    mysqli_set_charset($conn,"utf8");
		    $rs="select count(*) num from message"; //可以显示出总页数
		    $r=mysqli_query($conn, $rs);
		    $obj=mysqli_fetch_object($r);
		    mysqli_close($conn,"message_board");
		    return $obj->num;
		}
	 
	    @$allNum=allNews();
	    @$pageSize=5; //约定没页显示几条信息
	    @$pageNum=empty($_GET["pageNum"])?1:$_GET["pageNum"];
	    @$endPage=ceil($allNum/$pageSize); //总页数
	    @$array=news($pageNum,$pageSize);

		foreach($array as $key=>$values){
			echo "<div style='position:relative;padding-bottom:30px;padding-top:40px;'><img src='./img/{$values->imgpath}' width='60' height='60' class='img-circle' style='float:left;margin-right:20px;'><h4>{$values->message_name}</h4><span style='color:#777;font-size:12px;'>{$values->create_time}</span><div style='width:75%;border:1px dashed #666;margin:10px 0 15px 80px;margin-top:10px;padding:10px 20px;'>{$values->message_content}</div><button href='reply.php?message_id={$values->message_id}' id='btn{$values->message_id}' class='reply_btn' style='position:absolute;left:80px;'>回复</button></div>";  



			if($values->message_name==$username){
					echo "<a href='action.php?a=delete_m&message_id={$values->message_id}' style='position:relative;bottom:30px;left:80%;'>删除</a>";
			}

			echo "<div class='reply{$values->message_id}' style='display:none;width:70%;height:130px;margin-left:10%;margin-top:10px;'>
					<form action='action.php?a=reply&message_id={$values->message_id}' method='post'>
						<textarea name='reply_content' placeholder='留下你的回复吧....' class='form-control'></textarea>
						<div class='reply_act' style='float:right;margin-top:10px'>
						<input type='submit' value='回复' class='btn btn-success'>
						<a href='index.php' class='btn btn-default'>取消</a>
						</div>
					</form>
				</div>";

			echo "<script type='text/javascript'>
					$('#btn{$values->message_id}').click(function(){
						$('.reply{$values->message_id}').toggle();
						history.pushState(null,null,'index.php?message_id={$values->message_id}');
					})
				</script>";

			$sql_r="select reply.*,user.imgpath from reply,user where reply.id=user.id order by reply_id desc";
			$result_r=mysql_query($sql_r);
						
			while($row_r=mysql_fetch_assoc($result_r)){
				if($values->message_id==$row_r['message_id']){		
					echo "<div style='margin-left:80px;padding-bottom:10px;'><img src='./img/{$row_r['imgpath']}' width='60' height='60' class='img-circle' style='float:left;margin-right:20px;'><h5>{$row_r['reply_name']}&nbsp;回复&nbsp;{$row_r['message_name']}</h5><span style='color:#777;font-size:12px;'>{$row_r['create_time']}</span><div style='width:73%;border:1px dashed #666;margin-left:80px;padding:10px 20px;margin-top:10px;'>{$row_r['reply_content']}</div></div>";

					if($row_r['reply_name']==$username){
						echo "<a href='action.php?a=delete_r&reply_id={$row_r['reply_id']}' style='float:right;margin-right:180px;'>删除</a><br />";	
					}
				}
			}
		}
		?>
	</div><br/>
	<div class="text-center">
		<ul class="pagination">
			<li><a href="?pageNum=1">首页</a></li>
			<li><a href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>">上一页</a></li>
			<li><a href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>">下一页</a></li>
			<li><a href="?pageNum=<?php echo $endPage?>">尾页</a></li>
			<li><a href="">共<?php echo $allNum ?>条记录</a></li>
		</ul>
	</div>
	<div> 
</div>
	
	
	
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分页</title>
   <?php
 
//分页的函数
function news($pageNum = 1, $pageSize = 5)
{
    $array = array();
    $coon = mysqli_connect("localhost", "root");
    mysqli_select_db($coon, "shantou");
    mysqli_set_charset($coon, "utf8");
    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
    $rs = "select * from message limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $r = mysqli_query($coon, $rs);
    while ($obj = mysqli_fetch_object($r)) {
        $array[] = $obj;
    }
    mysqli_close($coon,"jereh");
    return $array;
}
 
//显示总页数的函数
function allNews()
{
    $coon = mysqli_connect("localhost", "root");
    mysqli_select_db($coon, "shantou");
    mysqli_set_charset($coon, "utf8");
    $rs = "select count(*) num from message"; //可以显示出总页数
    $r = mysqli_query($coon, $rs);
    $obj = mysqli_fetch_object($r);
    mysqli_close($coon,"jereh");
    return $obj->num;
}
 
    @$allNum = allNews();
    @$pageSize = 3; //约定没页显示几条信息
    @$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
    @$endPage = ceil($allNum/$pageSize); //总页数
    @$array = news($pageNum,$pageSize);
    ?>
</head>
<body>
<table border="1" style="text-align: center" cellpadding="0">
    <tr>
        <td>编号</td>
        <td>新闻标题</td>
        <td>来源</td>
        <td>点击率</td>
        <td>发布日期</td>
    </tr>
    <?php
    foreach($array as $key=>$values){
        echo "<tr>";
        echo "<td>{$values->message_id}</td>";
        echo "<td>{$values->message_content}</td>";
        echo "<td>{$values->create_time}</td>";
        echo "<td>{$values->id}</td>";
        echo "<td>{$values->message_name}</td>";
        echo "</tr>";
    }
    ?>
</table>
<div>
    <a href="?pageNum=1">首页</a>
    <a href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>">上一页</a>
    <a href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>">下一页</a>
    <a href="?pageNum=<?php echo $endPage?>">尾页</a>
 
</div>
 
</body>
</html>
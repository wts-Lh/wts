<?php
$id=@$_GET["id"];
include_once 'ConnectDb.php';
$ndate =date("Y-m-d");
$addnew=@$_POST["addnew"];
if ($addnew=="1" )
{
    $zhanghao=$_POST["zhanghao"];$xingming=$_POST["xingming"];$diqu=$_POST["diqu"];$s2=$_POST["s2"];
    $sql="update user set id='$zhanghao',name='$xingming',pwd='$diqu' where id= ".$id;
    $conn = new ConnectDb();
    $res = $conn->Connect($sql);
    if($res){
        echo "<script>javascript:alert('修改成功!');location.href='yonghuzhuce_list2.php';</script>";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改用户注册</title><link rel="stylesheet" href="css.css" type="text/css"><script language="javascript" src="js/Calendar.js"></script>
</head>

<body>

<?php
$sql="select * from user where id=".$id;
$conn = new ConnectDb();
$result = $conn->Connect($sql);
$res=$result->fetch(PDO::FETCH_ASSOC);
if($res['id'])
{
    ?>
    <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">

            <tr><td>电话：</td><td><input name='zhanghao' type='text'id='zhanghao' value='<?php echo $res['id'];?>' /></td></tr>
            <tr><td>姓名：</td><td><input name='xingming' type='text' id='xingming' value='<?php echo $res['name'];?>' /></td></tr>
            <tr><td>密码：</td><td><input name='diqu' type='text' id='diqu' value='<?php echo $res['pwd'];?>' /></td></tr>

            <tr>
                <td>&nbsp;</td>
                <td><input name="addnew" type="hidden" id="addnew" value="1" />
                    <input type="submit" name="Submit" value="修改" />
                    <input type="reset" name="Submit2" value="重置" /></td>
            </tr>
        </table>
    </form>
    <?php
}
?>
<p>&nbsp;</p>
</body>
</html>


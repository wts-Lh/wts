<?php
session_start();
$_SESSION['ready'] = '';
$ndate =date("Y-m-d");
$addnew=@$_POST["addnew"];
if(!isset($_SESSION['status'])){
    echo "<script>alert('请通过合法途径登录!');window.location.href='start.php';</script>";
}
include_once 'ConnectDb.php';
$con=mysqli_connect("8.136.232.136","root","12345678","wts");
$myid=$_SESSION['id'];
$sql1="select * from user where pos='管理员'";
$res1=mysqli_query($con,$sql1);
$rzt='未查看';

if ($addnew=="1" )
{
    $hb=$_POST["hb"];$nr=$_POST["nr"];
    $sql2="select * from user where name='$hb'";
    $res2=mysqli_query($con,$sql2);
    $arr2 = mysqli_fetch_array($res2,MYSQLI_ASSOC);
    $rsid=$arr2['id'];
    $sql="insert into rep(rid, rsid, rtext, rtime, rzt) values('$myid','$rsid','$nr','$ndate','$rzt') ";
    $conn = new ConnectDb();
    $res = $conn->Connect($sql);
    if($res){
        echo "<script>javascript:alert('添加成功!');location.href='userrep.php';</script>";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title><link rel="stylesheet" href="css.css" type="text/css">
    <script language="javascript" src="js/Calendar.js"></script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <table width="800" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">
        <tr><td>汇报对象：</td>
            <td>
                <select name="hb" >
                    <option>请选择
                        <?php
                        //循环从结果集中取数据
                        while($arr1 = mysqli_fetch_array($res1,MYSQLI_ASSOC)){
                        ?>
                    <option name="hb"><?php echo $arr1['name']?>
                        <?php } ?>
                </select>
            </td>
        </tr>
        <tr><td>内容：</td>
            <td>
                <input name='nr' type='text' id='nr' value='' />
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input name="addnew" type="hidden" id="addnew" value="1" />
                <input type="submit" name="Submit" value="发送" />
                <input type="reset" name="Submit2" value="重置" /></td>
        </tr>
    </table>
</form>

<p>&nbsp;</p>
</body>
</html>

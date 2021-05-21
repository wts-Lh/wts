 <?php
//注销登录
 header("Content-Type: text/html;charset=utf-8");
session_start();
$_SESSION['id']="";
$_SESSION['cx']="";
unset($_SESSION['status']);
unset($_SESSION['ready']);
unset($_SESSION['id']);
unset($_SESSION['cx']);
echo "<script language='javascript'>alert('注销登录成功！');window.location='index.php';</script>";
?>
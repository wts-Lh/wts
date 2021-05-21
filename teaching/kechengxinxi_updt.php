<?php
header("Content-Type: text/html;charset=utf-8");
session_start(); 
$id=@$_GET["id"];
//存储待修改用户id
$_SESSION['id'] = $id;
include_once 'ConnectDb.php';
$ndate =date("Y-m-d");
$addnew=@$_POST["addnew"];
if ($addnew=="1" )
{
	$bianhao=$_POST["bianhao"];$mingcheng=$_POST["mingcheng"];$leibie=$_POST["leibie"];$jianjie=$_POST["jianjie"];
	$sql="update menu set mname='$bianhao',mjiag='$mingcheng',mpenl='$leibie',mjianj='$jianjie' where id= ".$id;
	$conn = new ConnectDb();
  $res = $conn->Connect($sql);
  if($res){
	echo "<script>javascript:alert('修改成功!');location.href='kechengxinxi_list.php';</script>";
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改菜品信息</title><link rel="stylesheet" href="css.css" type="text/css"><script language="javascript" src="js/Calendar.js"></script>
<link rel="stylesheet" type="text/css" href="./webuploader/webuploader.css">
    <script type="text/javascript" src="./webuploader/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="./webuploader/webuploader.js"></script>
</head>
<script language="javascript">
	
	
	function OpenScript(url,width,height)
{
  var win = window.open(url,"SelectToSort",'width=' + width + ',height=' + height + ',resizable=1,scrollbars=yes,menubar=no,status=yes' );
}
	function OpenDialog(sURL, iWidth, iHeight)
{
   var oDialog = window.open(sURL, "_EditorDialog", "width=" + iWidth.toString() + ",height=" + iHeight.toString() + ",resizable=no,left=0,top=0,scrollbars=no,status=no,titlebar=no,toolbar=no,menubar=no,location=no");
   oDialog.focus();
}
</script>
<body>
 <?php
  $sql="select * from menu where id=".$id;
  $conn = new ConnectDb();
  $result = $conn->Connect($sql);
  $res=$result->fetch(PDO::FETCH_ASSOC);
if($res['id'])
{
?>
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse"> 

    <tr><td>编号：</td><td><input name='bianhao' type='text' id='bianhao' value='<?php echo $res['mname'];?>' /></td></tr>
    <tr><td>名称：</td><td><input name='mingcheng' type='text' id='mingcheng'  value='<?php echo $res['mjiag'];?>' /></td></tr>
    <tr><td>老师：</td><td><input name='leibie' type='text' id='leibie' value='<?php echo $res['mpenl'];?>' /></td></tr>
    <tr><td>类型：</td><td><input name='jianjie' type='text' id='jianjie' value='<?php echo $res['mjianj'];?>' /></td></tr>
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


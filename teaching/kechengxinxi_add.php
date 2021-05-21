 <?php
 header("Content-Type: text/html;charset=utf-8");
session_start();
//插入标志
$_SESSION['insert'] = 'ok';
include_once 'ConnectDb.php';
$addnew=@$_POST["addnew"];
if ($addnew=="1" )
{

	$cm=$_POST["cm"];$jg=$_POST["jg"];$pl=$_POST["pl"];$jj=$_POST["jj"];
	$sql="INSERT INTO menu( mname, mjiag, mpenl, mjianj)
            VALUES ('$cm','$jg','$pl','$jj')";
	$conn = new ConnectDb();
    $res = $conn->Connect($sql);
    if($res){
	echo "<script>javascript:alert('添加成功!');location.href='kechengxinxi_add.php';</script>";
   }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>菜品信息</title><script language="javascript" src="js/Calendar.js"></script><link rel="stylesheet" href="css.css" type="text/css">
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
<script language="javascript">
	function check()
{
	if(document.form1.cm.value=="") {
	    alert("请输入菜名");document.form1.cm.focus();return false;}
	else if(document.form1.jg.value=="")
	{alert("请输入价格");document.form1.jg.focus();return false;}
	else if(document.form1.pl.value=="")
	{alert("请输入配料");document.form1.pl.focus();return false;}
    else if(document.form1.jj.value=="")
    {alert("请输入类别");document.form1.jj.focus();return false;}
}
	function gow()
	{
		location.href='peixunccccailiao_add.php?jihuabifffanhao='+document.form1.jihuabifffanhao.value;
	}
</script>
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">    

    <tr><td>菜名：</td><td><input name='cm' type='text' id='cm' value='' size='30' />&nbsp*</td></tr>
    <tr><td>价格：</td><td><input name='jg' type='text' id='jg' value='' size='30' />&nbsp*</td></tr>
    <tr><td>配料：</td><td><input name='pl' type='text' id='pl' value='' size='30' />&nbsp*</td></tr>
    <tr><td>类别：</td><td><input name='jj' type='text' id='jj' value='' size='30' />&nbsp*</td></tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="hidden" name="addnew" value="1" />
        <input type="submit" name="Submit" value="添加" onclick="return check();" />
      <input type="reset" name="Submit2" value="重置" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>


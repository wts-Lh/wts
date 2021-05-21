 <?php 
include_once 'ConnectDb.php';
 $ndate =date("Y-m-d");
 $addnew=@$_POST["addnew"];
 if ($addnew=="1" )
 {
     $zhanghao=$_POST["zhanghao"];$xingming=$_POST["xingming"];
     $diqu=$_POST["diqu"];$mima=$_POST["mima"];
     $sql="insert into student values( id='$zhanghao',sname='$xingming',ssch='$diqu',sfm='$mima') ";
     $conn = new ConnectDb();
     $res = $conn->Connect($sql);
     if($res){
         echo "<script>javascript:alert('添加成功!');location.href='yonghuzhuce_add.php';</script>";
     }
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户注册</title><script language="javascript" src="js/Calendar.js">

    </script><link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>

<form id="form1" name="form1" method="post" action="">
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">
	<tr><td>学号：</td><td><input name='zhanghao' type='text' id='zhanghao' value='' />&nbsp;*</td></tr>
    <tr><td>姓名：</td><td><input name='xingming' type='text' id='xingming' value='' />&nbsp;*</td></tr>
    <tr><td>学校：</td><td><input name='diqu' type="text" id='diqu' value="" />&nbsp;*</td></tr>
    <tr><td>父母：</td><td><input name='mima' type='text' id='mima' value='' />&nbsp;*</td></tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="hidden" name="addnew" value="1" />
        <input type="submit" name="Submit" value="添加" onclick="return check();" />
      <input type="reset" name="Submit2" value="重置" /></td>
    </tr>
  </table>
</form>
</body>
</html>


 <?php 
  session_start();
  $_SESSION['ready'] = '';
  if(!isset($_SESSION['status'])){
      echo "<script>alert('请通过合法途径登录!');window.location.href='start.php';</script>";
  }
include_once 'ConnectDb.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>菜品管理</title><link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>
<p>已录入学生信息列表：</p>
<form id="form1" name="form1" method="post" action="">
  搜索:学校:
  <input name="bh" type="text" id="bh" />
  姓名:
  <input name="mc" type="text" id="mc" />
  <input type="submit" name="Submit" value="查找" />
</form>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">  
  <tr>
    <td width="100" bgcolor="#EBE2FE">学号</td>
    <td width="100" bgcolor='#EBE2FE'>姓名</td>
    <td width="100" bgcolor='#EBE2FE'>学校</td>
    <td width="100" bgcolor='#EBE2FE'>父母</td>
    <td width="100" align="center" bgcolor="#EBE2FE">操作</td>
  </tr>
   <?php
    $sql="select * from student ";
  if (@$_POST["bh"]!="")
{
    $nreqbh=@$_POST["bh"];
    $sql=$sql." where ssch like '%$nreqbh%'";
}
     if (@$_POST["mc"]!="")
{
    $nreqmc=$_POST["mc"];
    $sql=$sql." where sname like '%$nreqmc%'";
}
  $sql=$sql." order by id desc";
  //查询并显示分页
  $con=new ConnectDb();
  @$page=$_GET['page'];
  if(@$page==""){
    $page=1;
  }
  if(@$page!=""){
    $page_size=10;
    $sql1="select count(*) as total from student ";
    $result=$con->Connect($sql1);
    $res=$result->fetch(PDO::FETCH_ASSOC);
    $count=$res['total'];
    $page_count=ceil($count/$page_size);
    $offset=($page-1)*$page_size;
    $sql2=$sql." limit $offset,$page_size";
    $con2=new ConnectDb();
    $result2=$con2->Connect($sql2);
  }

  while($res2=$result2->fetch(PDO::FETCH_ASSOC)){
 ?>
  <tr>
    <td width="25"> <?php echo $res2['id']; ?></td>
    <td> <?php echo $res2['sname'];?></td>
    <td> <?php echo $res2['ssch'];?></td>
    <td> <?php echo $res2['sfm'];?></td>
    <td width="70" align="center"><a href="del.php?id= <?php
    echo $res2['id'];
  ?>
  &tablename=student" onclick="return confirm('真的要删除？')">删除</a>
        <a href="yonghuzhuce_updt.php?id=<?php
          echo $res2['id'];
        ?>">修改</a></td>
  </tr>
     <?php
  }
?>
</table>
<p>以上数据共 <?php
    echo  $count;
  ?>条,
  <input type="button" name="Submit2" onclick="javascript:window.print();" value="打印本页" />
</p>
<p align="center"> <?php echo "<a href='yonghuzhuce_list.php?page=1'>首页</a>&nbsp";     
      if($page!=1){
      $go=$page-1;
      echo "<a  href='yonghuzhuce_list.php?page=$go'>上一页</a>&nbsp";
     }
     for($i=1;$i<=$page_count;$i++){
        echo "<a id='$i' href='yonghuzhuce_list.php?page=$i' value='$i'>$i</a>&nbsp";
     }
      $focus=@$_GET['page'];
     if($page<$page_count){
       $back=$page+1;
      echo "<a href='yonghuzhuce_list.php?page=$back'>下一页</a>&nbsp";
     }
     echo "<a href='yonghuzhuce_list.php?page=$page_count'>尾页</a>&nbsp";?></p>

<p>&nbsp; </p>

</body>
</html>


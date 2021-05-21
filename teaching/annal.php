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
    <title>订单列表</title><link rel="stylesheet" href="css.css" type="text/css">
</head>

<body>

<p>订单列表：</p>
<form id="form1" name="form1" method="post" action="">
    搜索:订单状态:
    <input name="bh" type="text" id="bh" />
    下单学校:
    <input name="mc" type="text" id="mc" />
    <input type="submit" name="Submit" value="查找" />
</form>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">
    <tr>
        <td width="25" bgcolor="#EBE2FE">ID</td>
        <td width="94" bgcolor='#EBE2FE'>套餐id</td>
        <td width="94" bgcolor='#EBE2FE'>下单学校</td>
        <td width="94" bgcolor='#EBE2FE'>下单时间</td>
        <td width="94" bgcolor='#EBE2FE'>配送时间</td>
        <td width="167" bgcolor='#EBE2FE'>订单状态</td>
        <td width="204" bgcolor='#EBE2FE'>订单数量</td>
        <td width="86" bgcolor='#EBE2FE'>所负金额</td>
        <td width="86" bgcolor='#EBE2FE'>留言</td>
        <td width="70" align="center" bgcolor="#EBE2FE">操作</td>
    </tr>
    <?php
    $sql="select * from annal where 1=1 ";
    if (@$_POST["bh"]!="")
    {
        $nreqbh=@$_POST["bh"];
        $sql=$sql." and azt = '$nreqbh'";
    }
    if (@$_POST["mc"]!="")
    {
        $nreqmc=$_POST["mc"];
        $sql=$sql." and asch like '%$nreqmc%'";
    }
    $sql=$sql." order by id desc";
    //查询并显示分页
    $con=new ConnectDb();
    @$page=$_GET['page'];
    if(@$page==""){
        $page=1;
    }
    if(@$page!=""){
        $page_size=6;
        $sql1="select count(*) as total from annal where 1=1";
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
            <td width="25"> <?php
                echo $res2['id'];
                ?></td>
            <td> <?php echo $res2['afengp'];?></td>
            <td> <?php echo $res2['asch'];?></td>
            <td> <?php echo $res2['axtime'];?></td>
            <td> <?php echo $res2['aptime'];?></td>
            <td> <?php echo $res2['azt'];?></td>
            <td> <?php echo $res2['anum'];?></td>
            <td> <?php echo $res2['atotal'];?></td>
            <td> <?php echo $res2['aleaveword'];?></td>
            <td width="70" align="center">
                <a href="annal_list.php?id= <?php
                echo $res2['id'];
                ?>">订单详情</a></td>
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
<p align="center"> <?php echo "<a href='annal.php?page=1'>首页</a>&nbsp";
    if($page!=1){
        $go=$page-1;
        echo "<a  href='annal.php?page=$go'>上一页</a>&nbsp";
    }
    for($i=1;$i<=$page_count;$i++){
        echo "<a id='$i' href='annal.php?page=$i' value='$i'>$i</a>&nbsp";
    }
    $focus=@$_GET['page'];
    if($page<$page_count){
        $back=$page+1;
        echo "<a href='annal.php?page=$back'>下一页</a>&nbsp";
    }
    echo "<a href='annal.php?page=$page_count'>尾页</a>&nbsp";?></p>

<p>&nbsp; </p>

</body>
</html>


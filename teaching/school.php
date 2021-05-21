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
    搜索:
    下单学校:
    <input name="mc" type="text" id="mc" />
    <input type="submit" name="Submit" value="查找" />
</form>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">
    <tr>

        <td width="94" bgcolor='#EBE2FE'>下单学校</td>
        <td width="204" bgcolor='#EBE2FE'>下单次数</td>
        <td width="204" bgcolor='#EBE2FE'>订单数量</td>
        <td width="86" bgcolor='#EBE2FE'>所负金额</td>
        <td width="70" align="center" bgcolor="#EBE2FE">操作</td>
    </tr>
    <?php
    $con=new ConnectDb();
    $sql="select asch  from annal where 1=1 ";
    if (@$_POST["mc"]!="")
    {
        $nreqmc=$_POST["mc"];
        $sql=$sql." and asch like '%$nreqmc%'";
    }
    $sql=$sql." group by asch ";
    //查询并显示分页

    $sql5="select  asch ,count(asch) as a  from annal group by asch ";
    $result5=$con->Connect($sql5);
    $res5=$result5->fetch(PDO::FETCH_ASSOC);
    $count=$res5['a'];
    @$page=$_GET['page'];
    if(@$page==""){
        $page=1;
    }
    if(@$page!=""){
        $page_size=6;
        $sql1="select id,count(*) as total from annal where 1=1";
        $result=$con->Connect($sql1);
        $res=$result->fetch(PDO::FETCH_ASSOC);
        $page_count=ceil($count/$page_size);
        $offset=($page-1)*$page_size;
        $sql2=$sql." limit $offset,$page_size";
        $con2=new ConnectDb();
        $result2=$con2->Connect($sql2);
    }

    while($res2=$result2->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td width="25">
                <?php echo $res2['asch']?>
            </td>
            <td width="25"> <?php
                $sql1="select count(*) as cs from annal where asch='".$res2['asch']."'";
                $result1=$con->Connect($sql1);
                $res1=$result1->fetch(PDO::FETCH_ASSOC);
                echo $res1['cs'];
                ?>
            </td>
            <td width="25"> <?php
                $sql3="select sum(anum) as num from annal where asch='".$res2['asch']."'";
                $result3=$con->Connect($sql3);
                $res3=$result3->fetch(PDO::FETCH_ASSOC);
                echo $res3['num'];
                ?>
            </td>
            <td width="25"> <?php
                $sql4="select sum(atotal) as ato from annal where asch='".$res2['asch']."'";
                $result4=$con->Connect($sql4);
                $res4=$result4->fetch(PDO::FETCH_ASSOC);
                echo $res4['ato'];
                ?>
            </td>
            <td width="70" align="center">
                <?php
                $sql4="select id  from annal where asch='".$res2['asch']."'";
                $result4=$con->Connect($sql4);
                $res4=$result4->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="school_list.php?id= <?php echo $res4['id']; ?>">订单详情</a></td>
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
<p align="center"> <?php echo "<a href='school.php?page=1'>首页</a>&nbsp";
    if($page!=1){
        $go=$page-1;
        echo "<a  href='school.php?page=$go'>上一页</a>&nbsp";
    }
    for($i=1;$i<=$page_count;$i++){
        echo "<a id='$i' href='school.php?page=$i' value='$i'>$i</a>&nbsp";
    }
    $focus=@$_GET['page'];
    if($page<$page_count){
        $back=$page+1;
        echo "<a href='school.php?page=$back'>下一页</a>&nbsp";
    }
    echo "<a href='school.php?page=$page_count'>尾页</a>&nbsp";?></p>

<p>&nbsp; </p>

</body>
</html>


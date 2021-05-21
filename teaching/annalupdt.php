<?php
$id=@$_GET["id"];
include_once 'ConnectDb.php';
$ndate =date("Y-m-d");
$addnew=@$_POST["addnew"];
$con=mysqli_connect("8.136.232.136","root","12345678","wts");
if ($addnew=="1" )
{
    $zw=$_POST['zw'];$zt=$_POST['zt'];
    $sql="update annal set achus='$zw',apenc='$zt' where id= ".$id;
    $conn = new ConnectDb();
    $res = $conn->Connect($sql);
    if($res){
        echo "<script>javascript:alert('订单分配成功!');location.href='annal_updt.php';</script>";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改员工信息</title><link rel="stylesheet" href="css.css" type="text/css"><script language="javascript" src="js/Calendar.js"></script>
</head>

<body>

<?php
$sql1="select * from user where pos='厨师'";
$result1=mysqli_query($con,$sql1);
$sql2="select * from user where pos='配送员'";
$result2=mysqli_query($con,$sql2);
if($result1)
{
    ?>
    <form id="form1" name="form1" method="post" action="">
        <table width="750" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">
            <tr><td>厨师：</td>
                <td>
                    <select name="zw" >
                        <option>请选择
                            <?php
                            //循环从结果集中取数据
                            while($res1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                            ?>
                        <option name="zw"><?php echo $res1['name']?>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr><td>配送员：</td>
                <td>
                    <select name="zt" >
                        <option>请选择
                            <?php
                            //循环从结果集中取数据
                            while($res2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                            ?>
                        <option name="zt"><?php echo $res2['name']?>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>确定修改员工信息吗</td>
                <td><input name="addnew" type="hidden" id="addnew" value="1" />
                    <input type="submit" name="Submit" value="确定" />
            </tr>
        </table>
    </form>
    <?php
}
?>
<p>&nbsp;</p>
</body>
</html>

x`
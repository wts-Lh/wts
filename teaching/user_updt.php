<?php
$id=@$_GET["id"];
include_once 'ConnectDb.php';
$ndate =date("Y-m-d");
$addnew=@$_POST["addnew"];
if ($addnew=="1" )
{
    $zh=$_POST['zh'];$xm=$_POST['xm'];$zw=$_POST['zw'];$zt=$_POST['zt'];
    $sql="update user set id='$zh', name='$xm', pos='$zw', zt='$zt' where id= ".$id;
    $conn = new ConnectDb();
    $res = $conn->Connect($sql);
    if($res){
        echo "<script>javascript:alert('员工修改成功!');location.href='user_list.php';</script>";
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
$sql="select * from user where id=".$id;
$conn = new ConnectDb();
$result = $conn->Connect($sql);
$res=$result->fetch(PDO::FETCH_ASSOC);
if($res['id'])
{
    ?>
    <p>修改员工信息</p>
    <form id="form1" name="form1" method="post" action="">
        <table width="750" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">

            <tr><td>电话：</td><td><input name='zh' type='text'id='zh' value='<?php echo $res['id'];?>' /></td></tr>
            <tr><td>姓名：</td><td><input name='xm' type='text' id='xm' value='<?php echo $res['name'];?>' /></td></tr>
            <tr><td>职位：</td>
                <td><select name='zw' id='zw'>
                        <option value="<?php echo $res['pos'];?>"><?php echo $res['pos'];?></option>
                        <option value="管理员">管理员</option>
                        <option value="员工">员工</option>
                    </select>
                </td>
            </tr>
            <tr><td>状态：</td>
                <td><select name='zt' id='zt'>
                        <option value="<?php echo $res['zt'];?>"><?php echo $res['zt'];?></option>
                        <option value="入职">入职</option>
                        <option value="未入职">未入职</option>
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


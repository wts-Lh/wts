<?php
header('Content-type:text/html; charset=utf-8');
$con=mysqli_connect("8.136.232.136","root","12345678","wts");
$sql1 = "SELECT * FROM menu where mjianj='素菜' ";
$sql2 = "SELECT * FROM menu where mjianj='荤菜' ";
$sql3 = "SELECT * FROM menu where mjianj='配菜' ";
$sql4 = "SELECT * FROM menu where mjianj='辅食' ";
if (mysqli_connect_errno($con))
{
    echo "连接 MySQL 失败: " . mysqli_connect_error();
}
//获取时间
$ftime='';
if(isset($_GET['id'])){
    $ftime = $_GET['id'];
}
// 执行查询食物表
$result1=mysqli_query($con,$sql1);
$result2=mysqli_query($con,$sql2);
$result3=mysqli_query($con,$sql3);
$result4=mysqli_query($con,$sql4);
if(isset($_POST['tj'])){

    $su = $_POST["su"];
    $hun = $_POST["hun"];
    $pei = $_POST["pei"];
    $fu = $_POST["fu"];
    //判定菜单是否已存在
    $sql5="SELECT * FROM fengp where ftime='$ftime' ";
    $ret5 =mysqli_query($con, $sql5);
    $arr5 = mysqli_fetch_array($ret5,MYSQLI_ASSOC);
    $res5 = mysqli_num_rows($ret5);
    if($res5){
        $sql6 = "update fengp set fsu='$su',fhun='$hun',fpei='$pei',ffu='$fu' where ftime='$ftime'";
        $ret6 = mysqli_query($con, $sql6);
        echo "<script>javascript:alert('更新成功!');location.href='fenpg_list.php';</script>";

    }else{
        $sql7 = "insert into fengp(ftime, fsu, fhun, fpei, ffu) values('$ftime','$su','$hun','$pei','$fu')";
        $ret7 = mysqli_query($con, $sql7);
        echo "<script>javascript:alert('添加成功!');location.href='fenpg_list.php';</script>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加菜单</title>
</head>
<style>
    select{
        width: 80px;
        border: 0;
        background: transparent;
        /*!*appearance:none;*!去小三角*/
        /*-moz-appearance:none;*/
        /*-webkit-appearance:none;*/
        outline:none
    }
</style>
<body>

<form action="" method="post">
    <table width="600" border="1" bordercolor="#ccc" align="center" rules="all" cellpadding="5">
        <tr bgcolor='#f0f0f0'>
            <th>时间</th>
            <th>素菜</th>
            <th>荤菜</th>
            <th>配菜</th>
            <th>辅食</th>
            <th>操作</th>
        </tr>

        <tr align="center">
            <td>
                <?php
                echo $ftime;
                ?>
            </td>
            <td>
                <select name="su" >
                    <option>请选择
                        <?php
                        //循环从结果集中取数据
                        while($arr1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                        ?>

                    <option name="sucai"><?php echo $arr1['mname']?>
                        <?php } ?>
                </select>
            </td>

            <td>
                <select name="hun" >
                    <option>请选择
                        <?php
                        //循环从结果集中取数据
                        while($arr2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                        ?>
                    <option name="sucai"><?php echo $arr2['mname']?>
                        <?php } ?>
                </select>
            </td>

            <td>
                <select name="pei" >
                    <option>请选择
                        <?php
                        //循环从结果集中取数据
                        while($arr3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
                        ?>
                    <option name="sucai"><?php echo $arr3['mname']?>
                        <?php } ?>
                </select>
            </td>

            <td>
                <select name="fu" >
                    <option>请选择
                        <?php
                        //循环从结果集中取数据
                        while($arr4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                        ?>
                    <option name="sucai"><?php echo $arr4['mname']?>
                        <?php } ?>
                </select>
            </td>

            <td colspan="3" align="center"  >
                <input type="submit" name="tj" value="提交">&nbsp;&nbsp;
                <input type="reset" name="reset" value="重置"></td>
        </tr>

    </table>
</form>
</body>
</html>
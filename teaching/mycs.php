<?php
session_start();
$_SESSION['ready'] = '';
if(!isset($_SESSION['status'])){
    echo "<script>alert('请通过合法途径登录!');window.location.href='start.php';</script>";
}
include_once 'ConnectDb.php';
header('Content-type:text/html; charset=utf-8');
$con=mysqli_connect("8.136.232.136","root","12345678","wts");

    $year = date ( 'Y' );   //获得年份
    $month = date ( 'n' );  //获得月份
    $day = date ( 'j' );    //获得日期


if(isset($_GET['sm'])){
    $month=$_GET['sm'];
    if($month==0){
        $month=12;
        $year=$year-1;
    }
}

if(isset($_GET['xm'])){
    $month=$_GET['xm'];
    if($month==13){
        $month=1;
        $year=$year+1;
    }
}
$counter='';
$firstDay = date ( "w", mktime ( 0, 0, 0, $month, 1, $year ) );
//获得当月第一天
$daysInMonth = date ( "t", mktime ( 0, 0, 0, $month, 1, $year ) );
//获得当月的总天数
//echo $daysInMonth;
$tempDays = $firstDay + $daysInMonth;   //计算数组中的日历表格数
$weeksInMonth = ceil ( $tempDays/7 );   //算出该月一共有几周（即表格的行数）
//创建一个二维数组
for($j = 0; $j < $weeksInMonth; $j ++) {
    for($i = 0; $i < 7; $i ++) {
        $counter ++;
        $week [$j] [$i] = $counter;
        //offset the days
        $week [$j] [$i] -= $firstDay;
        if (($week [$j] [$i] < 1) || ($week [$j] [$i] > $daysInMonth)) {
            $week [$j] [$i] = "";
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>菜单管理</title><link rel="stylesheet" href="css.css" type="text/css">
    <script type="text/javascript">

        function confirmDel(id) {

            if(window.confirm("你要修改菜单吗？")) {
                //如果单击"确定"，跳转到fengpa.php页面
                location.href = "./fengpa.php?id="+id;
            }
        }
    </script>
</head>

<body>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#6699CC" style="border-collapse:collapse">
    <tr>
        <th colspan='1'><a href="mycs.php?sm=<?php
            echo $month-1;
            ?>
            ">上个月</a></th>
        <th colspan='5'><?php
            echo date ( 'M', mktime ( 0, 0, 0, $month, 1, $year ) ) . ' ' . $year;
            ?>
        </th>
        <th colspan='1'><a href="mycs.php?xm=<?php
            echo $month+1;
            ?>
            ">下个月</a></th>
    </tr>
    <tr>
        <th>星期日</th>
        <th>星期一</th>
        <th>星期二</th>
        <th>星期三</th>
        <th>星期四</th>
        <th>星期五</th>
        <th>星期六</th>
    </tr>
    <?php
    $w=0;
    $h=0;
    foreach ( $week as $key => $val ) {
        echo "<tr>";
        for($i = 0; $i < 7; $i ++) {
            if($val[$i]==''){
                $h++;
                echo "<td height='80px' align='center'>" . $val [$i] . "</td>";
            }
            else{
                $d=$w*7+$i+1-$h;
                $e=$year.'-'.$month.'-'.$d;
                $result1=mysqli_query($con,"SELECT * FROM fengp where ftime='$e'");
                $records = mysqli_num_rows($result1);
                $arr1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
                if($records){
                    ?>
                    <td height='80px'>
                        <a href="fengpa.php?id=<?php echo $e; ?>">
                            <?php echo $val [$i]."<br>".$arr1['fsu']."<br>".$arr1['fhun']."<br>".$arr1['fpei']."<br>".$arr1['ffu']."<br>"?>
                        </a>
                    </td>
                    <?php
                }else{
                    ?>
                    <td height='80px'>
                        <a href="fengpa.php?id=<?php echo $e; ?>">
                            <?php echo $val [$i]; "<br>"?>
                        </a>
                    </td>
                    <?php
                }
            }
        }
        echo "</tr>";
        $w++;
    }
    ?>
</body>
</html>
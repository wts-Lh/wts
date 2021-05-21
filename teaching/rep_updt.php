<?php
$id=@$_GET["id"];
include_once 'ConnectDb.php';
$ndate =date("Y-m-d");
$addnew=@$_POST["addnew"];

$sql="update rep set rzt='已查看' where id= ".$id;
$conn = new ConnectDb();
$res = $conn->Connect($sql);
if($res){
    echo "<script>javascript:alert('已确认查收!');location.href='rep.php';</script>";
}
?>

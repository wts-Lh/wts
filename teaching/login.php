 <?php
//验证登陆信息
 header("Content-Type: text/html;charset=utf-8");
session_start();
include_once 'ConnectDb.php';
if(@$_SESSION['ready']){
	//if($_POST['submit']){
	@$login = $_POST["login"];
	$id = $_POST['id'];
	$pwd = $_POST['pwd'];
	//$userpass=md5($userpass);
	//创建pdo连接类
	$conn = new ConnectDb();
	if($login == "2")
	{   
		if ($id!="" && $pwd!="")
		{
		$sql = "select * from user where id='$id' and pwd='$pwd' and pos='员工'";
		$result = $conn->Connect($sql);
        $res = $result->fetch(PDO::FETCH_ASSOC);	
			if($res['id'])
			{
			        $_SESSION['id']=$id;
					$_SESSION['cx'] = "员工";
					//$row = mysql_fetch_row($query)
					//echo $_SESSION['cx'];
					//注销session
					$_SESSION['status'] = 'ok';
					echo "<script language='javascript'>alert('登陆成功！');location='student.php';</script>";
			}
			else
			{       $_SESSION['ready'] = '';
					echo "<script language='javascript'>alert('用户名或密码错误！');history.back();</script>";
			}
		}
		else
		{       $_SESSION['ready'] = '';
				echo "<script language='javascript'>alert('请输入完整！');history.back();</script>";
		}
	}
	if($login=="3")
	{
		if ($id!="" && $pwd!="")
		{
		$pos = '管理员';
		$sql="select * from user where id='$id' and pwd='$pwd' and pos='$pos'";
		$result=$conn->Connect($sql);
        $res=$result->fetch(PDO::FETCH_ASSOC);
			if($res['id'])
			{
					$_SESSION['id']=$id;
					$_SESSION['cx']="管理员";
					//$row = mysql_fetch_row($query)
					//echo $_SESSION['cx'];
					$_SESSION['status'] = 'ok';
					echo "<script language='javascript'>alert('登陆成功！');location='admin.php';</script>";
			}
			else
			{
					echo "<script language='javascript'>alert('用户名或密码错误！');history.back();</script>";
			}
		}
		else
		{
				echo "<script language='javascript'>alert('请输入完整！');history.back();</script>";
		}
	}
//}

}else{
	echo "<script language='javascript'>alert('请通过合法途径登录！');history.back();</script>";
}

?>
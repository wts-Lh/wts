 <?php
//验证登陆信息
 header("Content-Type: text/html;charset=utf-8");
session_start();
include_once 'conn.php';
//if($_POST['submit']){
	
	$username=$_POST['username'];
	$pwd=$_POST['pwd1'];
	$cx=$_POST['cx'];
	//$userpass=md5($userpass);

		if ($username!="" && $pwd!="")
		{
		$sql="select * from 153111040yonghuzhuce where zhanghao='$username' and mima='$pwd' and issh='是' and cx='$cx'";
		
		$query=mysql_query($sql);
		$rowscount=mysqli_num_rows($query);
			if($rowscount>0)
			{
					$_SESSION['username']=$username;
					$_SESSION['cx']=$cs;
					$_SESSION['xm']=mysql_result($query,$i,xingming);
					$_SESSION['zp']=mysql_resulti($query,$i,zhaopian);
					//$row = mysql_fetch_row($query)
					//echo $_SESSION['cx'];
					echo "<script language='javascript'>alert('登陆成功！');location='index.php';</script>";
			}
			else
			{
					echo "<script language='javascript'>alert('用户名或密码错误！或您的帐号未经审核');history.back();</script>";
			}
		}
		else
		{
				echo "<script language='javascript'>alert('请输入完整！');history.back();</script>";
		}
	
	
//}
?>
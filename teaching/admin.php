<?php
header("Content-Type: text/html;charset=utf-8");
  session_start();
  $_SESSION['ready'] = '';
  if(!isset($_SESSION['status'])){
      echo "<script>alert('请通过合法途径登录!');window.location.href='start.php';</script>";
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>teacher</title>
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<link href="css/index.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="top">
			<h2>基于PHP的通用配餐管理系统</h2>
			<div class="t_right">
					<span> 权限：<?php  echo $_SESSION['cx'];?>  </span>
				<span><a href="logout.php" target="_parent">退出</a></span>
				
			</div>
		</div>
		<div id="left">
			<ul>
				<li class="leftmenu"><a href="#">订单信息</a>
					<ul>
                        <li><a href=annal.php target=link>订单信息</a></li>
                        <li><a href=school.php target=link>订单分析</a></li>

					</ul>
				</li>
                <li class="leftmenu"><a href="#">工作管理</a>
                    <ul>
                        <li><a href=annal_updt.php target=link>工作分配</a></li>
                        <li><a href="rep.php" target="link">汇报信息</a></li>

                    </ul>
                </li>
				 
			 	<li class="leftmenu"><a href="#">用户信息</a>
					<ul>
						<li><a href=yonghuzhuce_list2.php target=link>用户管理</a></li>
                        <li><a href=yonghuzhuce_list.php target=link>学生管理</a></li>
                        <li><a href=yonghuzhuce_add.php target=link>学生添加</a></li>
                        <li><a href=studentadd.php target=link>导入学生信息</a></li>
					</ul>
				</li>

				<li class="leftmenu"><a href="#">菜品管理</a>
					<ul>
						<li><a href="kechengxinxi_add.php" target="link">菜品添加</a></li>
						<li><a href="kechengxinxi_list.php" target="link">菜品管理</a></li>
                        <li><a href="fenpg_list.php" target="link">菜单管理</a></li>
					</ul>
				</li>
                <li class="leftmenu"><a href="#">员工管理</a>
                    <ul>
                        <li><a href="newuser_add.php" target="link">入职审核</a></li>
                        <li><a href="user_list.php" target="link">员工信息</a></li>
                        <li><a href="usermy.php" target="link">个人信息</a></li>
                        <li><a href="rep.php" target="link">汇报信息</a></li>
                        <li><a href="mod.php" target="link">测试</a></li>
                    </ul>
                </li>
			</ul>
		</div>
		<div id="right">
			<iframe name="link" width="100%" height="500px" frameborder="0" src="main.html"></iframe>
		</div>
	</body>
</html>

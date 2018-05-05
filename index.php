<?
include('config.php');
$form=$_GET['form'];
$module=$_GET['module'];
$login=$_POST['login'];
$password=$_POST['password'];
$exit=$_GET['exit'];
if(!$form){
	$form=1;
}
if($exit==1 && $_SESSION['permission']){
	session_destroy();
	header('location: ?module=0');
	exit;
}

require_once("classes/User.php");

require_once("classes/GlobalAdmin.php");

require_once("classes/SchoolAdmin.php");

require_once("classes/Teacher.php");

require_once("classes/ClassRoom.php");

$userClass = new User();
$userClass->auth($login,$password);

$globalAdminClass = new GlobalAdmin();

$schoolAdminClass = new SchoolAdmin();

$teacherClass = new Teacher();

$classRoomClass = new ClassRoom();

switch($_SESSION['permission']){//отображение контента
	case 1: //пользователь глобальный администратор
		require_once("permissions/GlobalAdmin.php");
	break;
	case 2: //пользователь администратор школы
		require_once("permissions/SchoolAdmin.php");
	break;
	case 3: //пользователь классный руководитель учитель
		require_once("permissions/Teacher.php");
	break;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Моя школа</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script> 

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<div class="center-block">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Моя школа</a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li<?if(!$module){echo " class=\"active\"";}?>><a href="?module=0">Главная <span class="sr-only">(current)</span></a></li>
							<li<?if($module==1){echo " class=\"active\"";}?>><a href="?module=1">Журнал</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
						<?if($_SESSION['permission']){?>
							<li class="pull-right"><a href="?exit=1">Выйти</a></li>
						<?}?>
						</ul>
					</div>
				</div>
			</nav>
			<?if($_SESSION['msg']){?>
			<div class="alert alert-dismissible alert-<?=$_SESSION['msg_status']?>">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?=$_SESSION['msg']; $_SESSION['msg']="";?>
			</div>
			<?}?>
			<?
			if(!$_SESSION['permission']){
				include('autoriz.php');
			}
			else{
				include('home.php');
			}
			?>
		</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
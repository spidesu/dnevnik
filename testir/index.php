<?
include('config.php');
$form=$_GET['form'];
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Тест</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body>
		<?
		switch($form){
			case 1: include('list_tests.php'); break;
			case 2: include('edit_test.php'); break;
			case 3: include('edit_test.php'); break;
			case 4: include('edit_question_test.php'); break;
			default: include('list_tests.php'); break;
		}
		?>
	</body>
</html>
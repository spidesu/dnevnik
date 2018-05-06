<?
switch($form){
	case 4:
		$id = $_GET['id'];
		if($id){
			$sql = "DELETE FROM circles WHERE id={$id}";
			$link->exec($sql);
			header('location: ?module=1&form=4');
		}
	break;
	case 5:
		$name = $_POST['name'];
		$time = $_POST['time'];
		$days = $_POST['days'];
		$adress = $_POST['adress'];
		$id_student = $_SESSION['id_student'];
		if($name != "" && $time && $id_student){
			$name = $link->quote($name);
			$time = $link->quote($time);
			$adress = $link->quote($adress);
			foreach($days as $day){
				$str_days .= $day.", ";
			}
			$str_days = $link->quote(substr($str_days, 0 , -2));
			$id_student = $link->quote($id_student);
			$sql = "INSERT INTO circles(name, times, id_student, days, adress) VALUES ($name, $time, $id_student, $str_days, $adress)";
			$link->exec($sql);
			header('location: ?module=1&form=4');
		}
	break;
}
?>
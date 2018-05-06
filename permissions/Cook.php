<?
switch($form){
	case 1: break;
	case 2: 
		
		if($_POST['meal']){
			foreach($_POST['meal'] as $meal){
				$menu[]=$meal;
			}
			$json = json_encode($menu,JSON_UNESCAPED_UNICODE);
			$json=$link->quote($json);
			$data=$link->quote($_POST['date_menu']);
			$sql="INSERT INTO cook_menu(json_menu,data,id_school) values ($json,$data,{$_SESSION['id_school']})";
			$link->exec($sql);
			//header('location:?module=2&form=2');
			//exit;
		}
		if($_GET['id_del']){
			$sql="DELETE FROM cook_menu WHERE id={$_GET['id_del']}";
			$link->exec($sql);
			header('location:?module=2&form=2');
		}

	break;
}
?>
<?
if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<h3>Список кружков</h3>
<table class="table">
	<tr>
		<th>Кружок</th>
		<th>Время проведения</th>
		<th>Дни проведения</th>
		<th>Место проведения</th>
		<th>Действие</th>
	</tr>
	<?
		$id_student = $_SESSION['id_student'];
	
		if(!$_SESSION['id_student']) $id_student = $_GET['id_student'];
		$sql = "SELECT id, name, times, id_student, days, adress FROM circles WHERE id_student=$id_student";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "
			<tr>
				<th>{$row['name']}</th>
				<th>{$row['times']}</th>
				<th>{$row['days']}</th>
				<th>{$row['adress']}</th>
				<th><a href='?module=1&form=4&id=$row[id]'>Удалить</a></th>
			</tr>";

				
		}
	?>
</table>
<?if($_SESSION['permission'] == 5){?><a href="?module=1&form=5&id_student=<?=$id_student?>">Добавить кружок</a><?}?>
<?if($_SESSION['permission'] == 3){?><a href="?module=1&form=16&id_student=<?=$id_student?>">Добавить кружок</a><?}?>
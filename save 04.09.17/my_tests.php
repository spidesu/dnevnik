<table border="1">
<?
	$sql="SELECT name_test, count_questions, status_test FROM tests WHERE id_teacher={$_SESSION['id_teacher']}";
	$res=$link->query($sql);
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		if($row['status_test']==1){
			$status="Активный";
		}
		echo <<<txt
			<tr>
				<td>{$row['name_test']}</td>
				<td>Количество вопросов: {$row['count_questions']}</td>
				<td>$status</td>
				<td>Редактировать</td>
			</tr>
txt;
	$status="Не активный";
	}
?>
</table>
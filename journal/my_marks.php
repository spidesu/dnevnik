<table class="table">
<?
	$sql="SELECT m.mark, m.date, m.description, ut.name name_teacher, l.name name_lesson FROM marks m 
	JOIN users_teachers ut ON ut.id=m.id_teacher 
	JOIN lessons l ON l.id=m.id_lesson  
	WHERE m.id_student={$_SESSION['id_student']}";
	$res=$link->query($sql);
	$res1=$link->query($sql);$row1=$res1->fetch(PDO::FETCH_ASSOC);
	if(!$row1['mark']){
		echo "У вас еще нет оценок";
	}
	else{
		?>
		<tr>
			<th>Оценка</th>
			<th>Тема</th>
			<th>Учитель</th>
			<th>Урок</th>
			<th>Дата</th>
		</tr>
		<?
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo <<<txt
				<tr>
					<td>{$row['mark']}</td>
					<td>{$row['description']}</td>
					<td>{$row['name_teacher']}</td>
					<td>{$row['name_lesson']}</td>
					<td>{$row['date']}</td>
				</tr>
txt;
		}
	}
	
?>
</table>

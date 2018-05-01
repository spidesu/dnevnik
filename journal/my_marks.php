<head>
 <style type="text/css">
   a.disabled {
    cursor: default; 
    color: #000;
   }
   </style>
</head>
<table class="table">
		<tr>
			<th>Предмет</th>
			<th>Оценки</th>
		</tr>
<?

	$sql2 = "SELECT DISTINCT l.id,l.name FROM lessons l JOIN marks m ON l.id=m.id_lesson WHERE m.id_student={$_SESSION['id_student']}";
	$lessons=$link->query($sql2);

	while($lesson_row=$lessons->fetch(PDO::FETCH_ASSOC)){
	$sql1="SELECT m.mark, m.date, m.description, l.name name_lesson, t.name name_teacher FROM marks m 
	JOIN lessons l ON l.id=m.id_lesson
	JOIN users_teachers t ON m.id_teacher=t.id  
	WHERE m.id_student={$_SESSION['id_student']} AND m.id_lesson={$lesson_row['id']}";
	$res=$link->query($sql1);
	$res1=$link->query($sql1);$row1=$res1->fetch(PDO::FETCH_ASSOC);

		?>
	
		<?
	
			echo "
				<tr>
					<td>{$lesson_row['name']}</td><td>";
						while($row=$res->fetch(PDO::FETCH_ASSOC)){
						echo "
					<a href='#' class='disabled' title='Тема: {$row['description']}, Преподаватель: {$row['name_teacher']}'>{$row['mark']}</a>";}
					echo "
				</td></tr>";

		
	}

	
	
?>
</table>

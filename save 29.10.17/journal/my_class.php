<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<h2>Мой класс</h2>
<div class="col-xs-12 col-sm-4">
<?
if($_SESSION['permission']==3){
	$sql="SELECT id, id_teacher, number_class, leter_class FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
	$res=$link->query($sql);
	$row=$res->fetch(PDO::FETCH_ASSOC);
	if($row['id']){
		$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
		$res=$link->query($sql);
		$row1=$res->fetch(PDO::FETCH_ASSOC);
		$id_class=$link->quote($row1['id']);
		$sql="SELECT id FROM schedule WHERE id_class=$id_class";
		$res=$link->query($sql);
		$row2=$res->fetch(PDO::FETCH_ASSOC);
		if(!$row2['id']){
			echo "<a href='?form=8'>Составить расписание</a><br>";
		}
		else{
			echo "<a href='?form=8'>Редактировать расписание</a><br>";
			$day=1;
			$lesson=1;?>
			<table border="1">
			<?while($day<=7){?>
			<tr>
				<td>
					День <?=$day?>
				</td>
				<td>
				<?while($lesson<=6){?>
						<?
							$sql="SELECT id_lesson, number_lesson, day FROM schedule WHERE id_class=$id_class";
							$res=$link->query($sql);
							while($row1=$res->fetch(PDO::FETCH_ASSOC)){
								if($row1['number_lesson']==$lesson and $row1['day']==$day){
									$sql="SELECT name FROM lessons WHERE id={$row1['id_lesson']}";
									$res=$link->query($sql);
									$row3=$res->fetch(PDO::FETCH_ASSOC);
									echo $row3['name'];
									if($row1['id_lesson']==0){
										echo "Нет урока";
									}
								}
								
							}
						?><br>
				
				<?$lesson++;}?>
				</td>
			</tr>
			<?
			$lesson=1;
			$day++;
			}
			?>
			</table>
			
			<?
		}
		echo "{$row['number_class']}<sup>{$row['leter_class']}</sup>";
		echo "<br>Список класса<br>";
		$id_class=$row['id'];
		$sql="SELECT id, name FROM users_students WHERE id_class=$id_class";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<b>{$row['name']}</b><br>";
		}
		echo "Новости класса<br>";
		$sql="SELECT id, header, new, autor, date, id_class FROM news_classes WHERE id_class=$id_class";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo $row['header']."<br>";
			echo $row['new']."<br>";
			$sql="SELECT id, name FROM users_teachers WHERE id={$row['autor']}";
			$res=$link->query($sql);
			$row_teach=$res->fetch(PDO::FETCH_ASSOC);
			echo $row_teach['name']."<br>";
			echo $row['date']."<br>";
		}
		echo "Учителя:<br>";
		$id_class_sql=$link->quote($id_class);
		$sql="SELECT ltc.id id_ltc, ltc.id_teacher, ut.name, l.name lesson_name FROM lesson_teacher_class ltc 
		JOIN users_teachers ut ON ut.id=ltc.id_teacher 
		JOIN lessons l ON l.id=ltc.id_lesson 
		WHERE id_class=$id_class";
		$res=$link->query($sql);
		echo "<table border='1'>";
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<tr>";
				echo "<td>";
					echo $row['name'];
				echo "</td>";
				echo "<td>";
					echo $row['lesson_name'];
				echo "</td>";
				echo "
				<td>
					<a href='?form=2&del={$row['id_ltc']}'>Удалить</a>
				</td>
				";
			echo "</tr>";
		}
		echo "</table>";
	}
	else{
		echo "У вас еще нет класса. Обратитесь к модератору, если произошла ошибка.";
	}
	
}
elseif($_SESSION['permission']==4){
	$id_class=$link->quote($_SESSION['id_class']);
	$sql="SELECT id, id_teacher, number_class, leter_class FROM classes WHERE id=$id_class";
	$res=$link->query($sql);
	$row=$res->fetch(PDO::FETCH_ASSOC);
	if($row['id']){
		$id_class=$row['id'];
		echo "Классный руководитель: ";
		$sql="SELECT name FROM users_teachers WHERE id={$row['id_teacher']}";
		$res=$link->query($sql);
		$row2=$res->fetch(PDO::FETCH_ASSOC);
		echo "<b>{$row2['name']}</b><br>";
		$sql="SELECT id FROM schedule WHERE id_class=$id_class";
		$res=$link->query($sql);
		$row2=$res->fetch(PDO::FETCH_ASSOC);
		if(!$row2['id']){
			echo "Расписание еще не составленно<br>";
		}
		else{
			$day=1;
			$lesson=1;?>
			<table border="1">
			<?while($day<=7){?>
			<tr>
				<td>
					День <?=$day?>
				</td>
				<td>
				<?while($lesson<=6){?>
						<?
							$sql="SELECT id_lesson, number_lesson, day FROM schedule WHERE id_class=$id_class";
							$res=$link->query($sql);
							while($row1=$res->fetch(PDO::FETCH_ASSOC)){
								if($row1['number_lesson']==$lesson and $row1['day']==$day){
									$sql="SELECT name FROM lessons WHERE id={$row1['id_lesson']}";
									$res=$link->query($sql);
									$row3=$res->fetch(PDO::FETCH_ASSOC);
									echo $row3['name'];
									if($row1['id_lesson']==0){
										echo "Нет урока";
									}
								}
								
							}
						?><br>
				
				<?$lesson++;}?>
				</td>
			</tr>
			<?
			$lesson=1;
			$day++;
			}
			?></table>
			<?
		}
		echo "{$row['number_class']}<sup>{$row['leter_class']}</sup>";
		
		echo "Новости класса<br>";
		$sql="SELECT id, header, new, autor, date, id_class FROM news_classes WHERE id_class=$id_class";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo $row['header']."<br>";
			echo $row['new']."<br>";
			$sql="SELECT id, name FROM users_teachers WHERE id={$row['autor']}";
			$res=$link->query($sql);
			$row_teach=$res->fetch(PDO::FETCH_ASSOC);
			echo $row_teach['name']."<br>";
			echo $row['date']."<br>";
		}
		echo "Учителя:<br>";
		$id_class_sql=$link->quote($id_class);
		$sql="SELECT ltc.id id_ltc, ltc.id_teacher, ut.name, l.name lesson_name FROM lesson_teacher_class ltc 
		JOIN users_teachers ut ON ut.id=ltc.id_teacher 
		JOIN lessons l ON l.id=ltc.id_lesson 
		WHERE id_class=$id_class";
		$res=$link->query($sql);
		echo "<table border='1'>";
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<tr>";
				echo "<td>";
					echo $row['name'];
				echo "</td>";
				echo "<td>";
					echo $row['lesson_name'];
				echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else{
		echo "У вас еще нет класса. Обратитесь к модератору, если произошла ошибка.";
	}
}
?>
</div>
<div class="col-xs-12 col-sm-4">
</div>
<div class="col-xs-12 col-sm-4">
	<?
	echo "<h3>Список класса</h3>";
	$sql="SELECT id, name FROM users_students WHERE id_class=$id_class";
	$res=$link->query($sql);
	while($row=$res->fetch(PDO::FETCH_ASSOC)){?>
		<div class="well col-xs-12 col-sm-6" title="<?=$row['name'];?>">
				<img src="<?=$row['img'];?>" class="img-circle img-responsive">
		</div>
	<?}?>
</div>
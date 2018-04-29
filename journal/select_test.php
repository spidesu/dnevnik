<?
$count_questions=$_POST['count_questions'];
$a=1;
$b=1;
$id_test_del=$_GET['id_test_del'];
if($id_test_del){
	$id_test_del=$link->quote($id_test_del);
	$sql="DELETE FROM tests WHERE id=$id_test_del;DELETE FROM pass_tests WHERE id_test=$id_test_del;";
	$link->exec($sql);
}
$id_test=$link->quote($_GET['id_test']);
$sql="SELECT id, name_test, count_question, json_text FROM tests";
$res=$link->query($sql);
?>
<h4>Выберите тест</h4>
<?
if($_SESSION['permission']==3){
	echo "<a href='?module=1&form=7'>Добавить</a>";
}
?>
<table class="table">
	<tr>
		<th>id</th>
		<th>Название</th>
		<th>Количество вопросов</th>
		<th>действие</th>
	</tr>
	<?
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		echo "<tr><td>{$row['id']}</td><td>{$row['name_test']}</td><td>{$row['count_question']}</td>";
		if($_SESSION['permission']==3){echo "<td><a href=\"?module=1&form=12&id_test={$row['id']}\">просмотреть</a><br><a href=\"?module=1&form=13&id_test_del={$row['id']}\">удалить</a></td>";}
		if($_SESSION['permission']==4){echo "<td><a href=\"?module=1&form=5&id_test={$row['id']}\">Пройти</a></td>";}
		echo "</tr>";
	}
	?>
</table>
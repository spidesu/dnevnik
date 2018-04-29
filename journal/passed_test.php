<?
$id_test=$link->quote($_GET['id_test']);
$sql="
SELECT us.name, pt.count_true, pt.count_false FROM pass_tests pt 
LEFT JOIN users_students us ON us.id=pt.id_student
WHERE id_test=$id_test";
$res=$link->query($sql);
?>
<h4>Итоги теста</h4>
<table class="table">
	<tr>
		<th>ФИО</th>
		<th>Кол-во правильных</th>
		<th>Кол-во неправильных</th>
	</tr>
	<?
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		echo "<tr>";
		echo "<td>{$row['name']}</td>";
		echo "<td>{$row['count_true']}</td>";
		echo "<td>{$row['count_false']}</td>";
		echo "</tr>";
	}
	?>
</table>
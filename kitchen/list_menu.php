<div class="col-lg-6">
	<h2>Список меню</h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>id</th>
				<th>Дата</th>
				<th>Действие</th>
			</tr>
		</thead>
		<tbody>
			<?
				$sql="SELECT id, data FROM cook_menu";
				$res=$link->query($sql);
				while($row=$res->fetch(PDO::FETCH_ASSOC)){
					echo "
					<tr>
						<td>{$row['id']}</td>
						<td>{$row['data']}</td>
						<td><a href='?module=2&form=3&id={$row['id']}'>Просмотреть</a> | <a href='?module=2&form=2&id_add_your={$row['id']}'>Добавить</a></td>
					</tr>";
				}
			?>
		</tbody>
	</table>
</div>
<?
if($_SESSION['permission']==4){
?>

<div class="col-lg-6">
	<h2>Ваши меню</h2>
	<table class="table">
		<thead>
			<th>id</th>
			<th>Дата</th>
			<th>Действие</th>
		</thead>
		<?
			$sql="SELECT ym.id, m.id id_menu, ym.id_user, ym.id_menu, m.data FROM your_menu ym JOIN cook_menu m ON ym.id_menu=m.id WHERE ym.id_user={$_SESSION['id_student']}";
			$res=$link->query($sql);
			while($row=$res->fetch(PDO::FETCH_ASSOC)){
				echo "
				<tr>
					<td>{$row['id']}</td>
					<td>{$row['data']}</td>
					<td><a href='?module=2&form=3&id={$row['id_menu']}'>Просмотреть</a> | <a href='?module=2&form=2&id_del_your={$row['id']}'>Удалить</a></td>
				</tr>";
			}
		?>
	</table>
</div>
<?
}
?>
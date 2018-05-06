<div class="col-lg-6">
	<h2>Список меню</h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>№</th>
				<th>Дата</th>
				<th>К готовке</th>
				<th>Действие</th>
			</tr>
		</thead>
		<tbody>
			<?
				$sql="SELECT id, data FROM cook_menu";
				$res=$link->query($sql);
				while($row=$res->fetch(PDO::FETCH_ASSOC)){
					$sql="SELECT count(id) count FROM your_menu WHERE id_menu={$row['id']}";
					$res1=$link->query($sql);
					$row1=$res1->fetch(PDO::FETCH_ASSOC);
					echo "
					<tr>
						<td>{$row['id']}</td>
						<td>{$row['data']}</td>
						<td>{$row1['count']}</td>
						<td><a href='?module=2&form=3&id={$row['id']}'>Просмотреть</a> | <a href='?module=2&form=2&id_del={$row['id']}'>Удалить</a></td>
					</tr>";
				}
			?>
		</tbody>
	</table>
</div>
<div class="col-lg-6">
	<h2>Список заказов</h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>№</th>
				<th>Ученик</th>
			</tr>
		</thead>
		<tbody>
			<?
				$sql="SELECT ut.name, ym.id_menu FROM your_menu ym JOIN users_students ut ON ut.id=ym.id_user";
				$res=$link->query($sql);
				while($row=$res->fetch(PDO::FETCH_ASSOC)){
					echo "
					<tr>
						<td>{$row['id_menu']}</td>
						<td>{$row['name']}</td>
					</tr>";
				}
			?>
		</tbody>
	</table>
</div>
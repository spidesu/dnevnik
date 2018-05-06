<?
	
	$sql="SELECT id,name FROM meals";
	$res=$link->query($sql);
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		$str.= "<option value='{$row['id']}'>{$row['name']}</option>";
	}

?>
<div class="col-lg-6">
<h2>Добавить меню</h2>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<input type="button" value="Добавить блюдо" onclick="addMeal()" class="btn btn-default">
<form method="post" id="form_menu">
	<div id="form_menu_addchild">
		
		
	</div>
	Дата приготовления:<br><input type="date"  name="date_menu" class="form-control"><br>
	<input type="submit" value="Готово!" class="btn btn-primary">
</form>
</div>
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
						<td><a href='?module=2&form=3&id={$row['id']}'>Просмотреть</a> | <a href='?module=2&form=2&id_del={$row['id']}'>Удалить</a></td>
					</tr>";
				}
			?>
		</tbody>
	</table>
</div>
<script>
	function addMeal(){
		div=document.createElement('div');
		div.innerHTML="<select name='meal[]' class='form-control' placeholder='Введите название блюда'><?=$str?></select><br>";
		form_menu_addchild.appendChild(div);
	}
	addMeal();
</script>

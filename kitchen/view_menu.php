<div class="col-lg-6">
	<h3>Меню</h3>
	<p><a href="?module=2&form=2"><- Назад</a></p>
	<?if($_SESSION['permission']==6){?><p><a href="<?="?module=2&form=2&id_del={$_GET['id']}"?>">Удалить</a></p><?}?>
	<table class="table">
		<tr>
			<th>№</th>
			<th>Название</th>
		</tr>
		<?
			$id_menu=$_GET['id'];
			if($id_menu){
				$sql="SELECT json_menu, data FROM cook_menu WHERE id=$id_menu";
				$res=$link->query($sql);
				$row=$res->fetch(PDO::FETCH_ASSOC);
				$data=json_decode($row['json_menu'],true);
				if(!empty($data)){
					$sql="";
					$number=1;
					foreach($data as $meal){
						$sql="SELECT name FROM meals WHERE id=$meal";
						$res1=$link->query($sql);
						$row1=$res1->fetch(PDO::FETCH_ASSOC);
						echo "<tr><td>$number</td><td>".$row1['name']."</td></tr><br>";
						$number++;
					}
				}
			}
			echo "<h3>Дата: {$row['data']}</h3>"
		?>
	</table>
</div>
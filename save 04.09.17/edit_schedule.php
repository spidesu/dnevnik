<script>
	var json="";
	var less_id="";
	var less="";
	var lessons="";
	var str="";
	function json_code(){
		for (var d = 1; d < 8; d++) {
			for (var l = 1; l < 7; l++) {
				less=document.getElementById("d"+d+"_l"+l);
				less_id=less.value;
				lessons+='{"'+l+'":[{"lesson_id":'+less_id+'}]},';
				
			}
			lessons=lessons.substr(0,lessons.length-1);
			str+='"'+d+'":['+lessons+'],';
			lessons="";
		}
		str=str.substr(0,str.length-1);
		json='{'+str+'}';
		schedule_json.value=json;
		form.submit();
	}
</script>
<h2>Изменить расписание</h2>
<table border="1">
	<?
	$day=1;
	$lesson=1;
	$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
	$res=$link->query($sql);
	$row1=$res->fetch(PDO::FETCH_ASSOC);
	$id_class=$link->quote($row1['id']);
	while($day<=7){?>
	<tr>
		<td>
			День <?=$day?>
		</td>
		<td>
		<?while($lesson<=6){?>
		
			<select  <?="id=d".$day."_l".$lesson?>>
				<option value='0'>Нет урока</option>
				<?
					$sql="SELECT id, name FROM lessons";
					$res=$link->query($sql);
					
					while($row1=$res->fetch(PDO::FETCH_ASSOC)){
						$sql="SELECT id FROM schedule WHERE day=$day and number_lesson=$lesson and id_lesson={$row1['id']} and id_class=$id_class";
						$res1=$link->query($sql);
						$row2=$res1->fetch(PDO::FETCH_ASSOC);
						if($row2['id']){
							$selected="selected";
						}
						echo "<option $selected value='{$row1['id']}'>{$row1['name']}</option>";
						$selected="";
					}
				?>
			</select><br>
		
		<?$lesson++;}?>
		</td>
	</tr>
	<?
	$lesson=1;
	$day++;
	}
	?>
	
</table>
<form id="form" method="POST">
<input hidden name="schedule_json" id="schedule_json">
</form>
<button onclick="json_code()">Готово</button>
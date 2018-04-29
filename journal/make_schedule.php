<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
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
<h2>Составить расписание</h2>
<div class="col-xs-12 col-sm-5">
	<table class="table">
		<?
		$day=1;
		$lesson=1;
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
						while($row=$res->fetch(PDO::FETCH_ASSOC)){
							echo "<option value='{$row['id']}'>{$row['name']}</option>";
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
</div><br>
<form id="form" method="POST">
<input hidden name="schedule_json" id="schedule_json">
</form>
<div class="col-xs-12">
<button onclick="json_code()" class="btn btn-primary">Готово</button>
</div>
<?
$count_questions=$_POST['count_questions'];
$a=1;
$b=1;
$id_test=$link->quote($_GET['id_test']);
$sql="SELECT id, name_test, count_question, json_text FROM tests WHERE id=$id_test";
$res=$link->query($sql);
$row=$res->fetch(PDO::FETCH_ASSOC);
$questions=json_decode($row['json_text'],JSON_UNESCAPED_UNICODE);
$name_test=$link->quote($_POST['name_test']);
if($count_questions){
	$count_true=0;
	$count_false=0;
	while($count_questions>=$a){
		$data[$a]['type_question']=$_POST['type_question'][$a];
		$count_answers=$_POST['count_answers'][$a];
		$data[$a]['count_answers']=$count_answers;
			while($count_answers>=$b){
				if($data[$a]['type_question']==2){
					if($questions[$a]['right'][$b]=="true" and $_POST['answer_checkbox'][$a][$b]){
						$data[$a]['right'][$b]="true";
					}
					else{
						$data[$a]['right'][$b]="false";
					}
					//echo $data[$a]['right'][$b]."<br>";
				}
				elseif($data[$a]['type_question']==3){
					if($questions[$a]['answers'][$b]==$_POST['text_answer'][$a][$b]){
						$data[$a]['right'][$b]="true";
					}
					else{
						$data[$a]['right'][$b]="false";
					}
					//echo $data[$a]['right'][$b]."<br>";
				}
				elseif($data[$a]['type_question']==1){
					if($questions[$a]['right'][$b]=="true" and $_POST['answer_radio'][$a]){
						$data[$a]['right'][$b]="true";
					}
					else{
						$data[$a]['right'][$b]="false";
					}
					//echo $data[$a]['right'][$b]."<br>";
				}
				$b++;
			}
			if($data[$a]['right']==$questions[$a]['right']){
				$data[$a]['right_all']="true";
				$count_true++;
			}
			else{
				$data[$a]['right_all']="false";
				$count_false++;
			}
		$a++;
		$b=1;
	}
	$a=0;
	$count_questions=$link->quote($count_questions);
	$data=$link->quote(json_encode($data,JSON_UNESCAPED_UNICODE));
	$sql="INSERT INTO pass_tests(id_test, id_student, json_text, count_true, count_false) VALUES ({$row['id']},{$_SESSION['id_student']},$data,$count_true,$count_false)";
	$link->exec($sql);
}
$a=1;
$b=1;
?>
<h4>Пройти тест на тему: "<?=$row['name_test']?>"</h4>
<?
if($data){
	echo "Ваш результат: <b color='green'>$count_true верных</b> и <b color='red'>$count_false неверных ответа</b>";
}
?>
<form method="POST" id="form">
	<?
	echo "<input hidden name=\"count_questions\" value=\"{$row['count_question']}\">";
	while($row['count_question']>=$a){
		echo "<input hidden name=\"type_question[$a]\" value=\"{$questions[$a]['type_question']}\">";
	?>
			
			
			<h4><?=$a?></h4>
			<p><?=$questions[$a]['question_text']?></p>
			<?
				while($questions[$a]['count_answers']>=$b){
					echo "<input hidden name=\"count_answers[$a]\" value=\"{$questions[$a]['count_answers']}\">";
					if($questions[$a]['type_question']==1){
						echo "<input type=\"radio\" name=\"answer_radio[$a]\" value=\"$b\">".$questions[$a]['answers'][$b]."<br>";
					}
					elseif($questions[$a]['type_question']==2){
						echo "<input type=\"checkbox\" name=\"answer_checkbox[$a][$b]\" value=\"$b\">".$questions[$a]['answers'][$b]."<br>";
					}
					else{
						echo "<input type=\"text\" name=\"text_answer[$a][$b]\">";
					}
					$b++;
				}
				$b=1;
			?>
		
	<?
	$a++;
	}
	?>
	<input type="submit">
</form>
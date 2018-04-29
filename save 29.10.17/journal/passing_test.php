<?
include('config.php');
$count_questions=$_POST['count_questions'];
$a=1;
$b=1;
while($count_qustions>=$a){
	
	$data[$a]['question_text_name']=$_POST['question_text_name_'.$a];
	$data[$a]['question_text']=$_POST['question_text_'.$a];
	$count_answers=$_POST['count_answers_1'];
		while($count_answers>=$b){
			$data[$a]['answer'.$b]=$_POST['text_answer_'.$a.'_'.$b];
			$b++;
		}
	
	
	$a++;
	$b=1;
}
$a=0

?>
<?
$id_test=$link->quote($_GET['id_test']);
$sql="SELECT id, name_test FROM tests WHERE id=$id_test";
$res=$link->query($sql);
$row=$res->fetch(PDO::FETCH_ASSOC);
?>
	<form method="POST" id="form">
		<h4>Пройти тест на тему: "<?=$row['name_test']?>"</h4>
		<?
		$sql_question="SELECT id id_question, text_question, type_answer FROM questions WHERE id_test={$row['id']}";
		$res_question=$link->query($sql_question);
		while($row_question=$res_question->fetch(PDO::FETCH_ASSOC)){
		?>
		<div id="questions">
			<div id="question1">
				<p><?=$row_question['text_question']?></p>
				<hr>
				Ответ
				<?
				$sql_answer="SELECT id id_answer, id_question, text text_answer FROM answers WHERE id_question={$row_question['id_question']}";
				$res_answer=$link->query($sql_answer);
				while($row_answer=$res_answer->fetch(PDO::FETCH_ASSOC)){
				?>
					<?if($row_question['type_answer']==3){?>
						<div id="answer">
							<div id="text_answer"><input type="text" name="answer_text[<?=$row_question['id_question']?>][<?=$row_answer['id_answer']?>]"><br></div>
						</div>
					<?}elseif($row_question['type_answer']==2){?>
						<div id="answer">
							<input type="checkbox" name="answer_checkbox[<?=$row_question['id_question']?>][<?=$row_answer['id_answer']?>]"><?=$row_answer['text_answer']?><br>
						</div>
						
					<?}else{?>
						<div id="answer">
							<input type="radio" value="<?=$row_answer['id_answer']?>" name="answer_radio[<?=$row_question['id_question']?>]"><?=$row_answer['text_answer']?><br>
						</div>
					<?}?>
				<?}?>
			</div>
			<hr>
		</div>
		<?}?>
		<input type="submit" value="ДАВАЙ СДЕЛАЕМ ЭТО ВМЕСТЕ!">

	</form>

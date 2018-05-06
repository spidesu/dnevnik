<ul class="nav nav-tabs">
  <li <?if($form==1){echo "class=\"active\"";}?>><a href="?module=1&form=1">Главная</a></li>
  <li <?if($form==2){echo "class=\"active\"";}?>><a href="?module=1&form=2">Мой класс</a></li>
  <!---<li <?if($form==5){echo "class=\"active\"";}?>><a href="?module=1&form=5">Добавить родителя</a></li>-->
  <li <?if($form==6){echo "class=\"active\"";}?>><a href="?module=1&form=6">Журналы</a></li>
  <li <?if($form==13){echo "class=\"active\"";}?>><a href="?module=1&form=13">Тестирование</a></li>

</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
    <p>
	<?
	switch($form){
		case 1: include('journal/info.php'); break;
		case 2: include('journal/my_class.php'); break;
		case 3: include('journal/classes_lesson_teachers.php'); break;
		case 4: include('journal/add_student.php'); break;
		case 5: include('journal/add_parent.php'); break;
		case 6: include('journal/add_mark_select.php'); break;
		case 7: include('journal/add_test.php'); break;
		case 8: include('journal/make_schedule.php'); break;
		case 9: include('journal/edit_schedule.php'); break;
		case 10: include('journal/add_mark.php'); break;
		case 11: include('journal/add_new.php'); break;
		case 12: include('journal/passed_test.php'); break;
		case 13: include('journal/select_test.php'); break;
		case 14: include('journal/marks_teacher.php'); break;
		case 15: include('journal/my_circles.php'); break;
		case 16: include('journal/add_circles.php'); break;
	}
	?>
	</p>
  </div>
</div>

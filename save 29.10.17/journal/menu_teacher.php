<ul class="nav nav-tabs">
  <li<?if($form==1){echo " class=\"active\"";}?>><a href="?module=1&form=1">Главная</a></li>
  <li<?if($form==2){echo " class=\"active\"";}?>><a href="?module=1&form=2">Мой класс</a></li>
  <li<?if($form==3){echo " class=\"active\"";}?>><a href="?module=1&form=3">Учителя по предметам</a></li>
  <li<?if($form==4){echo " class=\"active\"";}?>><a href="?module=1&form=4">Добавить ученика</a></li>
  <li<?if($form==5){echo " class=\"active\"";}?>><a href="?module=1&form=5">Добавить родителя</a></li>
  <li<?if($form==6){echo " class=\"active\"";}?>><a href="?module=1&form=6">Добавить оценку</a></li>
  <li<?if($form==7){echo " class=\"active\"";}?>><a href="?module=1&form=7">Добавить тест</a></li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
      Dropdown <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <li><a href="#dropdown1" data-toggle="tab">Action</a></li>
      <li class="divider"></li>
      <li><a href="#dropdown2" data-toggle="tab">Another action</a></li>
    </ul>
  </li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
    <p>
	<?
	switch($form){
		case 2: include('journal/my_class.php'); break;
		case 3: include('journal/classes_lesson_teachers.php'); break;
		case 4: include('journal/add_student.php'); break;
		case 5: include('journal/add_parent.php'); break;
		case 6: include('journal/add_mark_select.php'); break;
		case 7: include('journal/add_test.php'); break;
		case 8: include('journal/edit_schedule.php'); break;
		case 9: include('journal/add_mark.php'); break;
	}
	?>
	</p>
  </div>
</div>

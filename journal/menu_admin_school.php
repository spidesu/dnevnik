<ul class="nav nav-tabs">
  <li <?if($form==1){echo " class=\"active\"";}?>><a href="?module=1&form=1">Главная</a></li>
  <li <?if($form==2){echo " class=\"active\"";}?>><a href="?module=1&form=2">Добавить класс</a></li>
  <li <?if($form==3){echo " class=\"active\"";}?>><a href="?module=1&form=3">Добавить учителя</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
    <p>
	<?
	switch($form){
		case 1: include('journal/info.php'); break;
		case 2: include('journal/add_class.php'); break;
		case 3: include('journal/add_teacher.php'); break;
	}
	?>
	</p>
  </div>
</div>
<hr>
<ul class="nav nav-tabs">
<li <?if($form==1){echo "class=\"active\"";}?>><a href="?module=1&form=1">Главная</a></li>
<li <?if($form==2){echo "class=\"active\"";}?>><a href="?module=1&form=2">Класс</a></li>
<li <?if($form==3){echo "class=\"active\"";}?>><a href="?module=1&form=3">Оценки</a></li>
<li <?if($form==4){echo "class=\"active\"";}?>><a href="?module=1&form=4">Кружки</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
    <p>
<?
switch($form){
	case 1: include('journal/info.php'); break;
	case 2: include('journal/my_class.php'); break;
	case 3: include('journal/my_marks.php'); break;
	case 4: include('journal/my_circles.php'); break;
	case 5: include('journal/add_circles.php'); break;
}
?>
	</p>
  </div>
</div>
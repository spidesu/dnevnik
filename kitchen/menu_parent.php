<hr>
<ul class="nav nav-tabs">
<li <?if($form==1){echo "class=\"active\"";}?>><a href="?module=1&form=1">Главная</a></li>
<li <?if($form==2){echo "class=\"active\"";}?>><a href="?module=1&form=2">Мой класс</a></li>
<li <?if($form==3){echo "class=\"active\"";}?>><a href="?module=1&form=3">Мои оценки</a></li>
<li <?if($form==4){echo "class=\"active\"";}?>><a href="?module=1&form=4">Тестирование</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
    <p>
<?
switch($form){
	case 1: include('journal/info.php'); break;
	case 2: include('journal/my_class.php'); break;
	case 3: include('journal/my_marks.php'); break;
	case 4: include('journal/select_test.php'); break;
	case 5: include('journal/passing_test.php'); break;
}
?>
	</p>
  </div>
</div>
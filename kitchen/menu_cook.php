<hr>
<ul class="nav nav-tabs">
<li <?if($form==1){echo "class=\"active\"";}?>><a href="?module=2&form=1">Главная</a></li>
<li <?if($form==2){echo "class=\"active\"";}?>><a href="?module=2&form=2">Добавить меню</a></li>
<li <?if($form==4){echo "class=\"active\"";}?>><a href="?module=2&form=4">Приготовление</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
    <p>
<?
switch($form){
	case 1: include('kitchen/info.php'); break;
	case 2: include('kitchen/add_menu.php'); break;
	case 3: include('kitchen/view_menu.php'); break;
	case 4: include('kitchen/view_cook.php'); break;
}
?>
	</p>
  </div>
</div>
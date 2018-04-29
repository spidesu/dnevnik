<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/slider_1.jpg" class="img-thumbnail">
    </div>

    <div class="item">
      <img src="/images/slider_2.jpg" class="img-thumbnail">
    </div>

    <div class="item">
      <img src="images/slider_3.jpg" class="img-thumbnail">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="col-xs-12 col-sm-6">
<h2>Мы приветсвуем вас</h2>
<p>Данный модуль системы предназначен для ведения журнала оценок и тестирования учеников</p>
</div>
<div class="col-xs-12 col-sm-6">
	<div class="well bs-component">
		<form class="form-horizontal" method="post">
			<fieldset>
			<legend>Вход в систему</legend>
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Логин</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="inputEmail" name="login" placeholder="Логин">
				</div>
				<label for="inputPassword" class="col-lg-2 control-label">Пароль</label>
				<div class="col-lg-10">
					<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Пароль">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="submit" class="btn btn-primary">Войти</button>
				</div>
			</div>
			</fieldset>
		</form>
	</div>
</div>
<div class="clearfix"></div> 
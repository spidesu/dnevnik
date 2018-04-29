<div class="col-xs-6">
<h2>Добавить новость</h2>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<form method="post">
	<input name="header" placeholder="Название" class="form-control"><br>
	<input name="new" placeholder="Текст" class="form-control"><br>
	<input type="submit"  class="btn btn-primary">
</form>
</div>
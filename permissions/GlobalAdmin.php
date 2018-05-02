<?
switch($form){
	case 1: break;
	case 2: //добавление школы
	$name_school_text=$_POST['name_school'];
	$address_school=$_POST['address_school'];
	$surname_dir_school=$_POST['surname_dir_school'];
	$email_school_text=$_POST['email_school'];
	$phone_school=$_POST['phone_school'];
	if($name_school_text && $address_school && $surname_dir_school && $email_school_text && $phone_school){
		$globalAdminClass->add_school($name_school_text, $address_school, $surname_dir_school,  $email_school_text, $phone_school);
		header('location: ?module=1&form=2');
		exit;
	}
	break;
}
?>
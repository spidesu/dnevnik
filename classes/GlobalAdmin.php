<?
class GlobalAdmin{

	function add_school($name_school_text, $address_school, $surname_dir_school,  $email_school_text, $phone_school){//добавление школы
		Global $link;
		if($name_school_text && $address_school && $surname_dir_school && $email_school_text && $phone_school){
			$name_school=$link->quote($name_school_text);
			$address_school=$link->quote($address_school);
			$surname_dir_school=$link->quote($surname_dir_school);
			$email_school=$link->quote($email_school_text);
			$phone_school=$link->quote($phone_school);
			$sql="INSERT INTO schools(name_school, address_school, surname_dir_school, email_school, phone_school) 
			VALUES ($name_school,$address_school,$surname_dir_school,$email_school,$phone_school)";
			$link->exec($sql);
			$password_text=md5(uniqid(rand(),true));
			$password=$link->quote($password_text);
			$name_admin="Администратор школы $name_school_text";
			$name_admin=$link->quote($name_admin);
			$sql="SELECT id id_school FROM schools order by id desc limit 0, 1";
			$res=$link->query($sql);
			$row=$res->fetch(PDO::FETCH_ASSOC);
			$id_school=$row['id_school'];
			$id_school=$link->quote($id_school);
			$sql="
			INSERT INTO users_school_admins(email, name, phone, id_school) VALUES ($email_school, $name_admin, $phone_school, $id_school)
			";
			$link->exec($sql);
			$sql="SELECT id id_user_table FROM users_school_admins order by id desc limit 0, 1";
			$res=$link->query($sql);
			$row=$res->fetch(PDO::FETCH_ASSOC);
			$id_user_table=$row['id_user_table'];
			$id_user_table=$link->quote($id_user_table);
			$sql="
			INSERT INTO users(login, password, id_user, permission) VALUES ($email_school, $password, $id_user_table, 2)";
			$link->exec($sql);
			$_SESSION['msg']="<font color='green'>Школа успешно добавлена!<br>Данные глобального администратора:<br>Логин: $email_school_text<br>Пароль: $password_text</font>";
			return true;
		}
		else{
			return false;
		}
	}
}
?>
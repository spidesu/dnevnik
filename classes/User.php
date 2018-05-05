<?
class user{

	function checkLogin($login){//проверка занятости логина
		Global $link;
		if($login!=""){
			$sql="SELECT id FROM users WHERE login=$login";
			$res=$link->query($sql);
			$row=$res->fetch(PDO::FETCH_ASSOC);
			if($row['id']){
				return false;
			}
			else{
				return true; 
			}
		}
		else{
			return true;
		}
	}

	function checkBD($login,$password){//проверка пользователя на валидность
		Global $link;
		if($login!="" && $password!=""){
			$sql="SELECT id FROM users WHERE login=$login and password=$password";
			$res=$link->query($sql);
			$row=$res->fetch(PDO::FETCH_ASSOC);
			if($row['id']){
				return false;
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}

	function checkSession(){
		if($this->checkBD($_SESSION['login'],$_SESSION['password'])){
			return true;
		}
		else{
			return false;
		}
	}

	function auth($login, $password){
		Global $link;
		if($login && $password){
			$login=$link->quote($login);
			$password=$link->quote($password);
			$sql="SELECT permission, id_user, login, password FROM users WHERE login=$login and password=$password";
			$res=$link->query($sql);
			$row=$res->fetch(PDO::FETCH_ASSOC);
			if($row['permission']){
				$_SESSION['permission']=$row['permission'];
				$_SESSION['login']=$row['login'];
				$_SESSION['password']=$row['password'];
				$id_user=$row['id_user'];
				$id_user=$link->quote($id_user);
				switch($row['permission']){
					case 1:
						$sql="SELECT name, email, phone FROM users_global_admins WHERE id=$id_user";
						$res=$link->query($sql);
						$row=$res->fetch(PDO::FETCH_ASSOC);
					break;
					case 2: 
						$sql="SELECT name, email, phone, id_school FROM users_school_admins WHERE id=$id_user";
						$res=$link->query($sql);
						$row=$res->fetch(PDO::FETCH_ASSOC);
						$_SESSION['id_school']=$row['id_school'];
					break;
					case 3: 
						$sql="SELECT id, name, email, phone, id_school, id_base_lesson, employment FROM users_teachers WHERE id=$id_user";
						$res=$link->query($sql);
						$row=$res->fetch(PDO::FETCH_ASSOC);
						$_SESSION['id_teacher']=$row['id'];
						$_SESSION['id_school']=$row['id_school'];
						$_SESSION['id_base_lesson']=$row['id_base_lesson'];
						$_SESSION['employment']=$row['employment'];
					break;
					case 4: 
					
						$sql="SELECT id, email, name, phone, id_class, id_parent, id_school FROM users_students WHERE id=$id_user";
						$res=$link->query($sql);
						$row=$res->fetch(PDO::FETCH_ASSOC);
						$_SESSION['id_student']=$row['id'];
						$_SESSION['id_school']=$row['id_school'];
						$_SESSION['name']=$row['name'];
						if($row['email']){
							$_SESSION['email']=$row['email'];
						}
						if($row['phone']){
							$_SESSION['phone']=$row['phone'];
						}
						$_SESSION['id_class']=$row['id_class'];
						if($row['id_parent']>0){
							$_SESSION['id_parent']=$row['id_parent'];
						}
					
					break;
				}
				$_SESSION['email']=$row['email'];
				$_SESSION['name']=$row['name'];
				$_SESSION['phone']=$row['phone'];
				$_SESSION['msg']="<font color='green'>Поздравляем! Вы успешно вошли в систему, {$row['name']}!</font>";
				$_SESSION['msg_status']="success";

				return true;

			}
			else{

				$_SESSION['msg']="<font color='red'>Неверно введен логин или пароль!</font>";
				$_SESSION['msg_status']="danger";

				return false;

			}
		}
	}

}
?>
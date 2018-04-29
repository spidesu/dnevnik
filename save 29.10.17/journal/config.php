<?	
	header("Content-Type: text/html; charset='utf-8'");//установка кодировки
	
	try {
		$link=new PDO('mysql:host=localhost;dbname=1', "root", "");
	} 
	catch (PDOException $e) {
		echo $e->getMessage();
	}
	session_start();
?>
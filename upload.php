<? 
include('config.php');
$json = file_get_contents('php://input'); 
$file='input.json';
file_put_contents($file, $json);
echo $json;
?>
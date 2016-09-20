<?php 
# Não permite o acesso direto à URL sem estar logado.
if (!class_exists('Login')) :
	header('Location: ../../painel.php');
	die;
endif;
?>

<?php
// PDO connect *********
function connect() {
	$host = HOST;
	$db_name = DBSA;
	$db_user = USER;
	$db_password = PASS;
    return new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
 
#get the list of items id separated by cama (,)
$list_order = $_POST['list_order'];

#convert the string list to an array
$list = explode(',' , $list_order);
$i = 1; 
foreach($list as $id) {
	try {
	    $sql = 'UPDATE nit_parceiros SET slider_order = :item_order WHERE slider_id = :id';
		$query = $pdo->prepare($sql);
		$query->bindParam(':item_order', $i, PDO::PARAM_INT);
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();
	} catch (PDOException $e) {
		echo 'PDOException : '.  $e->getMessage();
	}
	$i++ ;
}
?>
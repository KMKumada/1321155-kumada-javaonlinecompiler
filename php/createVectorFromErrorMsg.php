<?php



try {
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=java_cloud;charset=utf8','root','java',
	array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
	 exit('Deatabase connection error: '.$e->getMessage());
}

$pdo->query("SET NAMES utf8");

// counterの取得
$stmt = $pdo->prepare("SELECT student_id, stderror FROM result WHERE create_time > NOW() - INTERVAL 20 MINUTE");
$stmt->execute();

$data = array();
while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
	
	echo $row["stderror"] . "\n";
}



?>
<?php
header('Content-type: application/json');

//$lecture_week_id = $_POST['lecture_week_id'];
$exercise_id =  $_POST['exercise_id'];

try {
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=java_cloud;charset=utf8','root','java',
	array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
	 exit('Deatabase connection error: '.$e->getMessage());
}

$pdo->query("SET NAMES utf8");
$stmt = $pdo->prepare("SELECT content FROM exercise WHERE id = :exercise_id");
$stmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT); 
$stmt -> execute();

$content = "";
while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
	$content = $row["content"];
}

$data['content'] = $content;
echo json_encode($data);

?>
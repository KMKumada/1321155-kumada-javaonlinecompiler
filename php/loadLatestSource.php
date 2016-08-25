<?php
header('Content-type: application/json');
$student_id = $_POST['student_id'];;
$exercise_id = $_POST['exercise_id'];

// $student_id = "1221109";
// $exercise_id = 1;

try {
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=java_cloud;charset=utf8','root','java',
	array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
	 exit('Deatabase connection error: '.$e->getMessage());
}

$pdo->query("SET NAMES utf8");

// counterの取得
$stmt = $pdo->prepare("SELECT content FROM result WHERE student_id = :student_id AND exercise_id = :exercise_id ORDER BY create_time DESC LIMIT 1");
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
$stmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);
$stmt->execute();

$row = $stmt -> fetch(PDO::FETCH_ASSOC);

$data['content'] = $row["content"];

echo json_encode($data);

?>
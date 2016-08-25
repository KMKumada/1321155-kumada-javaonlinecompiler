<?php
header('Content-type: application/json');

date_default_timezone_set('Asia/Tokyo');

$student_id = $_POST['student_id'];;
$exercise_id = $_POST['exercise_id'];
$judge = $_POST['type'];

// Database access
try {
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=java_cloud;charset=utf8','root','java',
	array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
	 exit('Deatabase connection error: '.$e->getMessage());
}

$pdo->query("SET NAMES utf8");

// counterの取得
$stmt = $pdo->prepare("SELECT max(counter) FROM result WHERE student_id = :student_id AND exercise_id = :exercise_id");
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
$stmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);
$stmt->execute();

$counter = $stmt->fetchColumn() + 1;

//データ取得
$string =  $_POST['str'];


$content = $string;
$stmt = $pdo->prepare("INSERT INTO result (student_id, exercise_id, counter, content, judge) " . 
	"VALUES (:student_id, :exercise_id, :counter, :content, :judge)");
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
$stmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);
$stmt->bindParam(':counter', $counter, PDO::PARAM_INT);
$stmt->bindParam(':content', $content, PDO::PARAM_INT);
$stmt->bindParam(':judge', $judge, PDO::PARAM_STR);
$stmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);

$stmt -> execute();

$data['type'] = 'saved at ' . date("Y-m-d H:i:s");
echo json_encode($data);

?>

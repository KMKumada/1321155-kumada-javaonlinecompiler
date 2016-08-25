<?php

$student_id = "1321033";
$exercise_id = 1;
//$counter = 1;
$content = "public class HelloWorld { public static void main (String[] args) {System.out.println();} }";
$judge = "success";
$stdout = "";
$stderror = "";


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

$stmt = $pdo->prepare("INSERT INTO result (student_id, exercise_id, counter, content, judge, stdout, stderror) " . 
	"VALUES (:student_id, :exercise_id, :counter, :content, :judge, :stdout, :stderror)");
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
$stmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);
$stmt->bindParam(':counter', $counter, PDO::PARAM_INT);
$stmt->bindParam(':content', $content, PDO::PARAM_INT);
$stmt->bindParam(':judge', $judge, PDO::PARAM_STR);
$stmt->bindParam(':stdout', $stdout, PDO::PARAM_STR);
$stmt->bindParam(':stderror', $stderror, PDO::PARAM_STR);
$stmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);

$stmt -> execute();

echo "done.";

?>
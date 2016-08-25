<?php
//開始タグ
header('Content-type: application/json');
//header関数を用いてphpでjsonファイルを出力しています。
try {//例外処理のやり方ですMySQLへの接続を試みています。
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=java_cloud;charset=utf8','root','',
　//PDO（PHP Data Objectsの略）DBの種類によって切り替える関数の手間を省略
　//
	array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {//例外時の処理をしています。
	 exit('Deatabase connection error: '.$e->getMessage());
}

$pdo->query("SET NAMES utf8");
//いろんな環境で動かすために文字コードの設定をしておく
// counterの取得
$stmt = $pdo->prepare("SELECT id, name FROM student");<!--プリペアドクエリを実行-->
$stmt->execute();//ステートメントを実行します。execute実行。statement発言、声明、宣言、供述

$data = array();//配列の値を変数dataに格納
while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
//変数rowにSQL文の実行結果として取り出される予定の行の集合から、fetchメソッドを実行するたび
//にひとつづつ、連想配列形式で取り出すことを指示し、返り値をrowに代入する
	$data[] = array(//連想配列形式
    	'id' => $row['id'],
    	'name' => $row['name'],
	);
}
echo json_encode($data);
//配列をJSONに変換(エンコード)する。
//終了タグ
?>

<?php
header('Content-type: application/json');

date_default_timezone_set('Asia/Tokyo');

//笠井君が作ったログイン情報の学籍番号↓
//$student_id = $_SESSION['account']['user_id'];
$student_id = $_POST['student_id'];
$exercise_id = $_POST['exercise_id'];
$judge = "";
$stdout = "";
$stderror = "";
$is_finished = $_POST['is_finished'];

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
//htmlで書いた文をその日付の名前でJAVAファイル形式作成する。
//成功時に書いた内容と、ファイル名を表示する。
//↓正規表現の名前を抽出
$reg = '/^public +class +(.*){/';
preg_match($reg, $string, $p_name);

$className = str_replace(' ','',$p_name[1]);

$filename=$className.".java";


//学籍番号のフォルダ内にファイルを生成
touch("../user/$student_id/$filename");
//touch("$filename");


$fp = fopen("../user/$student_id/$filename", "w"); // 新規書き込みモードで開く学籍番号のフォルダ内を指定
//$fp = fopen("$filename", "w");
@fwrite( $fp, $string, strlen($string) ); // ファイルへの書き込み
fclose($fp);

/*
追加
*/
//コンパイル時にファイル場所をさらに指定
$compileCommand = 'javac -J-Duser.language=en -J-Duser.country=us -encoding utf-8 ..\user\\'.$student_id.'\\'.$className.'.java  2>&1';
//$compileCommand = 'javac -J-Duser.language=en -J-Duser.country=us -encoding utf-8 '.$className.'.java  2>&1';
exec($compileCommand,$output,$compileReturnVal);

$line_cnt = count($output);

$msg = "";
if($compileReturnVal == 1){//コンパイルする時エラがある場合

	for ($i = 0; $i < $line_cnt; $i++) {
		$msg .= mb_convert_encoding($output[$i],"utf-8","SJIS") . "\n";	
	}

	$stderror = $msg;
	$judge = "error";

    $data['type'] = 'compile_error at ' . date("Y-m-d H:i:s");
    $data['result'] = $msg;
    echo json_encode($data);//jsonでコンパイルエラを出力

}else{//コンパイル成功した場合

    //クラス呼び出しのときにパスを指定しておく
    $runCommand = 'java -Duser.language=en -classpath ..\user\\'.$student_id.' '.$className.'  2>&1';
    //$runCommand = 'java -Duser.language=en '.$className.'  2>&1';
    
    exec($runCommand,$output,$runReturnVal);//実行する

    $line_cnt = count($output);

    for ($i = 0; $i < $line_cnt; $i++) {
		$msg .= mb_convert_encoding($output[$i],"utf-8","SJIS") . "\n";	
	}

    if($runReturnVal == 1){ //実行失敗した場合

        //$error = mb_convert_encoding($output[0],"utf-8","SJIS");
        $stderror = $msg;
        $judge = "error";
		
        $data['type'] = 'run_error at ' . date("Y-m-d H:i:s");
        $data['result'] = $msg;
        echo json_encode($data);//jsonで実行エラを出力
    }else{
        $result = $msg;
        $stdout = $msg;
        $judge = "success";

		if ($is_finished == "true") {
 		   $judge = "finish";
		}

        $data['type'] = $judge . ' at ' . date("Y-m-d H:i:s");
        $data['result'] = $result;
        echo json_encode($data);
    }

}



$content = $string;
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

?>

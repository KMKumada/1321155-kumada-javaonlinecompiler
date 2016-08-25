<?php

namespace joc;

require_once __DIR__ . '/vendor/autoload.php';
use joc\Model\Result;

// $exercise_id = $_POST['exercise_id'];
$exercise_id = 1;

$result = new Result();
$data_list = $result->getDataList($exercise_id);

echo json_encode($data_list);

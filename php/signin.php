<?php

namespace joc;

require_once __DIR__ . '/vendor/autoload.php';
use joc\Util\Util;
use joc\Model\Account;

session_start();

$role = $_POST['role'];
$user_id = $_POST['user_id'];
// デモ環境ではパスワードは空にしている
// $password = $_POST['password'];
$password = '';

$account = new Account();

if ($account->permit($role, $user_id, $password) == false) {
  Util::localRedirect('/index.php?permit=no');
}

$_SESSION['account']['role'] = $role;
$_SESSION['account']['user_id'] =$user_id;

if ($_SESSION['account']['role'] === 'teacher') {
  Util::localRedirect('/teacher-list.php');
} else {
  Util::localRedirect('/index.html');
}

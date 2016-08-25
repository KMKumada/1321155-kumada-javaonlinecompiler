<?php

namespace joc;

require_once __DIR__ . '/vendor/autoload.php';
use joc\Util\Util;

session_start();

$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time() - 42000, '/');
}

session_destroy();

Util::localRedirect('/index.php');

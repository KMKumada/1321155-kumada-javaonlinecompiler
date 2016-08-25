<?php

namespace joc;

require_once __DIR__ . '/php/vendor/autoload.php';
use joc\Template\Template;

Template::$title = 'teacher edit';

session_start();
echo 'session_name = ' . session_name();
echo "<br>";
echo 'session_id = ' . session_id();
echo "<br>";
echo 'session_status = ' . session_status();
echo "<br>";
echo '$_SESSION = ' . print_r($_SESSION);
echo "<br>";
echo '$_COOKIE = ' . print_r($_COOKIE);
echo "<br>";
echo '$_GET = ' . print_r($_GET);

include __DIR__ . '/php/lib/Template/header.php';
  
?>


<?php include __DIR__ . '/php/lib/Template/footer.php'; ?>

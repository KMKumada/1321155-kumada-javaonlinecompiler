<?php

namespace joc;

require_once __DIR__ . '/php/vendor/autoload.php';
use joc\Template\Template;

Template::$title = 'teacher list';

session_start();

include __DIR__ . '/php/lib/Template/header.php';
  
?>

<?php include __DIR__ . '/php/lib/Template/footer.php'; ?>

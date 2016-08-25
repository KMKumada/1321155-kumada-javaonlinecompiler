<?php

namespace joc;

require_once __DIR__ . '/../../vendor/autoload.php';
use joc\Template\Template;

foreach (Template::$js as $js_file) {
  $js_file = 'js/' . $js_file;
  echo '<script src="' , $js_file , '"></script>';
}
?>

</body>
</html>

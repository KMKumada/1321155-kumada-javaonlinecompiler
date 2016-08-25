<?php

namespace joc;

require_once __DIR__ . '/../../vendor/autoload.php';
use joc\Template\Template;
use joc\Util\Util;

if (Template::$title) {
  Util::isLogin() ?: Util::localRedirect('/index.php');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title><?php echo Template::$title ? Template::$title.' | ' : null; ?>Kait-takanolab java online compiler</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0">

  <?php
  foreach (Template::$css as $css_file) {
    $css_file = 'css/' . $css_file;
    echo '<link href="' , $css_file , '" rel="stylesheet">';
  }
  ?>

</head>

<body>
  <?php if (Template::$title == true) { ?>
  <nav id="global-nav" class="navbar navbar-static-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand">Java online compiler</a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <?php if (strpos(Template::$title, 'teacher') !== false) { ?>
        <ul class="nav navbar-nav">
          <li><a href="teacher-select.php">学生一覧</a></li>
        </ul>
        <?php } ?>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
              ID: <?php echo $_SESSION['account']['user_id']; ?> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a href="php/signout.php">サインアウト</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php } ?>

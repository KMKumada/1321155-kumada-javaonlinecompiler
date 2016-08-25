<?php

namespace joc;

require_once __DIR__ . '/php/vendor/autoload.php';
use joc\Template\Template;
use joc\Model\Result;

session_start();

Template::$title = 'teacher select';
Template::$js[] = 'list.min.js';
Template::$js[] = 'teacher-select.js';
Template::$css[] = 'teacher-select.css';

include __DIR__ . '/php/lib/Template/header.php';

?>

  <nav class="navbar navbar-static-top navbar-default">
    <div class="container">
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a id="hoge" href="#">sort</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div id="student_list">
      <ul class="list list-inline student-card"></ul>
    </div>
  </div>

    <!-- <ul class="list-inline">
      <li>
        <a href="#" class="btn btn-default">
          <p class="text-left card-text">
            学籍番号：1321112<br>
            判定：success<br>
            実行回数：6<br>
            最終実行：2016-01-05 22:24:30
          </p>
        </a>
      </li>
    </ul> -->

<?php include __DIR__ . '/php/lib/Template/footer.php'; ?>

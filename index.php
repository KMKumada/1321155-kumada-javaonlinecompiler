<?php

namespace joc;

require_once __DIR__ . '/php/vendor/autoload.php';
use joc\Template\Template;
use joc\Util\Util;

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


if (Util::isLogin()) {
  if ($_SESSION['account']['role'] === 'student') {
    Util::localRedirect('/index.html');
  } else {
    Util::localRedirect('/teacher-list.php');
  }
}

Template::$title = null;
Template::$css[] = 'index.css';
Template::$js[] = 'index.js';

include __DIR__ . '/php/lib/Template/header.php';
  
?>

<div class="container">
  <div class="row v-align-wrapper">
    <div class="v-align">
      <div class="col-md-6">
        <p>
          <h1>
            Kait-takanolab<br>
            java online compiler
          </h1>
        </p>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <h2 class="text-center">Signin</h2>
            <hr>
            <form method="post" action="php/signin.php">
              <div class="form-group row">
                <div id="role-selecter" class="btn-group col-xs-12" data-toggle="buttons">
                  <label class="btn btn-default active">
                    <input type="radio" name="role" autocomplete="off" value="student" checked> 学生
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="role" autocomplete="off" value="teacher"> 教師
                  </label>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-xs-8">
                  <label>ID</label>
                  <input class="form-control" type="text" name="user_id" placeholder="1699999 or My_ID" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-xs-8">
                  <label>パスワード</label>
                  <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
              </div>
              <?php if (isset($_GET['permit']) && $_GET['permit'] === 'no') { ?>
                <div class="alert alert-danger">IDかパスワードに誤りがあります</div>
              <?php } ?>
              <button class="btn btn-default" type="submit">サインイン</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include __DIR__ . '/php/lib/Template/footer.php';
?>
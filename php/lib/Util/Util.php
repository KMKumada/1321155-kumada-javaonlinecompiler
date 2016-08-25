<?php

namespace joc\Util;

class Util
{
  /**
   * ページリダイレクト
   * @param  string $url [description]
   * @example localRedirect('/index.php')
   */
  public static function localRedirect($url) {
    header('Location: ' . self::getDocRoot() . $url);
    exit;
  }
  
  public static function getDocRoot() {
    return preg_replace('%(.+)(?<!php)/(?<=/).+%', "$1", self::getAccessURL());
  }
  
  public static function getAccessURL() {
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
      $protocol = 'https://';
    }else{
      $protocol = 'http://';
    }
    return $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  }
  
  public function isLogin() {
    return session_status() === PHP_SESSION_ACTIVE
    && isset($_SESSION)
    && isset($_SESSION['account'])
    && isset($_SESSION['account']['user_id'])
    && isset($_SESSION['account']['role']);
  }
}
<?php

namespace joc\Model;

use PDO;

class Base
{
  /**
   * DB への接続情報
   */
  private static $db_params = [
    'dbhost' => 'localhost',
    'dbname' => 'java_cloud',
    'dbuser' => 'root',
    'dbpass' => ''
  ];

  /**
   * Database Handler
   */
  protected static $dbh;

  public function __construct() {
    $this->initDB();
  }

  /**
   * DB 接続の初期化
   */
  private function initDB() {
    $dsn = sprintf(
      'mysql:host=%s;dbname=%s;charset=utf8;',
      self::$db_params['dbhost'],
      self::$db_params['dbname']
    );
    try {
      self::$dbh = new PDO(
        $dsn,
        self::$db_params['dbuser'],
        self::$db_params['dbpass'],
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
          PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
        ]
      );
    } catch (PDOException $e) {
      exit('Deatabase connection error: ' . $e->getMessage());
    }
  }

  /**
  * クエリ実行
  * カラム、テーブル名はプレースホルダで指定できないので注意
  * @param  string $sql
  * @param  array $params
  * @return PDOStatement
  * @example execute('SELECT * FROM a WHERE b=? AND c=?', [$b, $c]);
  */
  public function execute($sql, array $params = []) {
    $stmt = self::$dbh->prepare($sql);
    if ($params) {
      foreach ($params as $key => $value) {
        $type = $this->getPdoType($value);
        $key = is_int($key) ? ++$key : $key;
        $stmt->bindValue($key, $value, $type);
      }
    }
    $stmt->execute();
    return $stmt;
  }

  private function getPdoType($value) {
    if (is_null($value)) {
      return PDO::PARAM_NULL;
    } elseif (is_int($value)) {
      return PDO::PARAM_INT;
    } else {
      return PDO::PARAM_STR;
    }
  }

}

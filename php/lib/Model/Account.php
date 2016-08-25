<?php

namespace joc\Model;

class Account extends Base
{
  /**
   * アカウントの存在確認
   * @param string $role 学生|教師
   * @param string $id
   * @param string $pw
   * @return int 一致した行数
   */
  public function permit($role, $user_id, $pw) {
    if ($role === 'student') {
      // $id = (int)$id;
      settype($user_id, 'int');
    }

    try {
      $sql = 'SELECT * FROM ' . $role . ' WHERE id = ? AND password = ?';
      // デモ動作ではパスワードのハッシュ化を行わない
      // $stmt = $this->execute($sql, [$id, $this->encodePassword($pw)]);
      $stmt = $this->execute($sql, [$user_id, $pw]);
    } catch (Exception $e) {
      throw new Exception($e);
    }

    return $stmt->rowCount();
  }

  /**
   * パスワードのハッシュ化
   * @param  string $password
   * @return string
   */
  public function encodePassword($password) {
    return hash('sha512', $password);
  }
}

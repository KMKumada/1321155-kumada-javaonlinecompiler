<?php

namespace joc\Model;

class Exercise extends Base
{
  public function getList() {
  }

  public function getContent($id) {
    try {
      $sql = 'SELECT content
              FROM exercise
              WHERE id = ?';
      $stmt = $this->execute($sql, [$id]);
    } catch (Exception $e) {
      throw new Exception($e);
    }

    return $stmt->fetch()['content'];
  }
}
<?php

namespace joc\Model;

class Result extends Base
{
  /**
   * 指定した学籍番号と課題番号に合致する最新データを取得
   * @param  int $student_id
   * @param  int $exercise_id
   * @return array
   */
  public function getRecentData($student_id, $exercise_id) {
    if (is_int($student_id) != true) settype($student_id, 'int');
    if (is_int($exercise_id) != true) settype($exercise_id, 'int');
    try {
      $sql = 'SELECT counter
                     content,
                     judge,
                     type,
                     stdout,
                     stderror
                FROM result
               WHERE student_id = ?
                 AND exercise_id = ?
                 AND counter =
                   (SELECT Max(counter)
                      FROM result
                     WHERE student_id = ?
                       AND exercise_id = ?
                     GROUP BY student_id)';
      $stmt = $this->execute($sql, [$student_id, $exercise_id, $student_id, $exercise_id]);
    } catch (Exception $e) {
      throw new Exception($e);
    }

    return $stmt->fetch();
  }

  /**
   * 指定した課題番号における生徒の最新データ一覧を取得
   * @param  int $exercise_id
   * @return array
   */
  public function getDataList($exercise_id) {
    if (is_int($exercise_id) != true) settype($exercise_id, 'int');
    try {
      $sql = 'SELECT student_id,
                     counter,
                     judge,
                     create_time
                FROM result
               WHERE exercise_id = ?
                 AND (student_id,counter) IN (SELECT student_id,
                                                     Max(counter)
                                                FROM result
                                               WHERE exercise_id = ?
                                               GROUP BY student_id)';
      $stmt = $this->execute($sql, [$exercise_id, $exercise_id]);
    } catch (Exception $e) {
      throw new Exception($e);
    }
    return $stmt->fetchAll();
  }

}
$(function() {
  getStudentList();
  setInterval(function() {
    clearStudentList();
    getStudentList();
  }, 10000);
});

function getStudentList() {
  $.ajax({
    type: "POST",
    url: "php/get-student-list.php",
    timeout: 10000,
    data: null,
    dataType: "json"
  })
  .then(
    function (data) {
      createStudentList(data);
    },
    function (e) {
      console.log(e);
    });
  }

  function createStudentList(data) {
    var list_item_str = '<li><a href="#" class="btn btn-default"><p class="text-left card-text">学籍番号： <span class="list_student_id"></span> 判定： <span class="list_judge"></span> 実行回数： <span class="list_counter"></span> 最終実行： <span class="list_create_time"></span></p></a></li>';

    var list_opt = {
      valueNames: [
        "list_student_id",
        "list_judge",
        "list_counter",
        "list_create_time"
      ],
      item: list_item_str
    };

    var list_val = [];
    for (var i = 0, len = data.length; i < len; i++) {
      list_val.push({
        list_student_id: data[i].student_id,
        list_judge: data[i].judge,
        list_counter: data[i].counter,
        list_create_time: data[i].create_time
      });
    }

    var student_list = new List("student_list", list_opt, list_val);
  }

function clearStudentList() {
  var student_list = new List("student_list");
  student_list.clear();
}

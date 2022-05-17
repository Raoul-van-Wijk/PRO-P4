function getMsg (fromUser) {
$(document).ready(function() {
  setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
    var func = 'get-msg'
    $("#chat").load("http://www.project-p4.gg/lib/functions/ajax-controller", {
      func: func,
      fromUser: fromUser
    });
}, 100);
});
}

function sendMsg () {
  $(document).ready(function() {
      var func = 'send-msg';
      var msg = $('#input-msg').val;
      var toUser = $('#to-user').val;
      $('#submit').click(function() {
      $("#chat").load("http://www.project-p4.gg/lib/functions/ajax-controller", {
        func: func,
        toUser: toUser,
        msg: msg
      });
      });
  });
}









// $.ajax('http://www.project-p4.gg/lib/functions/ajax-controller', {
//           type: 'POST',
//           data: {
//             func: func,
//             toUser: toUser
//           }
//         })
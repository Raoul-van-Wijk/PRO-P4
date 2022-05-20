
const contactButtons = document.querySelectorAll('.contact');
let userID = document.querySelector('[data-userid]').getAttribute('data-userid')

const msgInput = document.querySelector('#msg-input');


  const sendButton = document.querySelector('#send');
  sendButton.addEventListener('click', (event) => {
  let toUser = toUserID();
  let msg = msgInput.value;
  sendMsg(msg, toUser);
})

function toUserID() {
  return document.querySelector('[data-toUser]').getAttribute('data-toUser');
}


contactButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    let fuserID = button.value;
    getMsg(fuserID, userID);
  })
})



function getMsg (fromUser, userID) {
$(document).ready(function() {
    var func = 'get-msg';
    var FromUser = parseInt(fromUser);
    var UserID = parseInt(userID);
    $("#chat").load("http://www.project-p4.gg/lib/ni/ajax-controller.php", {
        func: func,
        fromUser: FromUser,
        UserID: UserID
    })
    let iid = setInterval( function() {
      $("#chat").load("http://www.project-p4.gg/lib/ni/ajax-controller.php", {
        func: func,
        fromUser: FromUser,
        UserID: UserID
    })
    
  } ,10000)
  contactButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      clearInterval(iid);
    })
  })  
});
;
}

function sendMsg (msg, toUser) {
  $(document).ready(function() {
    console.log(msg, toUser);
      var func = 'send-msg';
      $.ajax({
          url: 'http://www.project-p4.gg/lib/ni/ajax-controller.php',
          method: 'POST',
          data: {
            func: func,
            msg: msg,
            toUser: toUser,
            userID: userID
          },
          success: function() {msgInput.value = '';},
        }
      )
  });
}









// $.ajax('http://www.project-p4.gg/lib/functions/ajax-controller', {
//           type: 'POST',
//           data: {
//             func: func,
//             toUser: toUser
//           }
//         })
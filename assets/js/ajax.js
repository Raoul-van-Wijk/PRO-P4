
const contactButtons = document.querySelectorAll('.contact');
let userID = document.querySelector('[data-userid]').getAttribute('data-userid')
if(document.querySelector('[data-message-input]')) {
const msgInput = document.querySelector('[data-message-input]');


  const sendButton = document.querySelector('[data-message-button]');
  sendButton.addEventListener('click', (event) => {
  let toUser = toUserID();
  let msg = msgInput.value;
  sendMsg(msg, toUser);
  msgInput.value = '';
})

  msgInput.addEventListener('keydown', (event) => {
    if(event.key === 'Enter') {
      let toUser = toUserID();
      let msg = msgInput.value;
      console.log(msg);
      sendMsg(msg, toUser);
      msgInput.value = '';
    }
  })
}


const likeButton = document.querySelector('[data-like-profile]');
const profileName = document.querySelector('.content p').innerHTML;
const newName = profileName.split(',')

if(likeButton) {
  likeButton.addEventListener('click', (event) => {
    likeUser(newName[0]);
  })
}

function toUserID() {
  return document.querySelector('.active-user').getAttribute('data-toUser');
}


contactButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    removeClass(contactButtons, 'active-user')
    button.classList.add('active-user');
    let fuserID = button.value;
    getMsg(fuserID, userID);
  })
})



function getMsg (fromUser, userID) {
$(document).ready(function() {
    var func = 'get-msg';
    var FromUser = parseInt(fromUser);
    var UserID = parseInt(userID);
    $("[data-message]").load("http://www.project-p4.gg/lib/ni/ajax-controller.php", {
        func: func,
        fromUser: FromUser,
        UserID: UserID
    })
    let iid = setInterval( () => {
      $("[data-message]").load("http://www.project-p4.gg/lib/ni/ajax-controller.php", {
        func: func,
        fromUser: FromUser,
        UserID: UserID
    })
    
  } ,100)
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

function likeUser (username) {
  $(document).ready(function() {
      var func = 'like-user';
      $.ajax({
          url: 'http://www.project-p4.gg/lib/ni/ajax-controller.php',
          method: 'POST',
          data: {
            func: func,
            username: username
          },
          success: function(e) {
            // alert(e)
            //console.log(func, username);
          },
        }
      )
  });
}





const removeClass = (arr, className) => {
  arr.forEach((item) => {
    item.classList.remove(className)
  })
}





// $.ajax('http://www.project-p4.gg/lib/functions/ajax-controller', {
//           type: 'POST',
//           data: {
//             func: func,
//             toUser: toUser
//           }
//         })
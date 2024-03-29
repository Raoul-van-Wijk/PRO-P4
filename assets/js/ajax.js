if(document.querySelector('[data-comment]')) {
  let profileID = document.querySelector('[data-profile-id]').getAttribute('data-profile-id');
  getComment(profileID);
}

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



if (document.querySelector('[data-comment-input]')) {
  const commentEl = document.querySelector('[data-comment-input]');
  const commentButton = document.querySelector('[data-comment-button]');
  commentButton.addEventListener('click', (event) => {
    let comment = commentEl.value;
    let userID = document.querySelector('[data-userid]').getAttribute('data-userid');
    let profileID = document.querySelector('[data-profile-id]').getAttribute('data-profile-id');
    makeComment(comment, userID, profileID);
    commentEl.value = '';
  })
}



const likeButton = document.querySelector('[data-like-profile]');
let profileName = document.querySelector('.content p')
if(profileName) { 
  profileName = profileName.innerHTML;
}
const likeEl = document.querySelector('[data-like-counter]');

if(likeButton) {
  const newName = profileName.split(',')
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
            // let likes = e
            likeEl.innerHTML = e.toString();
            // console.log(e);
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


const friendButtons = document.querySelectorAll('[data-change-friend]');

if(friendButtons) {
  friendButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      let action = button.value;
      let friendID = button.getAttribute('data-change-friend');
      let userID = document.querySelector('[data-userid]').getAttribute('data-userid');
      changeFriend(userID, friendID, action);
      if(button.value == 'add') {
        button.value = 'remove';
        button.innerHTML = 'unfriend';
      } else {
        button.value = 'add';
        button.innerHTML = 'Add Friend';
      }
    })
  })
}


function changeFriend (userID, friend, action) {
  $(document).ready(function() {
      var func = 'change-friend';
      $.ajax({
          url: 'http://www.project-p4.gg/lib/ni/ajax-controller.php',
          method: 'POST',
          data: {
            func: func,
            userID: userID,
            friend: friend,
            action: action
          },
          success: function(e) {
            console.log(e);
          },
        }
      )});
  }

  function makeComment(comment, userID, profileID) {
    $(document).ready( () => {
      var func = 'make-comment';
      $.ajax({
        url: 'http://www.project-p4.gg/lib/ni/ajax-controller.php',
        method: 'POST',
        data: {
          func: func,
          comment: comment,
          userID: userID,
          profileID: profileID
        },
        success: function(e) {
          console.log(e);
      }
    })
  })
}

function getComment(profileID) {
  $(document).ready(function() {
      var func = 'get-comment';
      $("[data-comment]").load("http://www.project-p4.gg/lib/ni/ajax-controller.php", {
        func: func,
        profileID: profileID
      })
  });
}



// $.ajax('http://www.project-p4.gg/lib/functions/ajax-controller', {
//           type: 'POST',
//           data: {
//             func: func,
//             toUser: toUser
//           }
//         })
/* function to check if input box is empty  */

let bottom = document.querySelector(".focus");
let text = document.querySelector(".input_msg");

bottom.focus();
text.focus();

function checkValue() {
  let send_btn = document.querySelector(".send_msg");

  if (text.value.length < 1) {
    send_btn.disabled = true;
    send_btn.style.opacity = 0.6;
  } else {
    send_btn.disabled = false;
    send_btn.style.opacity = 1;
  }
}

let id = setInterval(checkValue, 500);

// function to send post request using AJAX
function sendString() {
  let msg = document.querySelector(".input_msg").value;

  let xhr = new XMLHttpRequest();

  xhr.open("POST", "sendMsg.php", true);

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  //function to check request status
  //xhr.onreadystatechange = function(){
  //alert(this.readyState)}

  xhr.send("text=" + msg);
  bottom.focus();
  text.focus();

  text.value = "";
}

/*
 //      function to update chats in real time

      setInterval(updateThreads,1000);

				function  updateThreads(){

				var obj = new XMLHttpRequest();

				obj.open("POST","getChat.php",true);
				obj.onload = function(){
				let data = obj.responseText;
       let main = document.querySelector(".main")
       main.innerHTML = data;
text.focus();
}
obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

       obj.send("room_name=<?php echo $room ; ?>&&user_id=<?php echo $user; ?>");

				}
*/

//enable full screen

document.onclick = () => {
  // let screen = document.documentElement;

  screen.requestFullscreen().catch((err) => {
    alert("error" + err.name);
  });
};

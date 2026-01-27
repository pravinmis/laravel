import './bootstrap';

const userId = document.querySelector('meta[name="user-id"]').content;

const csrf   = document.querySelector('meta[name="csrf-token"]').content;

console.log("Echo:", window.Echo);




window.Echo.private("single-chat." + userId)
    .subscribed(() => {
        console.log("✅ Joined private channel: single-chat." + userId);
    })
    .listen(".message.single", (e) => {

        
        console.log("🔥 Message Received:", e);


          let box = document.getElementById('chat-box');
  if (e.fromId == userId){
        box.innerHTML += `<div class="msg me">${e.message}</div>`;
    } else {
        box.innerHTML += `<div class="msg other">${e.message}</div>`;
    }


       
        // box.innerHTML += `<div class="msg other">${e.message}</div>`;
    });


/////////////////////////////////////////public channel 



window.Echo.channel("single-chat")
    .subscribed(() => {
        console.log("✅ Subscribed to single-chat");
    })
    .error((e) => {
        console.error("❌ Subscription error", e);
    })
    .listen(".message.single", (e) => {
        console.log("🔥 Event Received:", e);
    });


window.Echo.channel("single-chat")
    .listen(".message.single", (e) => {
        console.log("Public Message:", e.message);

        let box = document.getElementById('chat-box');
        box.innerHTML += `<div class="msg other">${e.message}</div>`;
    });




// ===== SEND MESSAGE =====
window.sendMessages = function(){

   let  toUserId = document.getElementById('to_user').value;

    console.log(toUserId);
  let message = document.getElementById('message').value;
   // console.log(message);

   

    fetch('/chat/single_send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({
            
            message: message,
            toUserId: toUserId
        })
    });

   
};
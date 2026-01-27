import './bootstrap';
import { initNotifications } from './notification';

const userId = document.querySelector('meta[name="user-id"]').content;
console.log(userId);
initNotifications(userId);

const csrf   = document.querySelector('meta[name="csrf-token"]').content;
 const chatBox = document.getElementById('chat-box');
   

// ===== STATE =====
let groupId = null;
let channel = null;

// ===== OPEN GROUP CHAT =====
window.openGroup = function(id){

    

    // Leave old group
    if(channel && groupId){
        Echo.leave(`group.${groupId}`);
    }

    groupId = id;

   

    // Clear chat box
    document.getElementById('chat-box').innerHTML = '';
    /////////////////////////////////////////////////////////////

function renderOnlineUsers(users){
    const list = document.getElementById('online-list');
    list.innerHTML = '';

    users.forEach(u => {
        if(u.id == userId) return; // khud ko mat dikhao

        const div = document.createElement('div');
        div.innerText = u.name;
        div.style.cursor = 'pointer';
        div.style.padding = '5px';

        div.onclick = () => openPrivateChat(u.id, u.name);

        list.appendChild(div);
    });
}

/////////////////////////////////////////////////////////////////////////////////





    // Join new group
    channel = Echo.join(`group.${groupId}`)

        .here(users => {
            console.log('Online users:', users);
            renderOnlineUsers(users);
        })

        .joining(user => {
            console.log(user.name, 'joined');
        })

        .leaving(user => {
            console.log(user.name, 'left');
        })

        // ===== RECEIVE MESSAGE =====
        .listen('.group.message', e => {
            addMessage(e.message);

            // Mark delivered
            fetch(`/chat/delivered`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    group_id: groupId,
                    message_id: e.message.id
                })
            });
        })

        // ===== TYPING INDICATOR =====
        .listen('.typing', e => {
            const typingDiv = document.getElementById('typing');
            typingDiv.innerText = `${e.user.name} is typing...`;

            setTimeout(() => {
                typingDiv.innerText = '';
            }, 1000);
        })

        // ===== MESSAGE DELIVERED =====
        .listen('.message.delivered', e => {
           // alert('hello');
            document.querySelectorAll('.tick').forEach(t => {
                t.innerText = '✔✔';
            });
        })

        // ===== MESSAGE SEEN =====
        .listen('.message.seen', e => {
    const tick = document.getElementById(`tick-${e.message_id}`);
    if(tick){
        tick.innerText = '✔✔ Seen';
    }
});




      // ===== WHEN OPEN GROUP MARK SEEN =====
   // ✅ WHEN OPEN GROUP MARK SEEN (ONLY RECEIVER)
setTimeout(() => {
    fetch('/chat/seen', {
        method: 'POST',
        headers: {
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':csrf
        },
        body: JSON.stringify({
            group_id: groupId
        })
    });
}, 300);




 fetch(`/chat/load`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({
                group_id: groupId,
                user_id: userId
            })
        })
        .then(response => response.json())
        .then(data => {
              console.log(data);
            chatBox.innerHTML = ''; // Clear chat box
            data.message.forEach(msg => {

                
                const p = document.createElement('p');
                p.innerHTML = `<b>${msg.user.name}</b>: ${msg.message}`;
                chatBox.appendChild(p);
            });

            // Scroll to bottom
            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(error => console.error('Error:', error));


};





// ===== SEND MESSAGE =====
window.sendMessage = function(){

    if(!groupId || !message.value.trim()){
        alert('Select group and type message');
        return;
    }

    fetch('/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({
            group_id: groupId,
            message: message.value
        })
    });

    message.value = '';
};


// ===== TYPING EVENT =====
window.typing = function(){

    if(!groupId) return;

    fetch('/chat/typing', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({
            group_id: groupId
        })
    });
};


// ===== ADD MESSAGE TO UI =====
// ===== ADD MESSAGE TO UI =====
function addMessage(msg){

    const div = document.createElement('div');

    // Tick only for sender
    let tickHtml = '';

    if(msg.user.id == userId){
        tickHtml = `<span class="tick" id="tick-${msg.id}">✔</span>`;
    }

    div.innerHTML = `
        <b>${msg.user.name}:</b> ${msg.message}
        ${tickHtml}
    `;

    document.getElementById('chat-box').appendChild(div);
}

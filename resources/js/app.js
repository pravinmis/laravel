import './bootstrap';
console.log('app.js loaded');

// ===== META =====
const userId = document.querySelector('meta[name="user-id"]').content;
const csrf   = document.querySelector('meta[name="csrf-token"]').content;

let groupId = null;
let channel = null;

window.openGroup = function(id){
    if(channel) Echo.leave(`group.${groupId}`);

    groupId = id;

    channel = Echo.join(`group.${groupId}`)

        .here(users => console.log('Online:',users))

        .joining(user => console.log(user.name,'joined'))

        .leaving(user => console.log(user.name,'left'))

        .listen('.group.message', e => {
            addMessage(e.message);
        })

        .listen('.typing', e => {
            document.getElementById('typing').innerText =
                `${e.user.name} is typing...`;
            setTimeout(()=>typing.innerText='',1000);
        });
}

window.sendMessage = function(){
    fetch('/chat/send',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':csrf
        },
        body:JSON.stringify({
            group_id:groupId,
            message:message.value
        })
    });
    message.value='';
}

window.typing = function(){
    fetch('/chat/typing',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':csrf
        },
        body:JSON.stringify({group_id:groupId})
    });
}

function addMessage(msg){
    const div = document.createElement('div');
    div.innerHTML = `<b>${msg.user.name}:</b> ${msg.message}`;
    document.getElementById('chat-box').appendChild(div);
}
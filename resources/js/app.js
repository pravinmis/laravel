import './bootstrap';
console.log('app.js loaded');

// ===== META =====
const userId = document.querySelector('meta[name="user-id"]').content;
const csrf   = document.querySelector('meta[name="csrf-token"]').content;

// 👉 URL se aata hai
// /chat/{toId}
const toId = window.location.pathname.split('/').pop();

// ===== ECHO LISTENER =====
window.Echo.private(`chat.${userId}`)

.listen('.message.sent', e => {
    console.log('Message received', e.message);

    addMessage(e.message, false);

    // 👉 Delivered
    fetch(`/chat/delivered/${e.message.id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf
        }
    });
})

.listen('.message.delivered', e => {
    const tick = document.getElementById(`tick-${e.messageId}`);
    if (tick) tick.innerText = '✔✔';
})

.listen('.message.seen', () => {
    document.querySelectorAll('.tick').forEach(t => {
        t.innerText = '✔✔ Seen';
    });
})

.listen('.user.typing', () => {
    const typingDiv = document.getElementById('typing');
    typingDiv.innerText = 'Typing...';

    clearTimeout(window.typingTimer);
    window.typingTimer = setTimeout(() => {
        typingDiv.innerText = '';
    }, 1000);
});

// ===== PAGE LOAD → SEEN =====
window.onload = function () {
    fetch(`/chat/seen/${toId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf
        }
    });
};

// ===== SEND MESSAGE =====
window.sendMessage = function () {
    const input = document.getElementById('message');

    if (!input.value.trim()) return;

    fetch('/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({
            to_id: toId,
            message: input.value
        })
    });

    // Sender side message
    addMessage({ message: input.value, id: Date.now() }, true);
    input.value = '';
};

// ===== TYPING =====
window.typing = function () {
    fetch('/chat/typing', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({ to_id: toId })
    });
};

// ===== UI =====
function addMessage(msg, isSender) {
    const div = document.createElement('div');
    div.style.margin = '5px';
    div.style.textAlign = isSender ? 'right' : 'left';

    div.innerHTML = `
        ${msg.message}
        ${isSender ? `<span class="tick" id="tick-${msg.id}">✔</span>` : ''}
    `;

    document.getElementById('chat-box').appendChild(div);
}

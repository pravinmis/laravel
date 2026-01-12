export function initNotifications(userId) {
    const notiList = document.getElementById('notification-list');
    const notiCount = document.getElementById('noti-count');

    window.Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
          //  alert('jhjhjhjh');
            const li = document.createElement('li');
            li.innerHTML = `
                <a href="#" class="dropdown-item mark-read" data-id="">
                    ${notification.message}
                </a>
            `;
            notiList.prepend(li);
            notiCount.innerText = parseInt(notiCount.innerText) + 1;
        });

    // Mark as read
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('mark-read')){
            e.preventDefault();
            const id = e.target.dataset.id;

            fetch(`/notification-read/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            e.target.parentElement.remove();
            notiCount.innerText = Math.max(0, parseInt(notiCount.innerText) - 1);
        }
    });
}

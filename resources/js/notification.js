export function initNotifications() {
    const meta = document.querySelector('meta[name="user-id"]');
    if (!meta) return;

    const userId = meta.getAttribute('content');

    Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            console.log('New notification:', notification);

            let count = document.getElementById('notify-count');
            if (count) {
                count.innerText = parseInt(count.innerText) + 1;
            }

            let list = document.getElementById('notify-list');
            if (list) {
                list.innerHTML =
                    `<li class="dropdown-item">${notification.message}</li>` +
                    list.innerHTML;
            }
        });
}

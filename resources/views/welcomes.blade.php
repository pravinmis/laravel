<!DOCTYPE html>
<html>
<head>
    <title>Pusher Test</title>
</head>
<body>
    <h1>Laravel 12 Pusher Test</h1>
    <button id="notifyBtn">Send Notification</button>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
            forceTLS: true
        });

        var channel = pusher.subscribe('public-channel');

        channel.bind('new.notification', function(data) {
            console.log("Received:", data);
            alert(data.message);
        });

        document.getElementById('notifyBtn').addEventListener('click', function() {
            fetch('/notify');
        });
    </script>
</body>
</html>

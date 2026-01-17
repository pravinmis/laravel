<!DOCTYPE html>
<html>
<head>
    <title>Mini Google Meet</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ $user->id }}">

    @vite(['resources/js/app.js'])
</head>
<body>

<h3>Room: {{ $room }}</h3>

<div id="videos" height="300px" width="300px"></div>

<hr>

<button onclick="toggleMute()">🎤 Mute</button>
<button onclick="toggleCamera()">📷 Camera</button>
<button onclick="shareScreen()">🖥 Screen</button>
<button onclick="leaveRoom()">❌ Leave</button>

<script>
    window.ROOM_ID = "{{ $room }}";
    window.USER_ID = "{{ $user->id }}";
    window.CSRF = "{{ csrf_token() }}";

    console.log("Blade Injected:", window.ROOM_ID, window.USER_ID);
</script>


</body>
</html>

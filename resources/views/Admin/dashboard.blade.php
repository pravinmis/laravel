<!DOCTYPE html>
<html>
<head>
    <meta name="admin-id" content="{{ auth()->id() }}">
    <title>Admin Dashboard</title>

    @vite('resources/js/app.js')
</head>
<body>
    <h1>Admin Dashboard</h1>
    <span id="notification-count" style="display:none;">0</span>

<ul id="notification-list"></ul>
</body>
</html>

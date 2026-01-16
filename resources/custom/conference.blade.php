<!-- resources/views/conference.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Video Conference</title>
</head>
<body>
    <h2>Laravel Video Conference</h2>

    <iframe src="https://meet.jit.si/{{ $room }}" 
        style="height: 600px; width: 100%; border: 0;" allow="camera; microphone; fullscreen; display-capture"></iframe>

</body>
</html>

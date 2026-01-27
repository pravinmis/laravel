<form method="POST" action="{{ route('audio.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Audio Title" required>

    <input type="file" name="audio" required>
    @error('audio')
     {{$message}}
    @enderror

    <button type="submit">Upload</button>
</form>

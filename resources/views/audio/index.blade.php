<table border="1">
    <tr>
        <th>Title</th>
        <th>Audio</th>
        <th>Duration</th>
    </tr>

    @foreach($audios as $audio)
    <tr>
        <td>{{ $audio->title }}</td>
        <td>
            <audio controls>
                <source src="{{ asset('storage/'.$audio->file) }}">
            </audio>
        </td>
        <td>{{ $audio->duration }}</td>
    </tr>
    @endforeach
</table>

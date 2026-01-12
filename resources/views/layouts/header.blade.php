<meta name="user-id" content="{{ auth()->id() }}">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <ul class="navbar-nav ms-auto">
            @role('admin')
           <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle position-relative" href="#" data-bs-toggle="dropdown">
        🔔
        <span id="noti-count" class="badge bg-danger">
            {{ auth()->user()->unreadNotifications->count() }}
        </span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end" id="notification-list">
        @foreach(auth()->user()->unreadNotifications as $n)
            <li>
                <a href="#" class="dropdown-item mark-read" data-id="{{ $n->id }}">
                    {{ $n->data['message'] }}
                </a>
            </li>
        @endforeach
    </ul>
</li>
@endrole
        </ul>

    </div>
</nav>

<!-- 🔊 Sound -->
<audio id="notify-sound" preload="auto">
    <source src="{{ asset('sounds/notification.mp3') }}" type="audio/mpeg">
</audio>

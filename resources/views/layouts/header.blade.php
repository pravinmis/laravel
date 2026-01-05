<meta name="user-id" content="{{ auth()->id() }}">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle position-relative"
                   href="#"
                   role="button"
                   data-bs-toggle="dropdown"
                   aria-expanded="false"
                   id="notification-bell">
                 
                    🔔
                   
                    <span id="notify-count"
                          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                      @auth   {{ auth()->user()->unreadNotifications->count() }}   @endauth
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end"
                    id="notify-list"
                    style="width:300px">
            @auth
                    @foreach(auth()->user()->unreadNotifications as $notification)
                        <li class="dropdown-item d-flex justify-content-between align-items-center"
                            data-id="{{ $notification->id }}">

                            {{ $notification->data['message'] }}

                            <button class="btn btn-sm btn-link text-success mark-read">
                                ✓
                            </button>
                        </li>
                    @endforeach
                    @endauth
                </ul>
              
            </li>
        </ul>

    </div>
</nav>

<!-- 🔊 Sound -->
<audio id="notify-sound" preload="auto">
    <source src="{{ asset('sounds/notification.mp3') }}" type="audio/mpeg">
</audio>

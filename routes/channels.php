<?php

use Illuminate\Support\Facades\Broadcast;

// routes/channels.php
Broadcast::channel('chat.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});


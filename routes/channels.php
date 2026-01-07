<?php

use Illuminate\Support\Facades\Broadcast;

// routes/channels.php
// Broadcast::channel('chat.{id}', function ($user, $id) {
//     return (int)$user->id === (int)$id;
// });

Broadcast::channel('group.{groupId}', function ($user, $groupId) {

    \Log::info(['group_id'=>$groupId,'user_id'=>$user->id]);
    return \DB::table('group_user')
        ->where('group_id',$groupId)
        ->where('user_id',$user->id)
        ->exists()
        ? ['id'=>$user->id,'name'=>$user->name]
        : false;
});

<?php

namespace App\Http\Controllers;

use App\Events\AdminNotification;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use App\Models\User;
use App\Models\Message;
use App\Events\UserTyping;
use App\Events\MessageSent;
use App\Events\MessageDelivered;
use App\Events\SingleChatEvent;
use App\Events\MessageSeen;
use App\Models\Group;


class NotificationController extends Controller
{

public function store(Request $request)
{
    // user create / order save logic

    $adminId = 3; // ya database se

    event(new AdminNotification(
        $adminId,
        'New user registered'
    ));

    return response()->json(['status' => 'ok']);
}



    public function send(Request $request)
    {
      // dd(auth()->id());

         $msg = Message::create([
            'group_id'=>$request->group_id,
            'user_id'=>auth()->id(),
            'message'=>$request->message
        ]);
          // dd($message);
        broadcast(new MessageSent($msg))->toOthers();

        return response()->json($message);
    }

    


 public function delivered(Request $request)
{
    // Validate
    $request->validate([
        'group_id'   => 'required',
        'message_id' => 'required'
    ]);

    // Update only that message
    Message::where('id', $request->message_id)
        ->where('group_id', $request->group_id)
        ->where('user_id', '!=', auth()->id())
        ->update([
            'delivered' => true
        ]);

    // Broadcast event
    broadcast(new MessageDelivered(
        $request->message_id,
        $request->group_id
    ))->toOthers();

    return response()->json(['ok' => true]);
}



  public function seen(Request $request)
{
    $userId = auth()->id();
    $groupId = $request->group_id;

    // ❗ Only messages NOT sent by me and NOT seen yet
    $messages = Message::where('group_id', $groupId)
        ->where('user_id', '!=', $userId)   // not my message
        ->where('seen',false)              // not seen yet
        ->get();

    foreach ($messages as $msg) {+
        $msg->seen = true;
        $msg->save();

        // 🔥 Notify ONLY SENDER
        broadcast(new MessageSeen($msg->id, $msg->group_id, $msg->user_id))->toOthers();
    }

    return response()->json(['status' => 'ok']);
}



    public function typing(Request $request)
    { ////dd(auth()->id());
        broadcast(new UserTyping(auth()->id(), $request->group_id))->toOthers();
    }


    
    public function chat()
    {
        // $me = auth()->id();

        // // Safety
        // abort_if($me == $userId, 403);

        // // Opposite user
        // $user = User::findOrFail($userId);

        // // 🔥 Messages between A & B
        // $messages = Message::where(function ($q) use ($me, $userId) {
        //         $q->where('from_id', $me)
        //           ->where('to_id', $userId);
        //     })
        //     ->orWhere(function ($q) use ($me, $userId) {
        //         $q->where('from_id', $userId)
        //           ->where('to_id', $me);
        //     })
        //     ->orderBy('id')
        //     ->get();
          $message = Message::with('user')->get();
        //  dd($message);
         $groups = Group::all();
        return view('chat',with(['groups'=>$groups,'messages'=>$message]));
    }



    public function markRead(Request $request)
    {
        $id = $request->notification_id;
       //  dd($id);
        $notification = auth()->user()
            ->unreadNotifications()
            ->where('id', $id)
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }


    public function chat_loaded(Request $request){
//dd($request->group_id,$request->user_id);

        $message = Message::with('user')
    ->where('group_id', $request->group_id)
    ->get();

        
      //  dd($message);
        return response()->json(['message'=>$message]);
    }



    public function single_chat($id)
    {    // dd($id);
        return view('chat_single',compact('id'));
    }

    public function single_send(Request $request){

             //  dd($request->toUserId,$request->message,auth()->id());
        broadcast(new SingleChatEvent(auth()->id(),$request->toUserId,$request->message));

     
        return response()->json(['successfully']);
       // dd($request->message);

    }
}
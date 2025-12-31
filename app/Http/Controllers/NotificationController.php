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
use App\Events\MessageSeen;


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
       //dd('hello');

        $message = Message::create([
            'from_id' => auth()->id(),
            'to_id'   => $request->to_id,
            'message' => $request->message
        ]);
          // dd($message);
        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }

    public function delivered($id)
    {
        $msg = Message::find($id);

        if ($msg && !$msg->delivered_at) {
            $msg->update(['delivered_at' => now()]);
            broadcast(new MessageDelivered($msg->id, $msg->from_id));
        }
    }

    public function seen($userId)
    {
       // dd($userId);
      // \Log::info(['user_id'=> $userId]);
       
     $message  =    Message::where('from_id',$userId)
            ->where('to_id',auth()->id())
            ->whereNull('seen_at')
            ->update(['seen_at'=>now()]);
          
          //  dd($message);
        broadcast(new MessageSeen($userId));
    }

    public function typing(Request $request)
    {
        broadcast(new UserTyping(auth()->id(), $request->to_id))->toOthers();
    }


    
    public function chat($userId)
    {
        $me = auth()->id();

        // Safety
        abort_if($me == $userId, 403);

        // Opposite user
        $user = User::findOrFail($userId);

        // 🔥 Messages between A & B
        $messages = Message::where(function ($q) use ($me, $userId) {
                $q->where('from_id', $me)
                  ->where('to_id', $userId);
            })
            ->orWhere(function ($q) use ($me, $userId) {
                $q->where('from_id', $userId)
                  ->where('to_id', $me);
            })
            ->orderBy('id')
            ->get();

        return view('chat', compact('user', 'messages'));
    }

}
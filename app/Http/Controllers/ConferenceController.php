<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SignalEvent;

class ConferenceController extends Controller
{
    public function room($room)
    {
      //dd(auth()->id());
        return view('room', [
            'room' => $room,
            'user' => auth()->user()
        ]);
    }

   public function signal(Request $request)
{
  //  dd($request->data);
    broadcast(new SignalEvent(
        $request->room,
        auth()->id(),
        $request->data
    ))->toOthers();

    return response()->json(['ok' => true]);
}

}

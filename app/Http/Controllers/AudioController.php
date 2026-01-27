<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audio;
use getID3;
use App\Helpers\fun;

class AudioController extends Controller
{
    public function create()
    {
        return view('audio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'audio' => 'required|mimes:mp3,wav,m4a'
        ]);

        // Upload file
        $file = $request->file('audio');
        $path = $file->store('audios', 'public');
dd($path);
        // Get duration
        $getID3 = new \getID3;
        $fileInfo = $getID3->analyze(storage_path('app/public/' . $path));
        $duration = gmdate("H:i:s", $fileInfo['playtime_seconds']);

        // Save to DB
        Audio::create([
            'title' => $request->title,
            'file' => $path,
            'duration' => $duration,
        ]);

        return redirect('audio-list')->with('success', 'Audio uploaded successfully');
    }

    public function index()
    {
        $audios = Audio::all();
        return view('audio.index', compact('audios'));
    }


    public function distance(){

       return view('audio.distance');
    }

    public function calculate(Request $request)
    {
        $distance = distanceBetweenTwoPoints(
            $request->lat1,
            $request->lng1,
            $request->lat2,
            $request->lng2
        );
     //dd($distance);
        return view('audio.distance', compact('distance'));
    }

    
}

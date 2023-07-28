<?php

namespace App\Http\Controllers;

use App\Events\VideoViewers;
use App\Models\Video;

class VideoController extends Controller
{
    public function getViewers()
    {
        $video=Video::first();
        event(new VideoViewers($video));
        return view('eventliseners.video',compact('video'));
    }
}

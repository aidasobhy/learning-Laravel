<?php

namespace App\Listeners;

use App\Events\VideoViewers;
use App\Models\Video;

class IncreaseViewers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewers $event)
    {
        if(!session()->has('VideoIsVisited'))
        {
            $this->updateViewer($event->video);
        }else
        {
            return false;
        }

    }

    private function updateViewer($video)
    {
        $video->video_viewers=$video->video_viewers+1;
        $video->save();
        session()->put('VideoIsVisited',$video->id);
    }
}

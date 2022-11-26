<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function show(Channel $channel)
    {
        $threads = $channel->threads()->paginate(25);
        $channels = Channel::get();

        return view('threads.channels.show', ['threads' => $threads, 'channels' => $channels, 'channel' => $channel]);
    }
}

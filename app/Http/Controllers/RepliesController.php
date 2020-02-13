<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($channelId, Thread $thread)
    {
        $this->validate(request(),
            [
                'body' => 'required'
            ]);

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    /**
     * @param Reply $reply
     * @return ResponseFactory|RedirectResponse|Response
     * @throws \Exception
     */
    public function destroy(Reply $reply)
    {

        $this->authorize('update', $reply);
        $reply->delete();
        return back();

    }

}

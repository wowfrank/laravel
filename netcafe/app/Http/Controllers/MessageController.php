<?php

namespace Netcafe\Http\Controllers;

use Illuminate\Http\Request;

use Netcafe\Http\Requests;
use Netcafe\Http\Controllers\Controller;

use Netcafe\Models\Message;
use Netcafe\Http\Requests\MessageCreateRequest;


class MessageController extends Controller
{
    // this will list all messages we saved in our database
    public function listMessages() {

    	return view('message.list')
    				->withMessages(Message::orderBy('created_at', 'desc')->paginate(config('home.numOfMessages')));
    }

    // this will store a single message to our database
    // @param $request
    public function storeMessage(MessageCreateRequest $request) {
    	if(!$request->ajax()) {
    		$message = Message::create($request->all());
    		$message->msg_ip = $request->ip();
    		$message->save();

            return redirect()
                ->route('message.list')
                ->withSuccess(trans('messages.New Message Successfully Created.'));
    	}
    }
}

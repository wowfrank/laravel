<?php

namespace Netcafe\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Redirect;
use Validator;
use Netcafe\Http\Requests;
use Netcafe\Http\Controllers\Controller;
use Netcafe\Http\Requests\ContactMeRequest;

class ContactController extends Controller
{
    //
    /**
	 * Email the contact request
	 *
	 * @param ContactMeRequest $request
	 * @return Redirect
	 */
	public function sendContactInfo(ContactMeRequest $request)
	{
		
		$data = $request->only('name', 'email', 'subject');
		$data['messageLines'] = explode("\n", $request->get('message'));

		Mail::send('admin.emails.contact', $data, function ($message) use ($data) {
						$message->subject('Netcafe Contact Form: '.$data['name'])
							->to(config('blog.contactEmail'))
							->replyTo($data['email']);
		});

		return redirect('/#contact-form')
			->withSuccess(trans('messages.Thank you for your message . It has been sent.') );
		
	}
}

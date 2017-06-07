<?php namespace Milo\Receipt\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Milo\Receipt\Models\Comment;
use Milo\Receipt\Models\Receipt;
use Validator;
use October\Rain\Support\Facades\Flash;

class Comments extends ComponentBase
{

	public function componentDetails()
	{
		return [
			'name'        => 'Comments Component',
			'description' => 'No description provided yet...'
		];
	}

	public function defineProperties()
	{
		return [];
	}

	public function showComments()
	{
		$slug = $this->param('slug');
		//var_dump($receipt_id);

		$comments = Receipt::with('comment')
					->where('slug', $slug)
					->get();
		/*Comment::where('receipt_id', '=', $slug)->get();*/

		return $comments;
	}

	public function onSend()
	{
		$validator = Validator::make(
			[
				'your_name' => Input::get('your_name'),
				'email'     => Input::get('email'),
				'comment'   => Input::get('comment')
			],
			[
				'your_name' => 'required',
				'email'     => 'required|email',
				'comment'   => 'required'
			],
			[
				'your_name.required' => 'Dein Name wird benötigt.',
				'email.required'     => 'Deine korrkete E-Mail Adresse wird benötigt',
				'comment.required'   => 'Kommentar wird benötigt.'
			]
		);


		if ( $validator->fails() )
		{
			throw new \ValidationException($validator);
		} else
		{
			$vars = [
				'receipt_id' => Input::get('receipt_id'),
				'your_name'  => Input::get('your_name'),
				'email'      => Input::get('email'),
				'comment'    => Input::get('comment')
			];

			//var_dump($vars);

			Comment::create([
				'receipt_id' => $vars['receipt_id'],
				'your_name'  => $vars['your_name'],
				'email'      => $vars['email'],
				'comment'    => $vars['comment']
			]);


			/* @todo: Configure Mail Send after submitting new Comment
			    already created views/mail/message.htm*/
/*			Mail::send('milo.receipt::mail.message', $vars, function($message) {

				$message->from('office@mollydarcys.at', 'Molly Darcys Irish Pub');
				$message->to('office@mollydarcys.at', 'Molly Darcys Irish Pub');
				$message->cc(Input::get('email'), Input::get('name'));
				$message->subject('autoreply: your Reservation request');

			});*/

			Flash::success('Kommentar wurde übermittelt!');

			return Redirect::back();
		}
	}
}

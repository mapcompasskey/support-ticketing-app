<?php namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// when the view /messages/private/_list is loaded
		view()->composer('messages.private._list', function($view)
		{
			// check if a new private message was just created
			if (Session::get('new_private_message_id'))
			{
				if ($view->getData()['ticket'])
				{
					if ($view->getData()['ticket']->privateMessages->count())
					{
						if ($view->getData()['ticket']->privateMessages->last()->id == Session::get('new_private_message_id'))
						{
							// add an "is_new" attribute to the last message
							$view->getData()['ticket']->privateMessages->last()->is_new = true;
						}
					}
				}
			}

			// check if the user is receiving private message notifications
			if ($view->getData()['ticket'])
			{
				if ($view->getData()['ticket']->users)
				{
					$isUserNotified = ($view->getData()['ticket']->users->find(1) ? 1 : 0);
					$view->with('isUserNotified', $isUserNotified);
				}
			}
		});

		// when the view /messages/public/_list is loaded
		view()->composer('messages.public._list', function($view)
		{
			// check if a new public message was just created
			if (Session::get('new_public_message_id'))
			{
				if ($view->getData()['ticket'])
				{
					if ($view->getData()['ticket']->publicMessages->count())
					{
						if ($view->getData()['ticket']->publicMessages->last()->id == Session::get('new_public_message_id'))
						{
							// add an "is_new" attribute to the last message
							$view->getData()['ticket']->publicMessages->last()->is_new = true;
						}
					}
				}
			}
		});

		// when the view /messages/public/_form is loaded
		view()->composer('messages.public._form', function($view)
		{
			$userName = null;
			$userEmail = null;
			$isNotify = null;

			// if viewing a tickets page
			$current = array_reverse(explode('/', \URL::current()));
			if (is_numeric($current[0]) && $current[1] == 'tickets')
			{
				// autopopulate public message fields with user info
				$userName = 'Jordan Wilson';
				$userEmail = 'jordan@smallbox.com';
			}

			// if viewing notification form
			if ($current[0] == 'notify' && is_numeric($current[1]) && $current[2] == 'tickets')
			{
				$isNotify = true;
			}

			$view->with('userName', $userName)->with('userEmail', $userEmail)->with('isNotify', $isNotify);
		});

		// when the view /tickets/_form is loaded
		view()->composer('tickets._form', function($view)
		{
			$organizationId = null;
			$userIds = null;

			// check if creating a new ticket
			$current = array_reverse(explode('/', \URL::current()));
			if ($current[0] == 'create' && $current[1] == 'tickets')
			{
				// check if sent from an organization's page
				$previous = array_reverse(explode('/', \URL::previous()));
				if (is_numeric($previous[0]) && $previous[1] == 'organizations')
				{
					$organizationId = $previous[0];
				}

				// add the current user to list of users
				$userIds = [1];
			}

			$view->with('organizationId', $organizationId)->with('userIds', $userIds);
		});

		// when the view /frontned/messages/public/_list is loaded
		view()->composer('frontend.messages.public._list', function($view)
		{
			// check if a new public message was just created
			if (Session::get('new_public_message_id'))
			{
				if ($view->getData()['ticket'])
				{
					if ($view->getData()['ticket']->publicMessages->count())
					{
						if ($view->getData()['ticket']->publicMessages->last()->id == Session::get('new_public_message_id'))
						{
							// add an "is_new" attribute to the last message
							$view->getData()['ticket']->publicMessages->last()->is_new = true;
						}
					}
				}
			}
		});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}

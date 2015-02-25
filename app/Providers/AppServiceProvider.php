<?php namespace App\Providers;

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
		// check if a new private message was just created
		view()->composer('messages.private._list', function($view)
		{
			if (Session::get('new_private_message_id'))
			{
				if ($view->getData()['ticket'])
				{
					if ($view->getData()['ticket']->privateMessages->count())
					{
						if ($view->getData()['ticket']->privateMessages->last()->id == Session::get('new_private_message_id'))
						{
							$view->getData()['ticket']->privateMessages->last()->is_new = true;
						}
					}
				}
			}
		});

		// check if a new public message was just created
		view()->composer('messages.public._list', function($view)
		{
			if (Session::get('new_public_message_id'))
			{
				if ($view->getData()['ticket'])
				{
					if ($view->getData()['ticket']->publicMessages->count())
					{
						if ($view->getData()['ticket']->publicMessages->last()->id == Session::get('new_public_message_id'))
						{
							$view->getData()['ticket']->publicMessages->last()->is_new = true;
						}
					}
				}
			}
		});

		// check if creating a contact from an organization's page
		view()->composer('contacts._form', function($view)
		{
			$organization_id = 0;
			$referrer = array_reverse(explode('/', $_SERVER['HTTP_REFERER']));
			if (is_numeric($referrer[0]) && $referrer[1] == 'organizations')
			{
				$organization_id = $referrer[0];
			}
			$view->with('organization_id', $organization_id);
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

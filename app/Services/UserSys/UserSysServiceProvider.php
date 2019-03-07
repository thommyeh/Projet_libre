<?php
namespace App\Services\UserSys;

use Illuminate\Support\ServiceProvider;

class UserSysServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton('UserSys', function ($app) {
			return new UserSys();
		});
	}

}
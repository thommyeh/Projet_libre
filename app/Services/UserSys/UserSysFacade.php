<?php
namespace App\Services\UserSys;

use Illuminate\Support\Facades\Facade;

class UserSysFacade extends Facade {
	protected static function getFacadeAccessor() {
		return UserSys::class;
	}
}
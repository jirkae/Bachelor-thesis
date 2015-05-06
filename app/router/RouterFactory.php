<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route;


class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList();		
		$router[] = new Route('<action>[/<id>]', array(
		    'module' => 'Front',
		    'presenter' => array(
			Route::VALUE => 'Homepage'			
		    ),
		    'action' => 'default'));
		
		return $router;
	}

}

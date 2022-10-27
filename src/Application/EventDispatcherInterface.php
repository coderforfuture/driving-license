<?php
declare(strict_types=1);
namespace App\Application;

interface EventDispatcherInterface
{
	//@throws CouldNotDispatchEvents
	public function dispatch(array $events) : void;	
}
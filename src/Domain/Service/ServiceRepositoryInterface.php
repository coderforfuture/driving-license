<?php
declare(strict_types=1);
namespace App\Domain\Service;

use App\Domain\ServiceId;

interface ServiceRepositoryInteface
{
	public function save(Service $service) : void;
	
	public function find(ServiceId $id) : ?Service;
	
	//@throw ServiceNotFoundException
	public function get(ServiceId $id) : Service;
}

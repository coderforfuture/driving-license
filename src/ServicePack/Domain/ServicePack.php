<?php
declare(strict_types=1);
namespace App\ServicePack\Domain;

use \App\Common\ServicePackId;

//ServicePackName and Service are in that domain (I think)

final class ServicePack
{
	private ServicePackId $id;
	private ServicePackName $name;
	private array $services = [];
	
	private function __construct(
		ServicePackId $id
	,	ServicePackName $name
	){
		$this->id = $id;
		$this->name = $name;
	}
	
	public function create(
		ServicePackId $id
	,	ServicePackName $name
	) : self {
		return new static($id, $name);
	}
	
	public static function fromExistingServicePack(
		ServicePackId	$id
	,	ServicePackName $name
	,	self $existingPack
	) : self {
		$that = new static($id, $name);
		$that->services = $existingPack->services;
	}
	
	public function addService(Service $service) : void {
		$this->assertNoConflict($service);
		$this->services[] = $service;
	}
	
	public function removeService(Service $service) : void {
		//todo
	}
	
	private function assertNoConflict($service) : void {
		foreach ($this->services as $preAdded) {
			if ($service->hasConflictWith($preAdded)) {
				throw new ServicesInConflictException::conflictBetween($service, $preAdded);
			}
		}
	}
}

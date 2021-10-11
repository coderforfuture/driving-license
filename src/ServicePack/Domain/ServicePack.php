<?php
declare(strict_types=1);
namespace App\ServicePack\Domain;

use \App\Common\{
	ServicePackId
,	ServiceId
};

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
	
	private function hasService(ServiceId $serviceId) : bool {
		foreach ($this->services as $service) {
			if ($serviceId->isSame($service->id())) {
				return true;
			}
		}
		return false;
	}
	
	public function addService(Service $service) : void {
		if ($this->hasService($service->id())) {
			//throw CannotAddServiceException::becauseServiceIsPresent($service);
			return;
		}
		//$this->assertNoConflict($service); //forse non serve
		$this->services[] = $service;
	}
	
	public function removeService(ServiceId $serviceId) : void {
		$this->services = array_filter($this->services, function ($service) use ($serviceId){
			return !$serviceId->isSame($service->id());
		});
	}
	
	private function assertNoConflict($service) : void {
		foreach ($this->services as $preAdded) {
			if ($service->hasConflictWith($preAdded)) {
				throw new ServicesInConflictException::conflictBetween($service, $preAdded);
			}
		}
	}
}

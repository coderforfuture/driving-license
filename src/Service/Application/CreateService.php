<?php
declare(strict_types=1);
namespace App\Service\Application;

use App\Common\ServiceId;
use App\Service\Domain\{
	Service
,	ServiceRepositoryInterface as ServiceRepository
,	RangedQuantity
,	Description
};
use App\Service\Application\CreateServiceCommand as Command;

final class CreateService 
{
	private ServiceRepository $serviceRepo;
	
	public function __construct(
		ServiceRepository $serviceRepo
	){
		$this->serviceRepo = $serviceRepo;
	}
	
	public function execute(Command $command) : void {
		$id = ServiceId::fromString($command->id);
		$rangedQuantity = RangedQuantity::create($command->min, $command->max);
		$description = Description::fromString($command->description);//can have more then one?
	
		$service = Service::create($id, $rangeQuantity, $description);
		
		$this->serviceRepo->save($service);
	}
}

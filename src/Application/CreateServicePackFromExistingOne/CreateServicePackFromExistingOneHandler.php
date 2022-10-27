<?php
declare(strict_types=1);
namespace App\Application\CreateServicePackFromExistingOne;

use App\Domain\ServicePackId;
use App\Domain\ServicePack{
	ServicePack
,	ServicePackName
,	ServicePackRepositoryInterface as ServicePackRepository
};
use App\Application\CreateServicePackFromExistingOne\CreateServicePackFromExistingOne as Command;

final class CreateServicePackFromExistingOneHandler
{
	private ServicePackRepository $servicePackRepo;
	
	public function __construct(
		ServicePackRepository $servicePackRepo
	){
		$this->servicePackRepo = $servicePackRepo;
	}
	
	public function execute(Command $command) : void {
		$id = ServicePackId::fromString($command->id);
		$name = ServicePackName::fromString($command->name);
		$existingOneId = ServicePackId::fromString($command->existingOneId);
		
		$existingOne = $this->servicePackRepo->get($existinOneId);
		
		$servicePack = ServicePack::fromExistingServicePack(
			$id
		,	$name
		,	$existingOne
		);
		
		$this->servicePackRepo->save($servicePack);
	}
}

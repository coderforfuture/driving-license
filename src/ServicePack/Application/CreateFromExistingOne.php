<?php
declare(strict_types=1);
namespace App\ServicePack\Application;

use App\Common\ServicePackId;
use App\ServicePack\Domain\{
	ServicePack
,	ServicePackName
,	ServicePackRepositoryInterface as ServicePackRepository
};
use App\ServicePack\Application\CreateFromExistingOneCommand as Command;

final class CreateFromExistingOne
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

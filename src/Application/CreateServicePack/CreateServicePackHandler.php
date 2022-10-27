<?php
declare(strict_types=1);
namespace App\Application\CreateServicePack;

use App\Domain\ServicePack\{
	ServicePack
,	ServicePackName
,	ServicePackRepositoryInteface as ServicePackRepository
};
use App\Domain\{
	ServicePackId
};
use App\Application\CreateServicePack\CreateServicePack as Command;

final class CreateServicePackHandler
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
		
		$servicePack = ServicePack::create($id, $name);
		//va bene cosi senza nemmeno un servizio? 
		$this->servicePackRepo->save($servicePack);
	}
}
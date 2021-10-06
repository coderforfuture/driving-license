<?php
declare(strict_types=1);
namespace App\ServicePack\Application;

use App\ServicePack\Domain\{
	ServicePack
,	ServicePackName
,	ServicePackRepositoryInteface as ServicePackRepository
};
use App\Common\{
	ServicePackId
};
use App\ServicePack\Application\CreateServicePackCommand as Command;

final class CreateServicePack
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
<?php
declare(strict_types=1);
namespace App\Application\AddServiceToServicePack;

//questa parte penso sia da rivedere dopo aver definito i servizi

use App\Domain\{
	ServicePackId
,	ServiceId
};
use App\Domain\ServicePack\ServicePackRepositoryInterface as ServicePackRepository;
use App\Application\AddserviceToServicePack\AddServiceToServicePack as Command;

final class AddServiceToServicePackHandler
{
	private ServicePackRepository $servicePackRepo;
	
	public function __construct(
		ServicePackRepository $servicePackRepo
	) {
		$this->servicePackRepo = $servicePackRepo;
	}
	
	public function execute(Command $command) : void {
		$id = ServicePackId::fromString($command->id);
		$serviceId = ServiceId::fromString($command->serviceId);
		
		$service = $this->serviceProvider->provide($serviceId);
		
		$servicePack = $this->servicePackRepo->get($id);
		
		$servicePack->addService($service);
		
		$this->servicePackRepo->save($servicePack);
	}
}

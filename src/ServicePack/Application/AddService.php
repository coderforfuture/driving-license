<?php
declare(strict_types=1);
namespace App\ServicePack\Application;

//questa parte penso sia da rivedere dopo aver definito i servizi

use App\Common\{
	ServicePackId
,	ServiceId
};
use App\ServicePack\Domain\ServicePackRepositoryInterface as ServicePackRepository;
use App\ServicePack\Application\AddServiceCommand as Command;

final class AddService
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

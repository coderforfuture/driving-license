<?php
declare(strict_types=1);
namespace App\Application\CreateDrivingLicense;

use App\Domain\DrivingLicenseId;
use App\Application\CreateDrivingLicense\CreateDrivingLicense as Command;
use App\Domain\DrivingLicense\{
	DrivingLicense
,	DrivingLicenseRepositoryInterface as DrivingLicenseRepository
};

final class CreateDrivingLicenseHandler
{
	private DrivingLicenseRepository $drivingLicenseRepo;
	
	public function __construct(
		DrivingLicenseRepository $drivingLicenseRepo
	) {
		$this->drivingLicenseRepo = $drivingLicenseRepo;
	}
	
	public function execute(Command $command) : void {
		$id = DrivingLicenseId::fromString($command->id);
		$description = Description::fromString($command->description);
		$name = Name::fromString($command->name);
		
		$drivingLicense = DrivingLicense::create($id, $name, $description);
		
		$this->drivingLicenseRepo->save($drivingLicense);
	}
}

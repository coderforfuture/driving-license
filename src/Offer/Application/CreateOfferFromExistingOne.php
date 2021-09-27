<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Offer\Domain\{
	OfferRepositoryInterface as OfferRepository
,	Offer
};
use App\Common\OfferId;
use App\Offer\Application\CreateOfferFromExistingOneCommand as Command;

final class CreateOfferFromExistingOne
{
	private OfferRepository $offerRepo;
	
	public function __construct(
		OfferRepository $offerRepo
	){
		$this->offerRepo = $offerRepo;
	}
	
	public function execute(Command $command) : void {
		$id = OfferId::fromString($command->id);
		$existingOneId = OfferId::fromString($command->existingOneId);
		
		$existingOne = $this->offerRepo->get($existingOneId);
		
		$offer = Offer::fromExistingOffer($id, $existingOne);
		
		$this->offerRepo->save($offer);
	}
}

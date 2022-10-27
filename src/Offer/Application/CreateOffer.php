<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Offer\Domain\{
	Offer
,	OfferRepositoryInterface as OfferRepository
};
use App\Common\{
	OfferId
,	OffertableId
, 	ServicePakcId
,	MoneyInterface as Price //non può essere un intefaccia
};
use App\Offer\Application\CreateOfferCommand as Command;

final class CreateOffer
{
	private OfferRepository $offerRepo;
	
	public function __construct(
		OfferRepository $offerRepo
		OffertableProvider $offertableProvider
	){
		$this->offerRepo = $offerRepo;
		$this->offertableProvider = $offertableProvider;
	}
	
	public function execute(Command $command) : void {
		$id = OfferId::fromString($command->id); //oppure deriva da OffertableId e ServicePackId?
		$price = Price::fromString($command->price);
		$offertableId = OffertableId::fromString($command->offertableId);
		$servicePackId = ServicePackId:.fromString($command->servicePackId);		
		
		$offer = Offer::create($id, $offertableId, $servicePackId, $price);
		
		$this->offerRepo->save($offer);
	}

}

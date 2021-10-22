<?php
declare(strict_types=1);
namespace App\Application\CreateOffer;

use App\Domain\Offer\{
	Offer
,	OfferRepositoryInterface as OfferRepository
};
use App\Domain\{
	OfferId
,	OffertableId
, 	ServicePakcId
,	MoneyInterface as Price //non può essere un intefaccia
};
use App\Application\CreateOffer\CreateOffer as Command;

final class CreateOfferHandler
{
	private OfferRepository $offerRepo;
	
	public function __construct(
		OfferRepository $offerRepo
//		OffertableProvider $offertableProvider
	){
		$this->offerRepo = $offerRepo;
//		$this->offertableProvider = $offertableProvider;
	}
	
	public function execute(Command $command) : void {
		$price = Price::fromString($command->price);
		$offertableId = OffertableId::fromString($command->offertableId);
		$servicePackId = ServicePackId::fromString($command->servicePackId);
		$id = OfferId::fromOffertableAndServicePack(
			$offertableId
		,	$servicePackId
		);
		
		$offer = Offer::create($id, $offertableId, $servicePackId, $price);
		
		$this->offerRepo->save($offer);
	}

}

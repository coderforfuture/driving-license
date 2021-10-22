<?php
declare(strict_types=1);
namespace App\Application\ChangeOfferPrice;

use App\Domain\{
	OfferId
,	MoneyInterface as Price //non può essere un interfaccia
};
use App\Domain\Offer\{
	OfferRepositoryInterface as OfferRepository
};
use App\Application\ChangeOfferPrice\ChangeOfferPrice as Command;

final class ChangeOfferPriceHandler
{
	private OfferRepository $offerRepo;
	
	public function __construct(
		OfferRepository $offerRepo
	){
		$this->offerRepo = $offerRepo;
	}
	
	public function execute(Command $command) : void {
		$id = OfferId::fromString($command->id);
		//da rivedere che non sono sicuro sia giusto così
		$price = Price::fromString($command->price);
		
		$offer = $this->offerRepo->get($id);
		
		$offer->changePrice($price);
		
		$this->offerRepo->save($offer);
	}
}

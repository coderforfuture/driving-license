<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Common\{
	OfferId
,	MoneyInterface as Price //non può essere un interfaccia
};
use App\Offer\Domain\{
	OfferRepositoryInterface as OfferRepository
};
use App\Offer\Application\ChangeOfferPriceCommand as Command;

final class ChangeOfferPrice
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

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
,	MoneyInterface as Price //sta cosa del prezzo la devo un po' vedere perché è fastidiosa
};
use App\Offer\Application\{
	CreateOfferCommand as Command
,	OffertableProviderInterface as OffertableProvider
};

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
		$id = OfferId::fromString($command->id);
		$price = Price::fromString($command->price);
		$offertableId = OffertableId::fromString($command->offertableId);
		
		$offertable = $this->offertableProvider->provide($offertableId);
		
		$offer = Offer::create($id, $offertable, $price);
		
		$this->offerRepo->save($offer);
	}

}

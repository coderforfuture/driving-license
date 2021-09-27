<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Common\OfferId;
use App\Offer\Domain\{
	OfferRepositoryInterface as OfferRepository
,	OptionalCollection
};
use App\Offer\Application\AddOptionalToOfferCommand as Command;

final class AddOptionalToOffer
{
	private OfferRepository $offerRepo;
	
	public function __construct(
		OfferRepository $offerRepo
	){
		$this->offerRepo = $offerRepo;
	}
	
	public function execute(Command $command) : void {
		$offerId = OfferId::fromString($command->id);
		$optionals = OptionalCollection::fromArray($command->optionals);
		$offer = $this->offerRepo->get($offerId);
		
		$offer->addOptionals(...$optionals->toArray());
		
		$this->offerRepo->save($offer);
	}
}

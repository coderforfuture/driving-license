<?php
declare(strict_types=1);
namespace App\Offer\Application;

//todo : completare i metodi privati

use App\Offer\Domain\{
	OfferRepositoryInterface as OfferRepositoryInterface
};
use App\Common\{
	OfferId
,	OptionalCollection //da vedere forse nel domain
,	UpdatedOptionalCollection //da vedere forse nel domain
,	OptionalIdCollection
};
use App\Offer\Application\UpdateOptionalsToOfferCommand as Command;

final class UpdateOptionalsToOffer 
{
	private OfferRepository $offerRepo;
	
	public function __construct(
		OfferRepository $offerRepo
	){
		$this->offerRepo = offerRepo;
	}
	
	public function execute(Command $command) : void {
		$offerId = OfferId::fromString($command->id);
		$optionalToAdd = OptionalCollection::fromArray($command->optionalToAdd);
		$optionalToRemove = OptionalIdCollection::fromArrayOfStrings($command->optionalToRemove);
		$optionalToUpdate = UpdatedOptionalCollection::fromArray($command->optionalToUpdate);
		
		$offer = $this->offerRepo->get($offerId);
		
		$this->addOptional($offer, $optionalToAdd);
		$this->removeOptional($offer, $optionalToRemove);
		$this->updateOptional($offer, $optionalToUpdate);
		
		$this->offerRepo->save($offer);
	}
	
	private function addOptional(Offer $offer, OptionalCollection $optionals) : void {
		$offer->addOptionals(...$optionals->toArray());
	}
	
	private function removeOptional(Offer $offer, OptionalIdCollection $optionals) : void {
		$offer->removeOptionals($optionals);
	}
	
	private function updateOptional(Offer $offer, UpdatedOptionalCollection $optionals) : void {
		//todo : non so esattamente come fare
	}
}

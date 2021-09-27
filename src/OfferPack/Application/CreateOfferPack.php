<?php
declare(strict_types=1);
namespace App\OfferPack\Application;

use App\OfferAggregate\Domain\{
	OfferAdder
,	OfferProviderInterface as OfferProvider
};
use App\OfferPack\Domain\{
	OfferPackRepositoryInterface as OfferPackRepository
,	OfferPack
};
use App\Common\{
	OfferPackId
,	OfferIdCollection
,	DiscountId
};
use App\OfferPack\Application\CreateOfferPackCommand as Command;

final class CreateOfferPack
{
	private OfferPackRepository $offerPackRepo;
	private OfferProvider $offerProvider;
	private DiscountProvider $discountProvider;
	private OfferAdder $offerAdder;
	
	public function __construct(
		OfferPackRepository $offerPackRepo
	,	OfferProvider $offerProvider
	,	DiscountProvider $discountProvider
	,	OfferAdder $offerAdder
	){
		$this->offerPackRepo = $offerPackRepo;
		$this->offerProvider = $offerProvider;
		$this->discountProvider = $discountProvider;
		$this->offerAdder = $offerAdder;
	}
	
	public function execute(Command $command) : void {
		$id = OfferPackId::fromString($command->id);
		$offerIds = OfferIdCollection::fromArrayOfStrings($command->offerIds);
		$discountId = DiscountId::fromString($command->discountId);
		
		$discount = $this->discountProvider->provide($discountId);
		
		$offerPack = OfferPack::createWithId($id);
		
		$this->offerAdder->addOffers(
			$this->offerProvider
		,	$offerPack
		,	$offerIds
		);
		
		$offerPack->changeDiscount($discount);
		
		$this->offerPackRepo->save($offerPack);
		
	}
}

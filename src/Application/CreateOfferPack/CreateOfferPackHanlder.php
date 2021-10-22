<?php
declare(strict_types=1);
namespace App\Application\CreateOfferPack;

use App\Domain\OfferAggregate\{
	OfferAdder
,	OfferProviderInterface as OfferProvider
};
use App\Domain\OfferPack\{
	OfferPackRepositoryInterface as OfferPackRepository
,	OfferPack
};
use App\Domain\{
	OfferPackId
,	OfferIdCollection
};
use App\Application\CreateOfferPack\{
	CreateOfferPack as Command
,	DiscountFactoryInterface as DiscountFactory
};

final class CreateOfferPack
{
	private OfferPackRepository $offerPackRepo;
	private OfferProvider $offerProvider;
	private DiscountFactory $discountFactory;
	private OfferAdder $offerAdder;
	
	public function __construct(
		OfferPackRepository $offerPackRepo
	,	OfferProvider $offerProvider
	,	DiscountFactory $discountFactory
	,	OfferAdder $offerAdder
	){
		$this->offerPackRepo = $offerPackRepo;
		$this->offerProvider = $offerProvider;
		$this->discountFactory = $discountFactory;
		$this->offerAdder = $offerAdder;
	}
	
	public function execute(Command $command) : void {
		$id = OfferPackId::fromString($command->id);
		$offerIds = OfferIdCollection::fromArrayOfStrings($command->offerIds);
		
		$discount = $this->discountFactory->createFromString($command->discount);
		
		$offerPack = OfferPack::create($id, $discount);
		
		$this->offerAdder->addOffers(
			$this->offerProvider
		,	$offerPack
		,	$offerIds
		);
		
		$this->offerPackRepo->save($offerPack);
	}
}

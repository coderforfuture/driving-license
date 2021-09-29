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
};
use App\OfferPack\Application\{
	CreateOfferPackCommand as Command
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
		
		$discount = $this->discountFactory->createFromString($command->);
		
		$offerPack = OfferPack::create($id, $discount);
		
		$this->offerAdder->addOffers(
			$this->offerProvider
		,	$offerPack
		,	$offerIds
		);
		
		$offerPack->publish();
		
		$this->offerPackRepo->save($offerPack);
	}
}

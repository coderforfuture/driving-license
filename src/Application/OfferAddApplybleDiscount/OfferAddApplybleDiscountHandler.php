<?php
declare(strict_types=1);
namespace App\Application\OfferAddApplybleDiscount;

use App\Domain\Offer\{
	OfferRepositoryInterface as OfferRepositoryInterface
};
use App\Domain\{
	OfferId
,	DiscountIdCollection
};
use App\Application\OfferAddApplybleDiscount\{
	OfferAddApplybleDiscount as Command
,	DiscountProviderInterface as DiscountProvider
}

final class OfferAddApplybleDiscountHandler
{
	private OfferRepository $offerRepo;
	private DiscountProvider $discountProvider;
	
	public function __construct(
		OfferRepository $offerRepo
	,	DiscountProvider $discountProvider
	){
		$this->offerRepo = $offerRepo;
		$this->discountProvider = $discountProvider;
	}
	
	public function execute(Command $command) : void {
		$id = OfferId::fromString($command->id);
		$discountIds = DiscountIdCollection::fromArrayOfStrings($command->discountIds);
		
		$offer = $this->offerRepo->get($id);
		
		$discounts = $this->discountProvider->provide($discountIds);
		
		foreach ($discounts as $discount) {
			$offer->addPossibilityOfDiscount($discount);
		}
		
		$this->offerRepo->save($offer);
	}
}

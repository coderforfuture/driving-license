<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Offer\Domain\{
	OfferRepositoryInterface as OfferRepositoryInterface
};
use App\Common\{
	OfferId
,	DiscountIdCollection
};
use App\Offer\Application\{
	AddPossibilitiesOfDiscountCommand as Command
,	DiscountProviderInterface as DiscountProvider
}

final class AddPossibilitiesOfDiscount
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

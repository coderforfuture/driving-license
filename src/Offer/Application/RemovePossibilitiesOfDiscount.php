<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Common\{
	OfferId
,	DiscountIdCollection
};
use App\Offer\Domain\OfferRepositoryInterface as OfferRepository;
use App\Offer\Application\{
	RemovePossibilitiesOfDiscountCommand as Command
};

final class RemovePossibilitiesOfDiscount
{
	private OfferRepository $offerRepo;
	
	public function __construct(
		OfferRepository $offerRepo
	){
		$this->offerRepo = $offerRepo;
	}
	
	public function execute(Command $command) : void {
		$id = OfferId::fromString($command->id);
		$discountIds = DiscountIdCollection::fromArrayOfStrings($command->discountIds);
				
		$offer = $this->offerRepo->get($id);
		
		foreach ($discountIds as $discountId) {
			$offer->removePossibilityOfDiscount($discountId);
		}
		
		$this->offerRepo->save($offer);
	}
}

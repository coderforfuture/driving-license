<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Common\{
	OfferId
,	DiscountIdCollection
};
use App\Offer\Domain\OfferRepositoryInterface as OfferRepository;
use App\Offer\Application\{
	RemoveDiscountsApplybleCommand as Command
,	DiscountExistenceCheckerInterface as DiscountExistenceChecker
};

final class RemoveDiscountsApplyble
{
	private OfferRepository $offerRepo;
	private DiscountExistenceChecker $existenceChecker;
	
	public function __construct(
		OfferRepository $offerRepo
		DiscountExistenceChecker $existenceChecker
	){
		$this->offerRepo = $offerRepo;
		$this->existenceChecker = $existenceChecker;
	}
	
	public function execute(Command $command) : void {
		$id = OfferId::fromString($command->id);
		$discountIds = DiscountIdCollection::fromArrayOfStrings($command->discountIds);
		
		$this->existenceChecker->checkItsExistence($discountIds);
		
		$offer = $this->offerRepo->get($id);
		
		foreach ($discountIds as $discountId) {
			$offer->removeDiscountApplyble($discountId);
		}
		
		$this->offerRepo->save($offer);
	}
}

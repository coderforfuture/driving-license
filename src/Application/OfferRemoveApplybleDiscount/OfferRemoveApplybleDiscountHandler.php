<?php
declare(strict_types=1);
namespace App\Application\OfferRemoveApplybleDiscount;

use App\Domain\{
	OfferId
,	DiscountIdCollection
};
use App\Domain\Offer\OfferRepositoryInterface as OfferRepository;
use App\Application\OfferRemoveApplybleDiscount\{
	OfferRemoveApplybleDiscount as Command
//,	DiscountExistenceCheckerInterface as DiscountExistenceChecker
};

final class OfferRemoveApplybleDiscountHandler
{
	private OfferRepository $offerRepo;
	//private DiscountExistenceChecker $existenceChecker;
	
	public function __construct(
		OfferRepository $offerRepo
	//,	DiscountExistenceChecker $existenceChecker
	){
		$this->offerRepo = $offerRepo;
		//$this->existenceChecker = $existenceChecker;
	}
	
	public function execute(Command $command) : void {
		$id = OfferId::fromString($command->id);
		$discountIds = DiscountIdCollection::fromArrayOfStrings($command->discountIds);
		
		//$this->existenceChecker->checkItsExistence($discountIds);
		
		$offer = $this->offerRepo->get($id);
		
		foreach ($discountIds as $discountId) {
			$offer->removePossibilityOfDiscount($discountId);
		}
		
		$this->offerRepo->save($offer);
	}
}

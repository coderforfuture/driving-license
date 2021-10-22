<?php
declare(strict_types=1);
namespace App\Application\ChangeDiscountAmount;

use App\Domain\Discount\{
	DiscountRepositoryInterface as DiscountRepository
,	Amount
};
use App\Domain\DiscountId;
use App\Application\ChangeDiscountAmount\ChangeDiscountAmount as Command;

final class ChangeDiscountAmountHandler
{
	private DiscountRepository $discountRepo;
	
	public function __construct(
		DiscountRepository $discountRepo
	) {
		$this->discountRepo = $discountRepo;
	}
	
	public function execute(Command $command) : void {
		$id = DiscountId::fromString($command->id);
		$amount = Amount::fromString($command->amount);
		
		$discount = $this->discountRepo->get($id);
		
		$discount->changeAmount($amount);
		
		$this->discountRepo->save($discount);
	}
}

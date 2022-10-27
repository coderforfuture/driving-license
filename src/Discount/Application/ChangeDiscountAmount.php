<?php
declare(strict_types=1);
namespace App\Discount\Application;

use App\Discount\Domain\{
	DiscountRepositoryInterface as DiscountRepository
,	Amount
};
use App\Common\DiscountId;
use App\Discount\Application\ChangeDiscountAmountCommand as Command;

final class ChangeDiscountAmount
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

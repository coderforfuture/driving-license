<?php
declare(strict_types=1);
namespace App\Application\CreateDiscountHandler;

use App\Domain\Discount{
	DiscountRepositoryInteface as DiscountRepository
,	Discount
,	Amount
};
use App\Domain\{
	DiscountId
};
use App\Application\CreateDiscount\CreateDiscount as Command;

final class CreateDiscountHandler
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
		
		$discount = Discount::create($id, $amount);
		
		$this->discountRepo->save($discount);
	}
}

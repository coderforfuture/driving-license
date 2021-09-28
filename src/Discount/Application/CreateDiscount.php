<?php
declare(strict_types=1);
namespace App\Discount\Application;

use App\Discount\Domain\{
	DiscountRepositoryInteface as DiscountRepository
,	Discount
};
use App\Common\{
	DiscountId
};
use App\Discount\Application\CreateDiscountCommand as Command;

final class CreateDiscount 
{
	private DiscountRepository $discountRepo;
	
	public function __construct(
		DiscountRepository $discountRepo
	) {
		$this->discountRepo = $discountRepo;
	}
	
	public function execute(Command $command) : void {
		$id = DiscountId::fromString($command->id);
		$amount = DiscountAmount::fromString($command->amount);
		
		$discount = Discount::create($id, $amount);
		
		$this->discountRepo->save($discount);
	}
}

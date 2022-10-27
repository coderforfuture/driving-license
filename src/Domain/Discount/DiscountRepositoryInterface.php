<?php
declare(strict_types=1);
namespace App\Domain\Discount;

use App\Domain\DiscountId;

interface DiscountRepositoryInterface
{
	public function save(Discount $discount) : void;
	
	public function find(DiscountId $discounId) : ?Discount;
	
	//@throw DiscountNotFoundException
	public function get(DiscountId $discountId) : Discount;
}

<?php
declare(strict_types=1);
namespace App\Discount\Domain;

use App\Common\DiscountId;

interface DiscountRepositoryInterface
{
	public function save(Discount $discount) : void;
	
	public function find(DiscountId $discounId) : ?Discount;
	
	//@throw DiscountNotFoundException
	public function get(DiscountId $discountId) : Discount;
}

<?php
declare(strict_types=1);
namespace App\OfferPack\Domain;

use App\Common\{
	MoneyInterface as Price
,	DiscountId
};

interface DiscountInterface
{
	public function id() : DiscountId;
	
	public function isAmountGreaterThan(Price $price) : bool;
	
	public function isSame(DiscountInterface $discount) : bool;
}

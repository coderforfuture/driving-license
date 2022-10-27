<?php
declare(strict_types=1);
namespace App\OfferPack\Domain;

use App\Common\MoneyInterface as Amount;

interface DiscountInterface
{
	public function isAmountGreaterThan(Amount $amount) : bool;
	
	public function isSame(DiscountInterface $discount) : bool;
}

<?php
declare(strict_types=1);
namespace App\Domain;

use App\Domain\MoneyInterface as Amount;

interface DiscountInterface
{
	public function isAmountGreaterThan(Amount $amount) : bool;
	
	public function isSame(DiscountInterface $discount) : bool;
}

<?php
declare(strict_types=1);
namespace App\OfferPack\Domain;

use App\Common\MoneyInterface as Price;

interface DiscountInterface
{
	public function amount() : Price;
	
	public function isSame(DiscountInterface $discount) : bool;
}

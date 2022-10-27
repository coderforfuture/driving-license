<?php
declare(strict_types=1);
namespace App\OfferPack\Application;

use App\OfferPack\Domain\DiscountInterface;

interface DiscountFactoryInterface
{
	public function createFromString(string $discount) : DiscountInterface;
}

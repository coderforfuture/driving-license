<?php
declare(strict_types=1);
namespace App\Application\CreateOfferPack;

use App\Domain\OfferPack\DiscountInterface;

interface DiscountFactoryInterface
{
	public function createFromString(string $discount) : DiscountInterface;
}

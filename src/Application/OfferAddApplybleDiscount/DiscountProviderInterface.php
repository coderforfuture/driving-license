<?php
declare(strict_types=1);
namespace App\Application\OfferAddApplybleDiscount;

use App\Domain\DiscountIdCollection;

interface DiscountProviderInterface
{
	//@throw if one or all discouts not exist
	public function provide(DiscountIdCollection $discounts) : array;
}

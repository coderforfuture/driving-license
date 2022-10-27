<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Common\DiscountIdCollection;

interface DiscountProviderInterface
{
	//@throw if one or all discouts not exist
	public function provide(DiscountIdCollection $discounts) : array;
}

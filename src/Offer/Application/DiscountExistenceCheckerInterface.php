<?php
declare(strict_types=1);
namespace App\Offer\Application;

use App\Common\DiscountIdCollection;

interface DiscountExistenceCheckerInterface
{
	//@throw if one or all discouts not exist
	public function checkItsExistence(DiscountIdCollection $discounts) : void;
}

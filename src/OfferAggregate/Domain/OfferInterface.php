<?php
declare(strict_types=1);
namespace App\OfferAggregate\Domain;

use App\Common\{
	OfferId
,	MoneyInterface as Price
};

interface OfferInteface
{
	public function hasSameOffertable(OfferInterface $offer) : bool;
	
	public function hasId(OfferId $offerId) : bool;
	
	public function price() : Price;
}

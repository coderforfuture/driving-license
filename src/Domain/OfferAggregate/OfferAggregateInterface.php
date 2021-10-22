<?php
declare(strict_types=1);
namespace App\Domain\OfferAggregate;

interface OfferAggregateInterface
{
	//@throw
	public function addOffer(OfferInterface $offer) : void;
}

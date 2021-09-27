<?php
declare(strict_types=1);
namespace App\OfferAggregate\Domain;

interface OfferAggregateInterface
{
	//@throw
	public function addOffer(OfferInterface $offer) : void;
}

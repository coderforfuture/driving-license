<?php
declare(strict_types=1);
namespace App\OfferAggregate\Domain;

use App\Common\OfferIdCollection;

interface OfferProviderInterface
{
	//forse dovrei restituire un OfferCollectionInterface?
	public function provide(OfferIdCollection $offerIds) : array;
}

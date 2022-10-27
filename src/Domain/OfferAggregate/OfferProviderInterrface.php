<?php
declare(strict_types=1);
namespace App\Domain\OfferAggregate;

use App\Domain\OfferIdCollection;

interface OfferProviderInterface
{
	//forse dovrei restituire un OfferCollectionInterface?
	public function provide(OfferIdCollection $offerIds) : array;
}

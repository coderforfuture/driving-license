<?php
declare(strict_types=1);
namespace App\Domain\Offer;

use App\Domain\OfferId;

interface OfferRepositoryInterface
{
	public function save(Offer $offer) : void;
	
	public function find(OfferId $offer) : ?Offer;
	
	//@throw OfferNotFoundException
	public function get(OfferId $offer) : Offer;
}

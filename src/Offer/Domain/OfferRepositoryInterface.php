<?php
declare(strict_types=1);
namespace App\Offer\Domain;

use App\Common\OfferId;

interface OfferRepositoryInterface
{
	public function save(Offer $offer) : void;
	
	public function find(OfferId $offer) : ?Offer;
	
	//@throw OfferNotFoundException
	public function get(OfferId $offer) : Offer;
}

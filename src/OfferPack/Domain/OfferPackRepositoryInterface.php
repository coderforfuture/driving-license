<?php
declare(strict_types=1);
namespace App\OfferPack\Domain;

use App\Common\OfferPackId;

interface OfferPackRepositoryInterface
{
	public function save(OfferPack $offerPack) : void;
	
	public function find(OfferPackId $id) : ?OfferPack;
	
	//@throw OfferPackNotFoundException
	public function get(OfferPackId $id) : OfferPack;
}

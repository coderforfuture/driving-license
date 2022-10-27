<?php
declare(strict_types=1);
namespace App\Domain\OfferPack

use App\Domain\{
	OfferPackId
,	OfferId
};
use App\Domain\OfferAggregate\{
	OfferAggregateInterface as OfferAggregate
,	OfferInterface
};
use App\Domain\MoneyInterface;

final class OfferPack implements OfferAggregate
{
	private OfferPackId $id;
	private array $offers = [];
	private DiscountInterface $discount;
	private bool $published = false;
	
	private function __construct(OfferPackId $id, DiscountInterface $discount) {
		$this->id = $id;
		$this->discount = $discount;
	}
	
	public static function create(OfferPackId $id, DiscountInterface $discount) : self {
		return new static($id, $discount);
	}
	
	//@throw
	public function addOffer(OfferInterface $offer) : void {
		if ($this->published) {
			throw new LogicalException("cannot add Offers after publish");
		}
		foreach ($this->offers as $preAddedOffer) {
			if ($offer->hasSameOffertable($preAddedOffer)) {
				//l'eccezione da lanciare è logica o di InvalidArgument?
				throw new LogicalException("is not possible add offers with same offertable");
			}
		}
		
		$this->offers[] = $offer;
	}
	
	public function removeOffer(OfferId $offerId) : void {
		if ($this->published) {
			throw new LogicalException("cannot remove Offers after publish");
		}
		$this->offers = array_filter($this->offers, function($offer){
			return !$offer->hasId($offerId);
		});
	}
	
	private function totalPrice() : MoneyInterface/*?*/ {
		return array_reduce($this->offers,
			static function(?MoneyInterface $total, OfferInterface $offer) : MoneyInterface {
				return !is_null($total) ? $total->add($offer->price()) : $offer->price();
			});
			//non c'è un valore di ritorno in caso non ci siano $offers
	}
	
	//@throw
	public function publish() : void {
		$this->published = true;
		
		if (!count($this->offers)) {
			throw new LogicalException("is not possible publish offerPack with no offers");
		}
		
		if ($this->discount->isAmountGreatherThan($this->totalPrice())) {
			//penso che questo sia un errore di logica
			throw new LogicalException("is not possible discount a price more than itself");
		}
	}
	
	//@throw
	public function changeDiscount(DiscountInterface $discount) : void {
		
		if (!is_null($this->discount) && $this->discount->isSame($discount)) {
			return;
		}
		
		if ($discount->isAmountGreatherThan($this->totalPrice())) {
			//penso che questo sia un errore di logica
			throw new LogicalException("is not possible discount a price more than itself");
		}		
		
		$this->discount = $discount;
	}
}

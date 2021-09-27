<?php
declare(strict_types=1);
namespace App\OfferPack\Domain;

use App\Common\OfferPackId;
use App\OfferAggregate\Domain\OfferAggregateInterface as OfferAggregate;
//use App\devoDecidereDaDove\MoneyInterface;

final class OfferPack implements OfferAggregate
{
	private OfferPackId $id;
	private array $offers = [];
	private ?DiscountInterface $discount = null;
	
	private function __construct(OfferPackId $id) {
		$this->id = $id;
	}
	
	public static function createWithId(OfferPackId $id) : self {
		return new static($id);
	}
	
	//@throw
	public function addOffer(OfferInterface $offer) : void {
		
		foreach ($this->offers as $preAddedOffer) {
			if ($offer->hasSameOffertable($preAddedOffer)) {
				//l'eccezione da lanciare è logica o di InvalidArgument?
				throw new LogicalException("is not possible add offers with same offertable");
			}
		}
		
		$this->offers[] = $offer;
	}
	
	public function removeOffer(OfferId $offerId) : void {
		$this->offers = array_filter($this->offers, function($offer){
			return !$offer->id()->isSame($offerId);
		});
	}
	
	private function totalPrice() : MoneyInterface/*?*/ {
		return array_reduce($this->offers,
			static function(?MoneyInterface $total, OfferInterface $offer) : MoneyInterface {
				return !is_null($total) ? $total->add($offer->price()) : $offer->price();
			});
	}
	
	//@throw
	public function changeDiscount(?DiscountInterface $discount = null) : void {
		
		if (!is_null($this->discount) && $this->discount->isSame($discount)) {
			return;
		}
		
		if ($discount->amount()->isGreatherThan($this->totalPrice())) {
			//penso che questo sia un errore di logica
			throw new LogicalException("is not possible discount a price more than itself");
		}
		
		$this->discount = $discount;
	}
}

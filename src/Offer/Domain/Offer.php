<?php
declare(strict_types=1);
namespace App\Offer\Domain;

/*
	L'offerta fa riferimento a un offertable(servizio o prodotto)
	Fornisce una lista di optional
	Possiede un prezzo
*/

//use App\Exception\OptionalsInConflictException;

use App\Common\{
	OfferId
,	DiscountId
,	OptionalIdCollection
,	MoneyInterface as Price //da rivedere
};
use App\Offer\Domain\{
	OffertableInterface as Offertable
,	OptionalInterface as Optional
};

final class Offer
{
	private OfferId $id;
	private Offertable $offertable;
	private Price $price;
	private array $optionals = [];
	private array $discountApplyables = [];
	
	private function __construct(
		OfferId $id
	,	Offertable $offertable
	,	Price $price
	){
		$this->id = id;
		$this->offertable = $offertable;
		$this->price = $price;
	}
	
	public static function create(
		OfferId $id
	,	Offertable $offertable
	,	Price $price
	) : self {
		return new static($id, $offertable, $price);
	}
	
	public static function createFromExistingOffer(OfferId $id, self $offer) : self {
		$that = new static($id, $offer->offertable, $offer->price);
		$that->addOptionals(...$offer->optionals);
		return $that;
	}
	
	public function addOptionals(Optional... $optionals) : void {
		$this->assertNoConflict($optionals);
		$this->optionals += $optionals;
	}
	
	public function addDiscountApplyble(DiscountInterface $discount) : void {
		if ($discount->isAmountGreaterThan($this->price)) {
			throw new LogicalException("discount amount can't  be greater than the original price");
		}
		$this->discountApplyables[] = $discount->id();
	}
	
	public function removeOptional(OptionalIdCollection $optionalIds) : void {
		$this->optionals = array_filter($this->optionals, function($optional) {
			return !$optionalsIds->has($optional->id());
		});
	}
	
	public function removeDiscountApplyable(DiscountId $discountId) : void {
		$this->discountApplyables = array_filter($this->discountApplyables, function ($discount) {
			return !$discount->isSame($discountId);
		});
	}
	
	public function changePrice(Price $price) : void {
		if ($this->price->isSame($price)) {
			return;
		}
		$this->price = $price;
	}
	
	//@throw OptionalsInConflictException
	private function assertNoConflict(array $optionals) : void{
		while (count($optionals)) {
			$optional = array_shift($optionals);
			
			foreach ($optionals as $optToCheck) {
				if ($optional->hasConflictWith($optToCheck)) {
					throw new OptionalsInConflictException::conflictBetween($optional, $optToCheck);
				}
			}
			
			foreach ($this->optionals as $optToCheck) {
				if ($optional->hasConflictWith($optToCheck)) {
					throw new OptionalsInConflictException::conflictBetween($optional, $optToCheck);
				}
			}
		}
	}
}

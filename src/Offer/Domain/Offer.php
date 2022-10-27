<?php
declare(strict_types=1);
namespace App\Offer\Domain;

/*
	L'offerta fa riferimento a un offertable(servizio o prodotto)
	Fornisce una lista di optional
	Possiede un prezzo
*/

use App\Common\{
	OfferId
,	DiscountId
,	ServicePackId
,	OffertableId
,	MoneyInterface as Price //da rivedere
};

final class Offer
{
	private OfferId $id;
	private OffertableId $offertableId;
	private ServicePackId $servicePackId;
	private Price $price;
	private array $discountApplyables = [];
	
	private function __construct(
		OfferId $id
	,	OffertableId $offertableId
	,	ServicePackId $servicePackId
	,	Price $price
	){
		$this->id = id;
		$this->offertableId = $offertableId;
		$this->servicePackId = $servicePackId;
		$this->price = $price;
	}
	
	public static function create(
		OfferId $id
	,	OffertableId $offertableId
	,	ServicePackId $servicePackId
	,	Price $price
	) : self {
		return new static($id, $offertableId, $servicePackId, $price);
	}
		
	public function addPossibilityOfDiscount(DiscountInterface $discount) : void {
		if ($discount->isAmountGreaterThan($this->price)) {
			throw new LogicalException("discount amount can't  be greater than the original price");
		}
		$this->discountApplyables[] = $discount->id();
	}
	
	public function removePossibilityOfDiscount(DiscountId $discountId) : void {
		$this->discountApplyables = array_filter($this->discountApplyables, function ($discount) use ($discountId) {
			return !$discount->isSame($discountId);
		});
	}
	
	public function changePrice(Price $price) : void {
		if ($this->price->isSame($price)) {
			return;
		}
		$this->price = $price;
	}
}

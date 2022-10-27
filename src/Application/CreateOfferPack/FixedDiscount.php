<?php
declare(strict_types=1);
namespace App\Application\CreateOfferPack;

use App\Domain\MoneyInterface as Amount;

//sto considerando l'idea che lo sconto in OfferPack sia differente da quello delle Offers

final class FixedDiscount implements DiscountInterface
{
	private Amount $amount;
	
	private function __construct(
		Amount $amount
	) {
		$this->amount = $amount;
	}
	
	public static function fromAmount(Amount $amount) : self {
		return new static($amount);
	}
	
	public function isAmountGreaterThan(Amount $amount) : bool {
		return $this->amount->isGreaterThan($amount);
	}
	
	public function isSame(DiscountInterface $discount) : bool {
		if (!$discount instanceof self) {
			return false;
		}
		return $this->amount->isSame($discount->amount);
	}
}

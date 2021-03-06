<?php
declare(strict_types=1);
namespace App\Application\CreateOfferPack;

use App\Domain\MoneyInterface as Amount;

final class PercentageDiscount implements DiscountInterface
{
	private Percentage $percentage;
	
	private function __construct(Percentage $percentage) {
		$this->percentage = $percentage;
	}
	
	public static function fromPercentage(Percentage $percentage) : self {
		return new static($percentage);
	}
	
	public static function fromString(string $percentage) : self {
		return new static(Percentage::fromString($percentage));
	}
	
	public static function fromFloat(float $percentage) : self {
		return new static(Percentage::fromFloat($percentage));
	}
	
	public function isAmountGreaterThan(Amount $amount) : bool {
		return false;
	}
	
	public function isSame(DiscountInterface $discount) : bool {
		if (!$discount instanceof self) {
			return false;
		}
		return $this->percentage->isSame($discount->percentage);
	}
}

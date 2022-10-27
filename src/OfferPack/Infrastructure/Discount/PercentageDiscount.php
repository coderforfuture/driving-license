<?php
declare(strict_types=1);
namespace App\OfferPack\Infrastructure\Discount;

use App\Common\MoneyInterface as Amount;
use App\OfferPack\Domain\DiscountInterface;

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
		return $this->percentage->isGreaterThan(Percentage::hundredPercent());
	}
	
	public function isSame(DiscountInterface $discount) : bool {
		if (!$discount instanceof self) {
			return false;
		}
		return $this->percentage->isSame($discount->percentage);
	}
}

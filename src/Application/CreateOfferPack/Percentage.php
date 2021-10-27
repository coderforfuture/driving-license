<?php
declare(strict_types=1);
namespace App\Application\CreateOfferPack;

final class Percentage
{
	private float $percentage;
	
	public static function fromString(string $percentage) : self {
		//should I use a formatter for that?
	}
	
	public static function fromFloat(float $percentage) : self {
		return new static($percentage);
	}
	
	public static function hundredPercent() : self {
		return new static(1.0);
	}
	
	private function __construct(float $percentage)  {
		if ($percentage < 0) {
			throw new InvalidArgumentException("Percentage cannot be negative");
		}
		
		$this->percentage = $percentage;
	}
	
	public function isGreaterThan(self $percentage) : bool {
		return $this->percentage > $percentage->percentage;
	}	
	
	public function isSame(self $percentage) : bool {
		return $this->percentage === $percentage->percentage;
	}
}

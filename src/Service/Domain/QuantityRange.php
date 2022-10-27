<?php
declare(strict_types=1);
namespace App\Service\Domain;

final class QuantityRange 
{
	private int $min;
	private int $max;
	
	private function __construct(int $min, int $max) {
		if ($min <= 0) {
			throw new InvalidArgumentException("Too low min value");
		}
		if ($max <= 0) {
			throw new InvalidArgumentException("The max value cannot be zero or minus");
		}
		if ($min > $max) {
			throw new InvalidArgumentException("The min value cannot be greater than max value");
		}
		$this->min = $min;
		$this->max = $max;
	}
	
	public static function create(int $min, int $max) : self {
		return new static($min, $max);
	}
}

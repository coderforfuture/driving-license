<?php
declare(strict_types=1);
namespace App\Service\Domain;

//todo: capire se con i metodi withMax e withMin sia il caso di lascirli come stanno
// o lanciare un exception in caso di argomenti non validi

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
	
	public static function fromArray(array $ary) : self {
		return new static($ary[0], $ary[1]);
	}
	
	public function withMax(int $max) : self {
		if ($max === $this->max) {
			return $this;
		}
		if ($max < $this->min) {
			$max = $this->min;
		}
		$that = clone $this;
		$that->max = $max;
		return $that;
	}
	
	public function withMin(int $min) : self {
		if ($min === $this->min) {
			return $this;
		}
		if ($min <= 0) {
			$min = 0;
		}
		if ($min > $this->max) {
			$min = $this->max;
		}
		$that = clone $this;
		$that->min = $min;
		return $that;
	}
	
	public function isSame(self $quantityRange) : bool {
		return $this->min === $quantityRange->min && $this->max === $quantityRange->max;
	}
	
	public function toArray() : array {
		return [$this->min, $this->max];
	}
}

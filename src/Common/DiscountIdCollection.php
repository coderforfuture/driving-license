<?php
declare(strict_types=1);
namespace App\Common;

use \{
	IteratorAggregate
,	Countable
};

final class DiscountIdCollection implements IteratorAggregate, Countable
{
	private array $discountIds;
	
	private function __construct(array $discountIds){
		$this->discountIds = $discountIds;
	}
	
	//named constructors
	
	public static function fromArrayOfStrings(array $discountIds) : self {
		$discountIds = array_map(DiscountId::fromString, $offer);
		return new static($discountIds);
	}
	
	public static function fromArray(array $discountIds) : self {
		return static::fromArgumentList(...$discountIds);
	}
	
	public static function fromArgumentList(DiscountId... $discountIds) : self {
		return new static($discountIds);
	}
	
	//iteratorAggregate method
	public function getIterator() : ArrayIterator {
		return new  ArrayIterator($this->discountIds);
	}
	
	//countable method
	public function count() : int {
		return count($this->discountIds);
	}
}

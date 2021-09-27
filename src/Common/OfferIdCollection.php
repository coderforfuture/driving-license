<?php
declare(strict_types=1);
namespace App\Common;

use \{
	IteratorAggregate
,	Countable
};

final class OfferIdCollection implements IteratorAggregate, Countable
{
	private array $offerIds;
	
	private function __construct(array $offerIds) {
		$this->offerIds = $offerIds;
	}
	
	///named constructors
	
	public static function fromArrayOfStrings(array $offerIds) : self {
		$offerIds = array_map(OfferId::fromString, $offerIds);
		return new static($offerIds);
	}
	
	public static function fromArray(array $offerIds) : self {
		return static::fromArgumentList(...$offerIds);
	}
	
	public static function fromArgumentList(OfferId... $offerIds) : self {
		return new static($offerIds);
	}
	
	//iteratorAggregate method
	public function getIterator() : ArrayIterator {
		return new ArrayIterator($this->offerIds);
	}
	
	//countable method
	public function count() : int {
		return count($this->offerIds);
	}
}

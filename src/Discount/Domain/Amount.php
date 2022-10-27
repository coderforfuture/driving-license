<?php
declare(strict_types=1);
namespace App\Discount\Domain;

//todo: finisci

final class Amount
{
	private $amount;
	
	public static function fromString(string $amount) : self {
		//todo
		//return new static($amount);
	}
	
	public static function fromFloat(float $amount) : self {
		//todo
		//return new static();
	}
	
	public function isSame(self $amount) : bool {
		return $this->amount === $amount->amount;
	}
}

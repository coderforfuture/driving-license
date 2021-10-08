<?php
declare(strict_types=1);
namespace App\Discount\Domain;

use App\Common\MoneyInterface;
//todo: finisci

final class Amount implements MoneyInterface
{
	private string $amount; //?
	
	public static function fromString(string $amount) : self {
		//todo
		//return new static($amount);
	}
	
	public static function fromFloat(float $amount) : self {
		//todo
		//return new static();
	}
	
	public function isSame(MoneyInterface $amount) : bool {
		return $this->toFloat() === $amount->toFloat();
	}
}

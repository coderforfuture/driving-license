<?php
declare(strict_types=1);
namespace App\Domain\Discount;

use App\Domain\DiscountId;

final class Discount
{
	private DiscountId $id;
	private Amount $amount;
	private string $title = "";
	private string $description = "";
	
	private function __construct(
		DiscountId $id
	,	Amount $amount
	){
		$this->id = $id;
		$this->amount = $amount;
	}
	
	public static function create(
		DiscountId $id
	,	DiscountAmount $amount
	) : self {
		return new static($id, $amount);
	}
	
	public function changeAmount(Amount $amount) : void {
		if ($this->amount->isSame($amount)) {
			return;
		}
		$this->amount = $amount;
	}
	
	public function changeTitle(string $title) : void {
		if ($this->title === $title) {
			return;
		}
		$this->title = $title;
	}
	
	public function changeDescription(string $description) : void {
		if ($this->description === $description) {
			return;
		}
		$this->description = $description;
	}
}

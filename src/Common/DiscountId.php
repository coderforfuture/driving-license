<?php
declare(strict_types=1);
namespace App\Common;

final class DiscountId
{
	private string $id;
	
	private function __construct(string $id) {
		$this->id = $id;
	}
	
	public static function fromString(string $id) : self {
		return new static($id);
	}
	
	public function isSame(self $discountId) : bool {
		return $discountId->id === $this->id;
	}
}

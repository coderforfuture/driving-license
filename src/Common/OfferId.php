<?php
declare(strict_types=1);
namespace App\Commmon;

final class OfferId
{
	private string $id;
	
	private function __construct(string $id) {
		$this->id = $id;
	}
	
	public static function fromString(string $id) : self {
		return new static($id);
	}
	
	public function isSame(self $offerId) : bool {
		return $offerId->id === $this->id;
	}
}

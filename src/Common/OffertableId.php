<?php
declare(strict_types=1);
namespace App\Common;

final class OffertableId
{
	private string $id;
	
	private function __construct(string $id) {
		$this->id = $id;
	}
	
	public static function fromString(string $id) : self {
		return new static($id);
	}
	
	public function isSame(self $offertableId) : bool {
		return $this->id === $offertableId->id;
	}
	
	public function toString() : string {
		return $this->id;
	}
}

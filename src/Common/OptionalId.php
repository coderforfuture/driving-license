<?php
declare(strict_types=1);
namespace App\Common;

final class OptionalId
{
	private string $id;
	
	private function __construct(string $id) {
		$this->id = $id;
	}
	
	public static function fromString(string $id) : self {
		return new static($id);
	}
	
	public function isSame(self $optionalId) : bool {
		return $optionalId->id === $this->id;
	}
}

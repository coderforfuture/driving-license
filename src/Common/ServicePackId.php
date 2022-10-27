<?php
declare(strict_types=1);
namespace App\Common;

final class ServicePackId
{
	private string $id;
	
	private function __construct(string $id) {
		$this->id = $id;
	}
	
	public static function fromString(string $id) : self {
		return new static($id);
	}
	
	public function isSame(self $servicePackId) : bool {
		return $this->id === $servicePackId->id;
	}
}
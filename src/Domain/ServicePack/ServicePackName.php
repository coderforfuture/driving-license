<?php
declare(strict_types=1);
namespace App\Domain\ServicePack;

final class ServicePackName
{
	private string $name;
	
	private function __construct(string $name) {
		$this->name = $name;
	}
	
	public static function fromString(string $name) : self {
		return new static($name);
	}
	
	public function toString() : string {
		return $this->name;
	}
}

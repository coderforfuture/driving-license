<?php
declare(strict_types=1);
namespace App\Service\Domain;

final class Description
{
	private string $description;
	
	private function __construct(string $description) {
		$this->description = $description;
	}
	
	public static function fromString(string $description) : self {
		return new static($description);
	}
	
	public static function empty() : self {
		return new static("");
	}
}

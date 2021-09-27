<?php
declare(strict_types=1);
namespace App\Common;

final class OptionalIdCollection
{
	private array $optionals;
	
	private function __construct(array $optionals) {
		$this->optionals = $optionals;
	}
	
	public static function fromArrayOfStrings(array $optionalIds) : self {
		$optionalIds = array_map(OptionalId::fromString, $optionalIds);
	}
	
	public function has(OptionalId $optionalId) : bool {
		foreach ($this->optionals as $optional) {
			if ($optionalId->isSame($optional)) {
				return true;
			}
		}
		return false;
	}
}

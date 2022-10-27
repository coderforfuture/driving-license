<?php
declare(strict_types=1);
namespace App\Domain;

final class OfferId
{
	private string $id;
	
	private function __construct(string $id) {
		if (strpos($id,"-")===false) {
			throw new InvalidArgumentException("");
		} 
		$this->id = $id;
	}
	
	public static function fromString(string $id) : self {
		return new static($id);
	}
	
	public static function fromOffertableAndServicePack(
		OffertableId $offertable
	,	ServicePackId $servicePack
	) : self {
		$id = $offertable->toString() . "-" . $servicePack->toString();
		return new static($id);
	}
	
	public function isSame(self $offerId) : bool {
		return $offerId->id === $this->id;
	}
}

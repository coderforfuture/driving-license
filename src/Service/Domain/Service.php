<?php
declare(strict_types=1);
namespace App\Service\Domain;

use App\Common\ServiceId;

final class Service
{
	private QuantityRange $quantityRange;
	private ServiceId $id;
	private Description $description;
	
	private function __construct(
		ServiceId $id
	,	QuantityRange $quantityRange
	,	Description $description
	) {
		$this->id = $id;
		$this->quantityRange = $quantityRange;
		$this->description = $description;
	}
	
	public static function create(
		ServiceId $id
	,	QuantityRange $quantityRange
	,	Description $description
	) : self {
		return new static($id, $quantityRange, $description);
	}
}

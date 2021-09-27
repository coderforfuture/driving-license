<?php
declare(strict_types=1);
namespace App\Offer\Domain;

use App\Common\OptionalId;

interface OptionalInterface
{
	public function id() : OptionalId;
	
	public function hasConflictWith(OptionalInterface $optional) : bool;
}

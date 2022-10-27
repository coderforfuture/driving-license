<?php
declare(strict_types=1);
namespace App\Offer\Exception;
//da spostare in ServicePack e cambiare il nome in ServicesInConflict
use \{
	Throwable
,	DomainException
};

final class OptionalsInConflictException extends DomainException implements Throwable
{
	private OptionalInterface $opt1;
	private OptionalInterface $opt2;
	
	private function __construct(string $message, OptionalInterface $opt1, OptionalInterface $opt2) {
		parent::__construct($message);
		$this->opt1 = $opt1;
		$this->opt2 = $opt2;
	}
	
	public static function conflictBetween(OptionalInterface $opt1, OptionalInterface $opt2) : self {
		return new static("Thre is a conflict between two optionals", $opt1, $opt2);
	}
	
	public function getConflictedOptionals() : array {
		return [$this->opt1, $this->opt2];
	}
}

<?php
declare(strict_types = 1);
namespace App\OfferAggregate\Domain;

use App\Common\OfferIdCollection;


final class OfferAdder
{
	private bool $mustThrow;
	
	public function __construct(bool $mustThrow = false) {
		$this->mustThrow = $mustThrow;
	}
	
	public function addOffers(
		OfferProviderInterface $offerProvider
	,	OfferAggregateInterface $offerAggregate
	,	OfferIdCollection $offerIds
	) : void {
		$offers = $this->offerProvider->provide($offerIds);
		
		if ($this->mustThrow && count($offers) !== count($offersIds)) {
			throw new Exception("not all the offers are founded"); //scegliere una eccezione migliore
		}
		
		foreach ($offers as $offer) {
			//potrebbe lanciare un eccezione
			//devo gestirla qui? oppure più in alto?
			//se creassi uno strategyObject per la gestione del'eccezione 
			$offerAggregate->addOffer($offer);
		}
	}
}

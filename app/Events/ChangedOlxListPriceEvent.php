<?php

namespace App\Events;

use App\Models\OlxListing;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangedOlxListPriceEvent
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public int $newPrice;
	public int $oldPrice;
	public OlxListing $listing;

	/**
	 * Create a new event instance.
	 */
	public function __construct(OlxListing $listing, int $oldPrice, int $newPrice)
	{
		$this->listing = $listing;
		$this->oldPrice = $oldPrice;
		$this->newPrice = $newPrice;
	}
}

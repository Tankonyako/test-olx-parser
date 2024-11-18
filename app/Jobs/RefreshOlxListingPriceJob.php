<?php

namespace App\Jobs;

use App\Models\OlxListing;
use App\Services\OlxParser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RefreshOlxListingPriceJob implements ShouldQueue
{
	use Queueable;

	public OlxListing $listing;

	/**
	 * Create a new job instance.
	 */
	public function __construct(OlxListing $listing)
	{
		$this->listing = $listing;
	}

	/**
	 * Execute the job.
	 */
	public function handle(OlxParser $parser): void
	{
		$parsed = $parser->parse($this->listing->url); // Save for adding

		$newPrice = $parsed->price->regularPrice->value; // set this value to check update
//		$newPrice += rand(1, 100); // simulate price change
		
		if ($newPrice != $this->listing->last_price)
		{
			$this->listing->update([
				'last_price' => $newPrice,
			]);
		}
	}
}

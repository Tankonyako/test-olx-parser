<?php

namespace App\Jobs;

use App\Models\OlxListing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RefreshOlxListingsPricesJob implements ShouldQueue
{
	use Queueable;

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$listings = OlxListing::all();
		foreach ($listings as $listing)
		{
			RefreshOlxListingPriceJob::dispatch($listing);
		}
	}
}

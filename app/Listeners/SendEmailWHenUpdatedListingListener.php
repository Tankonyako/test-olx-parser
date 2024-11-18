<?php

namespace App\Listeners;

use App\Events\ChangedOlxListPriceEvent;
use App\Mail\ListingPriceChangedMail;
use Illuminate\Support\Facades\Mail;

class SendEmailWHenUpdatedListingListener
{
	/**
	 * Create the event listener.
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 */
	public function handle(ChangedOlxListPriceEvent $event): void
	{
		Mail::to($event->listing->email)->send(new ListingPriceChangedMail($event->listing, $event->oldPrice, $event->newPrice));
	}
}

<?php

use App\Jobs\RefreshOlxListingsPricesJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
	$this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('olx:refresh', function () {
	RefreshOlxListingsPricesJob::dispatch();

	$this->info('OLX listings prices refreshed');
})->purpose('Refresh OLX listings prices')->daily();

Schedule::command('olx:refresh')->everyMinute();
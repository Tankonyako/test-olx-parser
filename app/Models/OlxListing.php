<?php

namespace App\Models;

use App\Events\ChangedOlxListPriceEvent;
use Illuminate\Database\Eloquent\Model;

class OlxListing extends Model
{
	protected $fillable = [
		'ad_id',
		'url',
		'email',
		'title',
		'description',
		'initial_price',
		'last_price',
		'currency',
		'photos',
		'created_at',
		'updated_at',
		'parsed_at',
	];

	protected $casts = [
		'ad_id' => 'integer',
		'initial_price' => 'float',
		'last_price' => 'float',
		'photos' => 'array',
	];

	public static function boot()
	{
		parent::boot();
		static::updating(function (OlxListing $listing) {
			if ($listing->isDirty('last_price'))
			{
				$diff = $listing->last_price - $listing->getOriginal('last_price');

				if ($diff != 0)
				{
					event(new ChangedOlxListPriceEvent($listing, $listing->getOriginal('last_price'), $listing->last_price));
				}
			}
		});
	}

}

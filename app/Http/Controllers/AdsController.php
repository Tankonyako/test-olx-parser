<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOLXAdRequest;
use App\Models\OlxListing;
use App\Services\OlxParser;
use Exception;
use Illuminate\Validation\ValidationException;

class AdsController
{
	public function index()
	{
		dd(1);
	}

	public function list()
	{
		return response()->json(OlxListing::query()->get());
	}

	public function delete(OlxListing $listing)
	{
		$listing->delete();
		return response()->json(['message' => 'Ad deleted']);
	}

	public function addAd(AddOLXAdRequest $request, OlxParser $parser)
	{
		try
		{
			$parsed = $parser->parse($request->getUrl(), true); // Save for adding

			if (OlxListing::query()->where('ad_id', $parsed->id)->exists())
			{
				throw new Exception('Ad already exists');
			}

			$listing = OlxListing::create([
				'ad_id' => $parsed->id,
				'url' => $parsed->url,
				'email' => $request->getEmail(),
				'title' => $parsed->title,
				'description' => $parsed->description,
				'initial_price' => $parsed->price->regularPrice->value,
				'last_price' => $parsed->price->regularPrice->value,
				'currency' => $parsed->price->regularPrice->currencyCode,
				'photos' => $parsed->photos,
				'parsed_at' => now(),
			]);

			return response()->json($listing);
		}
		catch (Exception $e)
		{
			throw ValidationException::withMessages([
				'url' => $e->getMessage()
			]);
		}
	}
}
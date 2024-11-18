<?php

namespace App\Services;

use App\Utils\OlxParsed;
use Exception;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OlxParser
{

	public function parse(string $url, $cache = false): OlxParsed
	{
		$cookieJar = new CookieJar();

		$response = Cache::remember('parsed_' . md5($url), $cache ? now()->addDay() : now(), fn() => Http::withOptions([
			'headers' => [
				...config('olx.praser.headers', []),
//			'User-Agent' => Factory::create()->chrome() // TODO: random useragent
			],
			'cookies' => $cookieJar
		])->get($url)->throw()->body());

		return self::parseBody($response);
	}

	public function parseBody(string $responseText): OlxParsed
	{
		// Check if the response contains the expected state
		if (strpos($responseText, '__PRERENDERED_STATE__') === false)
		{
			throw new Exception("Cannot find listings!");
		}

		// Extract the JSON part from the response
		$splitted = explode('__PRERENDERED_STATE__', $responseText)[1];
		$splitted = explode("\";\n", $splitted)[0];
		$splitted = substr($splitted, 3);

		// Clean up the JSON string
		$splitted = str_replace(['\\"', '\\\\u002F'], ['"', '/'], $splitted);
		$splitted = str_replace(['\\"', '\\\\u002F'], ['"', '/'], $splitted);

		// replace all \\"" with nothing
		$splitted = str_replace('\\""', '"', $splitted);

		try
		{
			$json = json_decode($splitted, true);
			if (json_last_error() !== JSON_ERROR_NONE)
			{
				throw new Exception("Cannot parse JSON!");
			}

			$ad = $json['ad']['ad'] ?? [];

			$ad = OlxParsed::fromArray($ad);

			if (!$ad->id)
			{
				throw new Exception("Cannot find ad ID!");
			}

			return $ad;
		}
		catch (Exception $e)
		{
			throw new Exception("Cannot parse JSON!");
		}
	}
}
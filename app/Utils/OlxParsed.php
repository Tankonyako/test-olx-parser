<?php

namespace App\Utils;

class OlxParsed
{
	public int $id;
	public string $title;
	public string $description;
	public Category $category;
	public Map $map;
	public bool $isBusiness;
	public string $url;
	public bool $isHighlighted;
	public bool $isPromoted;
	public bool $protectPhone;
	public string $createdTime;
	public string $lastRefreshTime;
	public string $validToTime;
	public bool $isActive;
	public string $status;
	public array $params;
	public string $itemCondition;
	public Price $price;
	public ?int $salary;
	public bool $isJob;
	public array $photos;
	public array $photosSet;
	public string $urlPath;

	public static function fromArray(array $data): self
	{
		$instance = new self();

		$instance->id = $data['id'];
		$instance->title = $data['title'];
		$instance->description = $data['description'];
		$instance->category = Category::fromArray($data['category']);
		$instance->map = Map::fromArray($data['map']);
		$instance->isBusiness = $data['isBusiness'];
		$instance->url = $data['url'];
		$instance->isHighlighted = $data['isHighlighted'];
		$instance->isPromoted = $data['isPromoted'];
		$instance->protectPhone = $data['protectPhone'];
		$instance->createdTime = $data['createdTime'];
		$instance->lastRefreshTime = $data['lastRefreshTime'];
		$instance->validToTime = $data['validToTime'];
		$instance->isActive = $data['isActive'];
		$instance->status = $data['status'];
		$instance->params = $data['params']; // Params may need deeper conversion if structured
		$instance->itemCondition = $data['itemCondition'];
		$instance->price = Price::fromArray($data['price']);
		$instance->salary = $data['salary'];
		$instance->isJob = $data['isJob'];
		$instance->photos = $data['photos'];
		$instance->photosSet = $data['photosSet'];
		$instance->urlPath = $data['urlPath'];

		return $instance;
	}
}

class Category
{
	public int $id;
	public string $type;

	public static function fromArray(array $data): self
	{
		$instance = new self();
		$instance->id = $data['id'];
		$instance->type = $data['type'];
		return $instance;
	}
}

class Map
{
	public int $zoom;
	public float $lat;
	public float $lon;
	public int $radius;
	public bool $show_detailed;

	public static function fromArray(array $data): self
	{
		$instance = new self();
		$instance->zoom = $data['zoom'];
		$instance->lat = $data['lat'];
		$instance->lon = $data['lon'];
		$instance->radius = $data['radius'];
		$instance->show_detailed = $data['show_detailed'];
		return $instance;
	}
}

// Similarly, add `fromArray` static methods for other classes like Promotion, Delivery, Rock, Price, etc.

class Price
{
	public bool $budget;
	public bool $free;
	public bool $exchange;
	public string $displayValue;
	public RegularPrice $regularPrice;

	public static function fromArray(array $data): self
	{
		$instance = new self();
		$instance->budget = $data['budget'];
		$instance->free = $data['free'];
		$instance->exchange = $data['exchange'];
		$instance->displayValue = $data['displayValue'];
		$instance->regularPrice = RegularPrice::fromArray($data['regularPrice']);
		return $instance;
	}
}

class RegularPrice
{
	public int $value;
	public string $currencyCode;
	public string $currencySymbol;
	public bool $negotiable;
	public PriceFormatConfig $priceFormatConfig;

	public static function fromArray(array $data): self
	{
		$instance = new self();
		$instance->value = $data['value'];
		$instance->currencyCode = $data['currencyCode'];
		$instance->currencySymbol = $data['currencySymbol'];
		$instance->negotiable = $data['negotiable'];
		$instance->priceFormatConfig = PriceFormatConfig::fromArray($data['priceFormatConfig']);
		return $instance;
	}
}

class PriceFormatConfig
{
	public string $decimalSeparator;
	public string $thousandsSeparator;

	public static function fromArray(array $data): self
	{
		$instance = new self();
		$instance->decimalSeparator = $data['decimalSeparator'];
		$instance->thousandsSeparator = $data['thousandsSeparator'];
		return $instance;
	}
}
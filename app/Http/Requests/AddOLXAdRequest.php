<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddOLXAdRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'url' => ['required', 'url'],
			'email' => ['required', 'email'],
		];
	}

	public function getUrl(): string
	{
		return $this->get('url');
	}

	public function getEmail(): string
	{
		return $this->get('email');
	}
}

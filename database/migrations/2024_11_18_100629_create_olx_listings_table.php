<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('olx_listings', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('ad_id');
			$table->string('url');
			$table->string('title');
			$table->string('email');
			$table->longText('description')->nullable();
			$table->float('initial_price', 8, 2)->nullable();
			$table->float('last_price', 8, 2)->nullable();
			$table->string('currency', 10)->nullable();
			$table->json('photos')->nullable();
			$table->timestamp('parsed_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('olx_listings');
	}
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index(); // Removed foreign key constraint
            $table->string('address_line', 255);
            $table->bigInteger('city_id');
            $table->bigInteger('state_id');
            $table->bigInteger('country_id');
            $table->string('zip_code', 10);
            $table->tinyInteger('type')->unsigned()->default(1)->comment('1 = Shipping, 2 = Billing');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

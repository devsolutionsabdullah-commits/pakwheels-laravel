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
    Schema::create('car_ads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('city');
        $table->string('car_info');
        $table->string('registered_in');
        $table->string('exterior_color');
        $table->integer('mileage');
        $table->string('engine_type');
        $table->string('vehicle_condition');
        $table->text('description');
        $table->decimal('price', 12, 2);
        $table->text('features')->nullable();
        $table->string('mobile_number');
        $table->string('secondary_number')->nullable();
        $table->boolean('whatsapp_enabled')->default(false);
        $table->string('image_1')->nullable();
        $table->string('image_2')->nullable();
        $table->string('image_3')->nullable();
        $table->string('image_4')->nullable();
        $table->string('image_5')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_ads');
    }
};

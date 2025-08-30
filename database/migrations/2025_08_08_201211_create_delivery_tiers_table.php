<?php

use App\Models\DeliveryOption;
use App\Models\User;
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
        Schema::create('delivery_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_option_id')->constrained(DeliveryOption::table);
            $table->decimal('max_weight');
            $table->decimal('price');
            $table->boolean('status')->default(true);
            $table->bigInteger('version')->default(1);
            $table->foreignId('created_by')->nullable()->constrained(User::table);
            $table->foreignId('updated_by')->nullable()->constrained(User::table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_tiers');
    }
};

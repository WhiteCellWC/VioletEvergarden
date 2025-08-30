<?php

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
        Schema::create('envelope_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->bigInteger('stock');
            $table->decimal('price');
            $table->text('description');
            $table->boolean('is_premium')->default(false);
            $table->decimal('discount')->nullable();
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
        Schema::dropIfExists('envelope_types');
    }
};

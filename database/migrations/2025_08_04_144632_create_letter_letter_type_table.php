<?php

use App\Models\Letter;
use App\Models\LetterType;
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
        Schema::create('letter_letter_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_id')->constrained(Letter::table);
            $table->foreignId('letter_type_id')->constrained(LetterType::table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_letter_type');
    }
};

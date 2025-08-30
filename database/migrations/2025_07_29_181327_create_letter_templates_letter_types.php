<?php

use App\Models\LetterTemplate;
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
        Schema::create('letter_templates_letter_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_template_id')->constrained(LetterTemplate::table);
            $table->foreignId('letter_type_id')->constrained(LetterType::table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_templates_letter_types');
    }
};

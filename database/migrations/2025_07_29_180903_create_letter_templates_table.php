<?php

use App\Models\EnvelopeType;
use App\Models\FragranceType;
use App\Models\PaperType;
use App\Models\User;
use App\Models\WaxSealType;
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
        Schema::create('letter_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->enum('send_type', ['send-type-1', 'send-type-2', 'send-type-3']);
            $table->foreignId('paper_type_id')->constrained(PaperType::table);
            $table->foreignId('fragrance_type_id')->constrained(FragranceType::table);
            $table->foreignId('envelope_type_id')->constrained(EnvelopeType::table);
            $table->foreignId('wax_seal_type_id')->constrained(WaxSealType::table);
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
        Schema::dropIfExists('letter_templates');
    }
};

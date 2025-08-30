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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(User::table);
            $table->string('title');
            $table->text('body');
            $table->enum('send_type', ['send-type-1', 'send-type-2']);
            $table->foreignId('paper_type_id')->constrained(PaperType::table);
            $table->foreignId('fragrance_type_id')->constrained(FragranceType::table);
            $table->foreignId('envelope_type_id')->constrained(EnvelopeType::table);
            $table->foreignId('wax_seal_type_id')->constrained(WaxSealType::table);
            $table->boolean('is_draft')->default(true);
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_sealed')->nullable();
            $table->boolean('is_printed')->default(false);
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
        Schema::dropIfExists('letters');
    }
};

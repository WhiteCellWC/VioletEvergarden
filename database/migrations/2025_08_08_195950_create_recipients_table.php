<?php

use App\Models\Country;
use App\Models\Letter;
use App\Models\State;
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
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(User::table);
            $table->foreignId('letter_id')->constrained(Letter::table);
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->json('variables');
            $table->foreignId('country_id')->constrained(Country::table);
            $table->foreignId('state_id')->constrained(State::table);
            $table->string('postal_code');
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
        Schema::dropIfExists('recipients');
    }
};

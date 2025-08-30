<?php

use App\Models\Letter;
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
        Schema::create('letter_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_id')->constrained(Letter::table);
            $table->decimal('amount');
            $table->string('payment_method');
            $table->enum('status', ['status-1', 'status-2']);
            $table->string('transaction_id');
            $table->timestamp('paid_at')->useCurrent();
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
        Schema::dropIfExists('letter_payments');
    }
};

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('paymentid')->default(null);
            $table->enum('coursetype', ['main', 'knowledge']);
            $table->string('orderid')->default(null);
            $table->string('courseid')->default(null);
            $table->string('amount')->default(null);
            $table->unsignedBigInteger('userid')->default(null);
            $table->string('email', 255)->default(null);
            $table->string('status', 20)->default(null);
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->string('taxAmount', 10)->default(null);
            $table->string('netAmount', 10)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

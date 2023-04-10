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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('transaction_code');
            $table->string('transaction_id');
            $table->string('counter');
            $table->dateTime('transaction_date');
            $table->text('description')->nullable(true);
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id')->on('users');
            $table->foreign('transaction_code')
                ->references('transaction_code')->on('transaction_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

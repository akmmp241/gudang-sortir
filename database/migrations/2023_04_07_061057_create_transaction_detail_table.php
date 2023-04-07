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
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('id_user');
            $table->integer('quantity')->default(0);
            $table->text('description');
            $table->timestamps();

            $table->foreign('transaction_id')
                ->references('id')->on('transaction');
            $table->foreign('item_id')
                ->references('id')->on('items');
            $table->foreign('id_user')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};

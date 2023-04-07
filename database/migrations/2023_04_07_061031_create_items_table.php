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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('item_id');
            $table->unsignedBigInteger('id_category');
            $table->string('counter');
            $table->string('name_item');
            $table->integer('quantity')->default(0);
            $table->text('description');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id')->on('users');
            $table->foreign('id_category')
                ->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

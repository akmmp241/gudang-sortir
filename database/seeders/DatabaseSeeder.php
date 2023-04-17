<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Items;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        TransactionType::factory()->create([
            'transaction_code' => 'BM',
            'transaction_name' => 'Barang Masuk',
            'description' => 'Transaksi barang masuk'
        ]);
        TransactionType::factory()->create([
            'transaction_code' => 'BK',
            'transaction_name' => 'Barang Keluar',
            'description' => 'Transaksi barang keluar'
        ]);
        User::factory(10)->create();
        Category::factory(2)->create();
        Items::factory(10)->create();
    }
}

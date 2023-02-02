<?php

use App\Models\tbl_items;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_items', function (Blueprint $table) {
            $table->id('ItemID');
            $table->string('ItemName');
            $table->decimal('ItemPrice' ,10,2)->default(0.00);
            $table->string('ItemUOM')->default('Pc');
            $table->foreignId('BrandID')->constrained('tbl_brand','BrandID');
            $table->integer('MinStock')->default('0');
            $table->integer('ReorderQty')->default('0');
            $table->string('IsActive')->default('Yes');
            $table->timestamps();
        });
        $data = array(
            ['ItemName' => 'NESTEA Milk Tea Winter Melon Pack of 2', 'ItemPrice' => 190.00, 'ItemUOM' => 'Pack/2s', 'BrandID' => 1, 'MinStock' => 100, 'ReorderQty' => 50],
            ['ItemName' => 'Vita Herb Green Coffee 10 sachets', 'ItemPrice' => 500.00, 'ItemUOM' => 'Box/10s', 'BrandID' => 2, 'MinStock' => 100, 'ReorderQty' => 50],
            ['ItemName' => 'NESTEA Milk Tea Winter Melon Pack of 2', 'ItemPrice' => 220.80, 'ItemUOM' => 'Pack/24s', 'BrandID' => 1, 'MinStock' => 100, 'ReorderQty' => 50],
        );
        foreach ($data as $items){
            $newItems = new tbl_items();
            $newItems ->ItemName = $items['ItemName'];
            $newItems ->ItemPrice = $items['ItemPrice'];
            $newItems ->ItemUOM = $items['ItemUOM'];
            $newItems ->BrandID = $items['BrandID'];
            $newItems ->MinStock = $items['MinStock'];
            $newItems ->ReorderQty = $items['ReorderQty'];
            $newItems->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_items');
    }
};

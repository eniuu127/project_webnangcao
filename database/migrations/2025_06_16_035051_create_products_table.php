<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('products', function ($table) {
        $table->id();
        $table->string('product_name');
        $table->integer('product_price');
        $table->string('product_image')->nullable(); 
        $table->timestamps();
    });
}

};

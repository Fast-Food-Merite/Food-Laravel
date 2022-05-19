<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('price');
            $table->string('image');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });

        DB::table('food')->insert([
            [
                'name' => 'Pizza Bolognaise',
                'description' => 'Venez a Bologne',
                'price' => '1000',
                'image' => 'https://www.freeiconspng.com/img/19323',
                'category_id' => 1,
            ],
            [
                'name' => 'Pizza Burger',
                'description' => 'Un melange de saveur',
                'price' => '2000',
                'image' => 'https://www.freeiconspng.com/img/19323',
                'category_id' => 1,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
}

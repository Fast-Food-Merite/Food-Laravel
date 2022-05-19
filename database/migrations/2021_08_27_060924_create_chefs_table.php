<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateChefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chefs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('role')->unique();
            $table->string('image');
            $table->timestamps();
        });

        DB::table('chefs')->insert([
            [
                'name' => 'Eric',
                'role' => 'Chef',
                'image' => 'https://www.shutterstock.com/fr/image-photo/african-american-chef-uniform-on-dark-556163941',
            ],
            [
                'name' => 'Joanna',
                'role' => 'Assistante',
                'image' => 'https://www.shutterstock.com/fr/image-photo/smiling-african-american-woman-wearing-apron-1916346464',
            ],
            [
                'name' => 'Jean',
                'role' => 'Commis',
                'image' => 'https://www.shutterstock.com/fr/image-photo/cooking-profession-people-concept-happy-male-1426606880',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chefs');
    }
}

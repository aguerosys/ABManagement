<?php

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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            
           $table->unsignedBigInteger('client_id');
        //    $table->unsignedBigInteger('category_id');

            $table->string('code');
            $table->string('description');
            $table->string('details');
            $table->float('price');
            $table->string('status');
            $table->string('category');

            $table->foreign('client_id')->references('id')->on('clients');
            // $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
};

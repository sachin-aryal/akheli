<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("shop_name");
            $table->string("phone_no");
            $table->string("location");
            $table->string("email", 191);
            $table->string("photo");
            $table->integer("user_id")->unsigned();
            //$table->timestamps();
        });
        Schema::table('clients', function($table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

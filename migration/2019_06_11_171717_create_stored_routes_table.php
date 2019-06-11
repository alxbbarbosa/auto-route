<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredRoutesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_routes',
            function (Blueprint $table) {
            $table->increments('id');
            $table->string('verb')->nullable()->defaul('get');
            $table->string('prefix')->nullable();
            $table->string('name')->nullable();
            $table->string('pattern')->nullable();
            $table->string('controller');
            $table->string('method')->nullable();
            $table->string('middleware')->nullable()->default('auth');
            $table->boolean('resource')->defaul(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stored_routes');
    }
}
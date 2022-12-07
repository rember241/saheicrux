<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('title');
            $table->string('path');
            $table->string('icon');
            $table->string('color')->nullable();
            $table->integer('parent_id')->default(0);
            $table->boolean('isActive')->default(0);
            $table->integer('sorting')->nullable();
            $table->boolean('is_read')->default(0);
            $table->boolean('is_create')->default(0);
            $table->boolean('is_edit')->default(0);
            $table->boolean('is_delete')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}

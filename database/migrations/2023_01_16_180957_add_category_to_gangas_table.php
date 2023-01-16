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
        Schema::table('gangas', function (Blueprint $table) {
            $table->bigInteger('category')->after('user_id')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gangas', function (Blueprint $table) {
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->dropForeign('category');
        });
    }
};

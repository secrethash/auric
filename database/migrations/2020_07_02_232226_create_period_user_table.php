<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('period_id');
            $table->bigInteger('amount');
            $table->bigInteger('fees');
            $table->foreignId('transaction_id')->constrained();
            $table->foreignId('number_id')->nullable()->constrained();
            $table->foreignId('color_id')->nullable()->constrained();
            $table->boolean('result')->nullable()->default(null);
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
        Schema::dropIfExists('period_user');
    }
}

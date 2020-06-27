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
            $table->foreignId('transaction_id')->constrained();
            $table->enum('invest_number', [0,1,2,3,4,5,6,7,8,9])->nullable();
            $table->enum('invest_color', ['red','green','violet'])->nullable();
            $table->boolean('result')->default(0);
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

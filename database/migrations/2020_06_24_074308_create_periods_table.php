<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->timestamp('start');
            $table->bigInteger('price')->nullable();
            $table->foreignId('lobby_id')->constrained();
            $table->enum('result_number', [0,1,2,3,4,5,6,7,8,9])->nullable();
            $table->enum('result_color', ['green', 'red'])->nullable();
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('periods');
    }
}

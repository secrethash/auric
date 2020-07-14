<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('short_name')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('type_id');
            $table->string('ifsc')->nullable();
            $table->string('account_number')->nullable();
            $table->string('holder_name')->nullable();
            $table->string('payment_address')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('bank_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}

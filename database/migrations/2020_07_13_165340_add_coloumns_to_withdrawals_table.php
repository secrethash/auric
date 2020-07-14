<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnsToWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->timestamp('phone_verified_at')
                  ->after('note')
                  ->nullable();

            $table->string('verification_code')
                  ->after('phone_verified_at')
                  ->unique()
                  ->nullable();

            $table->timestamp('code_sent_at')
                  ->after('verification_code')
                  ->nullable();

            $table->foreignId('bank_id')
                  ->after('payment_address')
                  ->constrained();

            $table->dropColumn('payment_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn(['phone_verified_at', 'verification_code', 'code_sent_at']);
        });
    }
}

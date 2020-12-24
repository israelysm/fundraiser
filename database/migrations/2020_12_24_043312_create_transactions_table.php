<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('tax_id')->nullable();
            $table->float('amount', 8, 2)->default(0);
            $table->string('receipt_number');
            $table->text('transaction_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_gateway_name')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('payment_response')->nullable();
            $table->string('payment_error_code')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}

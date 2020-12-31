<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id');
            $table->integer('user_id');
            $table->dateTime('pay_day');
            $table->string('status_pay');
            $table->string('token');
            $table->string('correlationid');
            $table->string('build');
            $table->string('PayerID')->nullable();
            $table->string('profileID')->nullable();
            $table->string('profile_status')->nullable();
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
        Schema::dropIfExists('user_plans');
    }
}

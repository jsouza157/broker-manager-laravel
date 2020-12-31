<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();//EX : AP no condominio torres
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('cep');
            $table->string('type');//casa, ap etc...
            $table->integer('floor')->nullable();//andar
            $table->boolean('garage');//garagem
            $table->integer('garage_vacancy')->nullable();//vagas na garagem
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('rentals', 10, 2)->nullable();//aluguel
            $table->text('property_detail')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('user_id');
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
        Schema::dropIfExists('properties');
    }
}

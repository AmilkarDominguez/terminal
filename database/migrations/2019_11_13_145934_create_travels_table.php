<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();//Usuario
            $table->unsignedBigInteger('origen_id')->unsigned()->nullable();
            $table->unsignedBigInteger('destino_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bus_id')->unsigned()->nullable();
            //Custom
            $table->text('code')->nullable();
            $table->text('detalle')->nullable();
            $table->text('latitud')->nullable();
            $table->text('longitud')->nullable();
            $table->date('salida')->nullable();
            $table->date('llegada')->nullable();
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            //RELATIONS
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('origen_id')->references('id')->on('places')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('destino_id')->references('id')->on('places')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('bus_id')->references('id')->on('buses')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('travels');
    }
}

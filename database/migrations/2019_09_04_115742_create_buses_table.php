<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();//Usuario
            $table->unsignedBigInteger('license_id')->unsigned()->nullable();//Targeta de Operacion
            $table->unsignedBigInteger('brand_id')->unsigned()->nullable();//Marca
            //Custom
            $table->text('placa')->nullable();
            //$table->text('marca')->nullable();
            $table->text('chasis')->nullable();
            $table->text('modelo')->nullable();
            $table->integer('asientos')->nullable();
            $table->text('foto')->nullable();
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->timestamps();
            //RELATIONS
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('license_id')->references('id')->on('licenses')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuspicesTable extends Migration
{

    public function up()
    {
        Schema::create('auspices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            //Custom
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->text('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('direccion')->nullable();
            $table->text('telefono')->nullable();
            $table->text('web')->nullable();
            $table->text('contacto')->nullable();
            $table->text('telefono_contacto')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();//Usuario
            //RELATIONS
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('auspices');
    }
}

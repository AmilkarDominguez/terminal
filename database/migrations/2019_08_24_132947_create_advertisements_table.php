<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            //Custom
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->text('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('logo')->nullable();
            $table->text('link')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();//Usuario
            $table->unsignedBigInteger('auspice_id')->unsigned()->nullable();//Auspiciador
            //RELATIONS
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');  
            $table->foreign('auspice_id')->references('id')->on('auspices')
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
        Schema::dropIfExists('advertisements');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReparacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparacion', function (Blueprint $table) {
            
            $table->bigInteger("planilla_id")->unsigned();
            $table->primary("planilla_id");
            $table->boolean("reparado");
            $table->string("observacion");
            $table->timestamps();
            $table->foreign("planilla_id")->references("id")->on("planillas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparacion');
    }
}

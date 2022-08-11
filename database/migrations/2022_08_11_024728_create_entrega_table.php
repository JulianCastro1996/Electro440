<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\once;

class CreateEntregaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if (Schema::hasTable('planillas')) {
           Schema::create('entrega', function (Blueprint $table) {
                $table->bigInteger("planilla_id")->unsigned();
                $table->primary("planilla_id");
                $table->boolean("entregado");
                $table->string("obs_entrega");
                $table->timestamps();
                $table->foreign("planilla_id")->references("id")->on("planillas");
           });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrega');
    }
}

<?php
//namespace fge\apis\migrations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateFoliadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foliados', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('id_nucs')->unsigned();
            $table->text('clave');
            $table->integer('id_estadosnuc')->unsigned();
            $table->text('ip');
            $table->string('nucl',15);
            $table->timestamps();
            //$table->foreign('id_nucs')->references('id')->on('nucs')->onDelete('cascade');
            //$table->foreign('id_modulos')->references('id')->on('modulos')->onDelete('cascade');
            $table->foreign('id_estadosnuc')->references('id')->on('estadosnuc')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foliados');
    }
}
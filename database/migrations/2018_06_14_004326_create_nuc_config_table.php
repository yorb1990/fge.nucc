<?php
//namespace fge\apis\migrations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateNucConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuc_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('clave',4);
            $table->string('fge_url_nuc');
            $table->string('modelo');
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
        Schema::dropIfExists('nuc_config');
    }
}

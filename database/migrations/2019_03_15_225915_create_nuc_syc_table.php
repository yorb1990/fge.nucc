<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNucSycTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuc_syc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carpeta');  
            $table->string('nuc');  
            $table->string('cvv');
            $table->boolean('acuerdo');  
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
        Schema::dropIfExists('nuc_syc');
    }
}

<?php
namespace fge\nucc\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class estadosnuc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estadosnuc')->insert([
            ['id'=>1,'name'=>'generado'],
            ['id'=>2,'name'=>'verificado'],
            ['id'=>3,'name'=>'movido (de modulo)'],
            ['id'=>4,'name'=>'retomado (dentro modulo)'],
            ['id'=>5,'name'=>'habilitado'],
            ['id'=>6,'name'=>'deshabilitado']
        ]);
    }
}
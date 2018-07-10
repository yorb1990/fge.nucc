<?php
namespace fge\nucc\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class nucs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nucs')->insert([
            ['id'=>1,'nuc'=>'','enabled'=>false]
        ]);
    }    
}
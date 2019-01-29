<?php
namespace fge\nucc\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class modulos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$id=DB::table('modulos')->insertGetId([
            'name'=>'test','ip'=>'127.1.1.1','created_at'=>\Carbon\Carbon::now()
        ]);
        $clave=\fge\nucc\src\nuc::getclave($id);
        for($i=strlen($clave);$i<4;$i++){
            $clave="0".$clave;
        }
        DB::table('modulos')->where('id',$id)->update([
            'prefix'=>$clave,
        ]);
        /*DB::table('modulos')->insert([
            ['id'=>1,'name'=>'uat','prefix'=>'ABC'],
            ['id'=>2,'name'=>'upj','prefix'=>'BBC']
        ]);*/
    }    
}
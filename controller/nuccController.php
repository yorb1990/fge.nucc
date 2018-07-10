<?php
namespace fge\nucc\controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class nuccController extends Controller
{
    public function cnuc(Request $request){
        $nuc=$request->input('nuc');
        if(!preg_match('/^[0-9 A-Z]{4}-([0-9 A-Z]){6}-[0-9]{2}$/',$nuc)){
            return \Response::json(['message'=>'formato del nuc invalido'],506);
        }
        $nucr=new \fge\token\src\nuc();
        $nucr->nuccvv($nuc,$request->input('cvv'));
        $error='';
        if($nucr->IsValid($error)){            
            $ipr=$request->ip();        
            $folio=new \fge\token\models\foliodoModel();
            $folio->nucl=$nuc;
            $folio->clave=$request->input('clave');
            $folio->id_estadosnuc=2;
            $folio->ip=$ipr;
            $folio->save();
            return \Response::json('valido',200);
        }
        return \Response::json(['message'=>$error],506);
    }
}
<?php
namespace fge\nucc\controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use fge\nucc\models\ConfigNucModel;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;


class nuccController extends Controller
{
  public function vclave(){
    $nuc = ConfigNucModel::where('name','clave')->first();
    if($nuc == null){
      return \Redirect::to('fge_tok/acceso_nuc')->send();
    }

  }

   public function gnuc()
   {
     $nuc = ConfigNucModel::where('name','clave')->first();

     $http = new Client;
     $response = $http->post('http://192.108.22.52/nuc.server/public/api/gnuc', [
        'verify' => false,
        'form_params' => [
            'clave' => $nuc->clave,
            'code' => request('code'),
        ],
    ]);
      $data = json_decode((string) $response->getBody(), true);
      return (object) $data;
    }

    public function hnuc($carpeta=null, $nuc=null, $cvv = null, $acuerdo = null)
    {
      $n = ConfigNucModel::where('name','clave')->first();

      $http = new Client;
      $response = $http->post('http://192.108.22.52/nuc.server/public/api/hnuc', [
         'verify' => false,
         'form_params' => [
             'carpeta'  => $carpeta,
             'nuc'      => $nuc,
             'cvv'      => $cvv,
             'clave'    => $n->clave,
             'acuerdo'  => $acuerdo,
             'code'     => request('code'),
         ],
     ]);
       $data = json_decode((string) $response->getBody(), true);
       return (object) $data;
     }

}

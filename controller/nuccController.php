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

	public function vclave() {
		$nuc = ConfigNucModel::first();
		if($nuc == null) {

			$http = new Client;
			$response = $http->post($nuc->fge_url_nuc.'/api/regmod', [
				'verify' => false,
				'form_params' => [
					'modulo' => env('APP_NAME'),
					'code' => request('code'),
				],
			]);
			$data = json_decode((string) $response->getBody(), true);

		
			$nuc->clave = $data['message'];
			$nuc->save();
		}
	}

   public function gnuc()
   {
	 try{
		 //$this->vclave();
		 $nuc = ConfigNucModel::first();
		 $http = new Client;
		 $response = $http->post($nuc->fge_url_nuc.'/api/gnuc', [
			'verify' => false,
			'form_params' => [
				'clave' => $nuc->clave,
				'code' => request('code'),
			],
		]);
		  $data = json_decode((string) $response->getBody(), true);
		  return  \Response::json($data,200);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			$message = $e->getMessage();
			return \Response::json($message, 506);
		}
	}


	public function hnuc($carpeta=null, $nuc=null, $cvv = null, $acuerdo = null)
	{
		if(!empty($carpeta) && !empty($nuc) && !empty($cvv)) {
			$n = ConfigNucModel::first();
			$http = new Client;
			$response = $http->post($n->fge_url_nuc.'/api/hnuc', [
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
		} else {
			return false;
		}
   }

}

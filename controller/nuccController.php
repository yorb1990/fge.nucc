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
	private $baseUrl = '';

	public function __constructor() {
		$response = ConfigNucModel::where('name','FGE-URL-NUC')->first();
		$this->baseUrl = ($response)? $response->clave : '' ;
	}

	public function vclave(){
		$nuc = ConfigNucModel::where('name','clave')->first();
		if($nuc == null) {
			$http = new Client;
			$response = $http->post($this->baseUrl.'/api/regmod', [
				'verify' => false,
				'form_params' => [
					'modulo' => env('APP_NAME'),
					'code' => request('code'),
				],
			]);
			$data = json_decode((string) $response->getBody(), true);

			$nuc = ConfigNucModel::FirstOrNew(['name'=>'clave']);
			$nuc->name  = 'clave';
			$nuc->clave = $data['message'];
			$nuc->save();
		}
	}

   public function gnuc()
   {
	 try{
		 $this->vclave();
		 $nuc = ConfigNucModel::where('name','clave')->first();
		 $http = new Client;
		 $response = $http->post($this->baseUrl.'/api/gnuc', [
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
			$n = ConfigNucModel::where('name','clave')->first();
			$http = new Client;
			$response = $http->post($this->baseUrl.'/api/hnuc', [
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

<?php
namespace fge\nucc\controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use fge\nucc\models\ConfigNucModel;
use fge\nucc\models\NucSycModel;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;


class nuccController extends Controller
{
	private $config;

	public function __construct(){}
		$this->config = ConfigNucModel::first();
	}

	public function regmod(Request $request)
	{
		$request->request->add(['url' => env('FGE_URL_NUC')]);
		$this->validate($request,
			['aplicacion' => 'required|min:3|max:50',
			'url' => 'required'],
			['aplicacion.required' => 'El nombre de la aplicación es requerido.',
			'url.required' => 'No se encontró la ruta de acceso al server (FGE_URL_NUC).'
			]);

			try{
				$http = new Client;
				$response = $http->post($request->input('url').'/api/regmod', [
					'verify' => false,
					'form_params' => [
						'modulo' => $request->input('aplicacion'),
						'code' => request('code'),
					],
				]);

				$data = (object) json_decode((string) $response->getBody(), true);
			} catch (\GuzzleHttp\Exception\ConnectException $e) {
				$message = $e->getMessage();
				return \Response::json(['message' => 'Timed out: Failed to connect',
										 'errors' => ['aplicacion' => ['Fallo la conexión a '.$request->input('url')]]], 506);
			}
		
			try {
				$nuc = ConfigNucModel::firstOrNew(['id' => 1]);		
				$nuc->clave	= $data->message;
				$nuc->fge_url_nuc = $request->input('url');
				$nuc->save();
	
				return response()->json(['message' => 'Correcto.'],200);
			} catch (\Exception $e) {
				return \Response::json(['message' => 'Error interno',
										 'errors' => ['aplicacion' => ['Error interno consulte con el administrador.']]], 500);
			}

	}

	public function getmod(Request $request)
	{
		try {
			$nuc = ConfigNucModel::first();
			$data = ($nuc) ? true : false ;
	
			return response()->json($data, 200);
		} catch (\Exception $e) {
			return response()->json(['message' => 'Error interno consulte al administrador.'], 500);
		}

	}

	public function vclave($clave = null, $urlNuc = null) {
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
		//$this->vclave();
		$nuc = ConfigNucModel::first();
		if (!$nuc) {
			return \Response::json(['message' => 'Internal Server Error.',
			'errors' => ['aplicacion' => ['No se encontraron las variables de configuración.']]], 500);
		}
		try{
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
		} catch (\GuzzleHttp\Exception\ConnectException $e) {
			$message = $e->getMessage();
			return \Response::json(['message' => 'Timed out: Failed to connect',
									'errors' => ['aplicacion' => ['Fallo la conexión a '.$request->input('url')]]], 506);
		}
	}
	
	// $carpeta=null, $nuc=null, $cvv = null, $acuerdo = null
	public function hnuc()
	{
		if(!empty($carpeta) && !empty($nuc) && !empty($cvv)) {
			$item = new NucSycModel::firstOrNew(['carpeta' => $data->carpeta, 'nuc' => $data->nuc, 'cvv']);
			$item->carpeta	= $data->carpeta;
			$item->nuc		= $data->nuc;
			$item->cvv		= $data->cvv;
			$item->acuerdo	= $data->acuerdo;
			$item->save(); 
			
			
			
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

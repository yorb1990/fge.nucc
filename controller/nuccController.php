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

	public function regmod(Request $request)
	{
				/*'modelo' => ['required', function($attribute, $value, $fail){
					try {
						\App\Userr::exists();
					} catch (\Exception $e) {
						return $fail($e);
					}
				}*/
		//$request->request->add(['url' => env('FGE_URL_NUC')]);		

		$this->validate($request,[
				'aplicacion' => 'required|min:3|max:50',
				'url' => 'required|url',
				'modelo' => 'required'
			],[
				'aplicacion.required' => 'El nombre de la aplicación es requerido.',
				'url.required' => 'No se encontró la ruta de acceso al server',
				'url.url' => 'El formato de URL no es válido.',
				'modelo.required' => 'La ruta del Modelo es requerida.',

				
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
				
			} catch (\GuzzleHttp\Exception\RequestException $e) {
				$message = $e->getMessage();
				return \Response::json(['message' => 'Timed out: Failed to connect',
										 'errors' => ['url' => ['Fallo la conexión a '.$request->input('url')]]], 506);
			}
		
			try {
				$nuc = ConfigNucModel::firstOrNew(['id' => 1]);		
				$nuc->clave	= $data->message;
				$nuc->fge_url_nuc = $request->input('url');
				$nuc->modelo = $request->input('modelo');
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
		} catch (\GuzzleHttp\Exception\RequestException $e) {
			$message = $e->getMessage();
			return \Response::json(['message' => 'Timed out: Failed to connect',
									'errors' => ['nuc' => ['Fallo la conexión.']]], 506);
		}
	}
	
	// $carpeta=null, $nuc=null, $cvv = null, $acuerdo = null
	public function hnuc($carpeta=null, $nuc=null, $cvv = null, $acuerdo = null)
	{
		if(!empty($carpeta) && !empty($nuc) && !empty($cvv)) {
			$item = NucSycModel::firstOrNew(['carpeta' => $carpeta, 'nuc' => $nuc, 'cvv' => $cvv]);
			$item->carpeta	= $carpeta;
			$item->nuc		= $nuc;
			$item->cvv		= $cvv;
			//$item->acuerdo	= $acuerdo;
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

	public function bnuc($object = null, $table = null, $data = array())
	{
		if($object){
			$nuc = ($this->gnuc())->getData();
			$edit = $table::find($object->id);
			$edit->nuc = $nuc->nuc;
			$edit->cvv = $nuc->cvv;
			$edit->save();

			$acuerdo = ($data['acuerdo']) ? $edit[$data['acuerdo']] : true ;
			
			$this->hnuc($carpeta = $edit[$data['carpeta']], $nuc = $edit->nuc, $cvv = $edit->cvv, $acuerdo );

			return  \Response::json(['message' => 'Nuc asignado.'],200);
		}
		return  \Response::json(['message' => 'No se pudo generar.'],500);
   }

	public function carpeta(Request $request) {
		$n = ConfigNucModel::first();
		if(!$n){
			return \Response::json(['message' => 'Error interno.',
				'errors' => ['nuc' => ['No se encontraron datos de configuración.']]], 402);
		}
		
		$carpeta = $n->modelo::find($request->input('id_carpeta'));
		if(!$carpeta) {
			return \Response::json(['message' => 'No se encontró carpeta',
				'errors' => ['nuc' => ['No se encontraron datos de la carpeta.']]], 402);
		}

		$message = '';
		if(!$carpeta->nuc) {
			if(($this->gnuc())->getStatusCode() != '200'){
				return $this->gnuc();
			}
			$nuc = ($this->gnuc())->getData();
			$carpeta->nuc = $nuc->nuc;
			$carpeta->cvv = $nuc->cvv;
			$carpeta->save();
			$message = 'El NUC se generó correctamente';
		}

		return \Response::json(['message' => $message,
								'nuc' => $carpeta->nuc ], 200);		
		
	}

	public function conexion()
	{
		try {
			return ConfigNucModel::first();
		} catch (\Throwable $th) {
			return \Response::json(['message' => 'Error interno.',
				'errors' => ['nuc' => ['No se encontraron datos de configuración.']]], 402);
		}
		
	}

}
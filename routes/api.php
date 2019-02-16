<?php
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use fge\nucc\models\ConfigNucModel;
// Route::post('cnucl','nuccController@cnuc');
Route::post('acceso_nuc', function (Request $request) {
	// dd(URL::previous());
	 $http = new Client;
	 $response = $http->post(env('URL_APP_NUC').'/api/login', [
			'verify' => false,
			'form_params' => [
					'email' => $request->input('email'),
					'password' => $request->input('password'),
					'code' => request('code'),
			],
	]);
	$data = json_decode((string) $response->getBody(), true);

	$nuc        = ConfigNucModel::FirstOrNew(['name'=>'token']);
	$nuc->name  = 'token';
	$nuc->clave = $data['success']['token'];
	$nuc->save();
	// $envFile = app()->environmentFilePath();
	// $str = file_get_contents($envFile)."\nTOKEN_NUC=".$data['success']['token'];
	// $fp = fopen($envFile, 'w');
	// fwrite($fp, $str);
	// fclose($fp);
	// dd($data['success']['token']);

	$response = $http->post(env('URL_APP_NUC').'/api/regmod', [
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
	 return redirect('/');
	 // $envFile = app()->environmentFilePath();
	 // $str = file_get_contents($envFile)."\nCLAVE=".$data['message'];
	 // $fp = fopen($envFile, 'w');
	 // fwrite($fp, $str);
	 // fclose($fp);
	 // dd($data['message']);

});

Route::get('gnuc', function (Request $request){
	$nuc = ConfigNucModel::where('name','clave')->first();

	$http = new Client;
	$response = $http->post(env('URL_APP_NUC').'/api/gnuc', [
		 'verify' => false,
		 'form_params' => [
				 'clave' => $nuc->clave,
				 'code' => request('code'),
		 ],
 ]);
	 $data = json_decode((string) $response->getBody(), true);
	 return (object) $data;
});

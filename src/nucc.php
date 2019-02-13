<?php
namespace fge\nucc\src;

class nucc {

    public function validToken(){
        if(env("NUC_TOKEN") == null){
            return false;
        }
        return true;
    
    }
    
    public function validClave(){
        
        if(env("CLAVE") == null){
            return false;
        }
        return true;
    }

    public function login() {
        $response = null;
        try {
            $http = new Client;
            $app = \fge\nucc\models\NucTokenModel()::first();            
            if(! $app) {
                throw new Exception('Esta aplicación no está autorizda para consumir la Api', 401);
            }

            // verify => Comprueba si la aplicación tiene certificado (true).
            $response = $http->request('GET', env('PASSPORT_URL').'/api/user', [
                'verify' => false, 
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$app->access_token,
                ],
            ]);

        } catch (GuzzleException $exception) {

            if($exception->getCode() === 401) {
                // Refrescar token.
                return redirect('/refresh-token');
                return;
            }
        }

        return json_decode((string) $response->getBody(), true);
    }



}
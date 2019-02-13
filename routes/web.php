<?php
use Illuminate\Http\Request;

Route::get('/acceso_nuc', function() {
    return view("fge_tok::form_login");
});

/*Route::get('/regmod1', function () {
    if(env("CLAVE")==null){
        return view("fge_tok::login-nuc");
    }
    return Redirect::to('/');
});
Route::get('regmod2/{name}', function ($name) {
    if(env("CLAVE")==null){
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile)."\nCLAVE=".$name;
        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
    return Redirect::to('/');
});*/
/*Route::get('cnucl', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-cnucl");
});
Route::get('cnucr', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-cnucr");
});
Route::get('hnuc', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-hnuc");
});
Route::get('gnuc', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-gnuc");
});
Route::get('mnuc', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-mnuc");
});*/

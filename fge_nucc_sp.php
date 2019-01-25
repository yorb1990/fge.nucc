<?php
namespace fge\nucc;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
class fge_nucc_sp extends ServiceProvider
{
    private $url="http://192.108.24.131/nuc/public/";
    //private $url="http://localhost:8000/";
    private $envname="URL_FGE-NUC";
    protected $namespace = 'fge\nucc\controller';
    public function map()
    {
        Route::prefix('fge-tok')
             ->namespace($this->namespace)
             ->group(__DIR__.'/routes/api.php');
        Route::prefix('fge_tok')
             ->namespace($this->namespace)
             ->group(__DIR__.'/routes/web.php');
    }
    public function boot()
    {
        if(env($this->envname)==null){
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile)."\n".$this->envname."=".$this->url;
            $fp = fopen($envFile, 'w');
            fwrite($fp, $str);
            fclose($fp);
        }
        $this->loadViewsFrom(__DIR__.'/views', 'fge_tok');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        parent::boot();
    }
}
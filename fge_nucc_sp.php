<?php
namespace fge\nucc;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use fge\nucc\models\ConfigNucModel;
class fge_nucc_sp extends ServiceProvider
{
    private $url = "http://192.108.24.131/fge.nuc.server/public/";
    private $envname = "FGE-URL-NUC";
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
        $this->loadViewsFrom(__DIR__.'/views', 'fge_tok');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/public/css' => base_path('public/css'),
            __DIR__.'/public/js' => base_path('public/js'),
        ], 'nucg-components');

        parent::boot();
    }

}

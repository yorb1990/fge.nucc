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
        // Para ejecutar las semillas es con el comando php artisan db:seed
        if ($this->app->runningInConsole()) {
            $this->registerSeedsFrom(__DIR__.'/database/seed');
        }
        parent::boot();
    }

    protected function registerSeedsFrom($path)
    {
        foreach (glob("$path/*.php") as $filename)
        {
            include $filename;
            $classes = get_declared_classes();
            $class = end($classes);
            $command = \Request::server('argv', null);

            if (is_array($command)) {
                $command = implode(' ', $command);
                if ($command == "artisan db:seed") {
                    \Artisan::call('db:seed', ['--class' => $class]);
                }
            }
        }
    }
}
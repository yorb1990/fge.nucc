# Registro y verificador de NUC
## instalacion
```
composer require fge/nucc
```
registra en `config/app.php`
```
'providers'=>[
  fge\nucc\fge_nucc_sp::class
]
```
Correr migraciones donde se genera una tabla que almacenará `token de acceso` y `clave del módulo`.

## registrate
(en tu archivo `.env` aparecerá la variable `FGE-URL-NUC` que contiene la url del motor del NUC)
<img src="https://i.imgur.com/0z8TCSP.jpg"/>

en tu archivo `.env` configurar la variable `APP_URL` con el nombre de tu proyecto

Agregar a tu clase
```
use fge\nucc\controller\nuccController;
```

Agregar en tu método constructor, para validar que tienes tokens de acceso.
```
(new NuccController)->vclave();
```
Método para solicitar NUC
```
$nuc = (new NuccController)->gnuc();
```

Nota: Al solicitar NUC si no cuenta con token y clave es redireccionado a una vista login para generarlos.

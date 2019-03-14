# Registro y verificación de NUC
## Instalación

Instalar el paquete
```
composer require fge/nucc
```
Agregar en la tabla donde se vaya a guardar el NUC los siguientes datos:
```
$table->string('nuc', 14)->nullable();
$table->string('cvv', 4)->nullable();

```
Ejecutar el comando  `php artisan migrate:fresh`
Ejecutar el siguiente comando `php artisan vendor:publish --tag=nucg-components` para instalar el componente de nucg


## Registro
Agregar en el archivo `.env` la variable `FGE_URL_NUC` que contiene la url del motor del NUC. Ejemplo:
`FGE_URL_NUC=http://sistemas.fiscaliaveracruz.gob.mx/fge.nuc.server/public`

Añadir en el html que mande a llamar el NUC el siguiente script
```
<script src="{{asset('js/nucg.js') }}"></script>
```
Solicitar el componente en el formulario
```
<div id="app_nuc">
    <nucg-component baseurl="{{url('')}}"> </nucg-component>
</div>
```


Nota: Al solicitar NUC por primera vez se le solicitará el nombre del módulo para que se generé la clave del módulo.

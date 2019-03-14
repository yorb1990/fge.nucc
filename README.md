# Registro y verificación de NUC
## Instalación

Instalar el paquete

```
composer require fge/nucc
```

Ejecutar el comando  `php artisan migrate`

Ejecutar el siguiente comando `php artisan vendor:publish --tag=nucg-components` para instalar el componente de nucg

## Registro

Agregar en el archivo `.env` la variable `FGE_URL_NUC` que contiene la url del motor del NUC.


Añadir en el html el siguiente script

```
<script src="{{asset('js/nucg.js') }}"></script>

```

Solicitar el componente en el formulario

```
<div id="app">

    <nucg-component baseurl="{{url('')}}"> </nucg-component>

</div>

```



Nota: Al solicitar NUC por primera vez se le solicitará el nombre del módulo para que se generé la clave del módulo.

commit: Actualizando el componente mostrando error de conexión

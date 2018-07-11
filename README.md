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
## registrate
(en tu archivo `.env` aparecera la variable `FGE-URL-NUC` que contiene la url del motor del NUC)
<img src="https://i.imgur.com/0z8TCSP.jpg"/>
en tu navegador ingresa a `/fge_tok/regmod1` y registrate 
<img src="https://i.imgur.com/Sq8Uh6P.gif"/>
al registrarse te aparecera tu clave unica y te direccionara a la pagina de inicio `/`
(la clave se encuentra en el `.env` y funcionara para la generacion de tokens nuc y jwt)
<img src="https://i.imgur.com/QYsyqfx.jpg"/>

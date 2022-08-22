<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Instalacion

Para la instalacion del proyecto ejecutar los siguientes comandos:

- Clonar repositorio
- Dentro de la ruta ejecutar:
    - composer install
    - composer update
    - php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
    
- Luego ejecutar dentro de la carpeta raiz:
    - php artisan serve
    
Esto levantara el servidor local del proyecto. 
En caso que utilices laragon solo deberas reiniciar 
el servidor laragon y acceder al virtualhost que este crea. 


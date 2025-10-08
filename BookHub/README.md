<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Logo"></p>

# BookHub

Aplicación web desarrollada con Laravel para gestionar un catálogo de **libros manga** y publicar **noticias**, con panel de administración protegido.

## Características

- Gestión de noticias (crear, editar, eliminar) con feedback de estado.
- Gestión de libros (listar, crear, editar, eliminar).
- Panel de administración accesible sólo para usuarios con rol de administrador.
- Interfaz en español y estructura semántica en las vistas principales.

## Requisitos

- PHP 8.x
- Composer
- Base de datos (MySQL/MariaDB, SQL Server, etc.)

## Configuración

1. Copiá `.env.example` a `.env` y ajustá las credenciales.
2. Instalá dependencias: `composer install`.
3. Generá la clave: `php artisan key:generate`.
4. Ejecutá migraciones y seed si corresponde: `php artisan migrate --seed`.
5. Iniciá el servidor: `php artisan serve`.

## Rutas principales

- `/` Página de inicio (MangaHub).
- `/admin` Panel de administración (requiere autenticación y rol admin).
- `/noticias` Listado de noticias.
- `/libros` Listado de libros.

## Autenticación

El proyecto incluye vistas y controladores de autenticación. Los mensajes del sistema están localizados en español.

## Licencia

Software de código abierto bajo licencia [MIT](https://opensource.org/licenses/MIT).

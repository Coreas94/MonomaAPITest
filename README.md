<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Test Project
Este proyecto es una API de Gestión de Usuarios construida con Laravel 10 y MySQL. Proporciona endpoints para gestionar usuarios (leads), incluyendo la creación, recuperación y listado de leads.

## Tabla de Contenidos

- [Instalación](#instalación)
- [Configuración](#configuración)
- [Ejecutar Pruebas](#ejecutar-pruebas)
- [Ejecutar la Aplicación](#ejecutar-la-aplicación)

## Instalación

Para comenzar con la API de Gestión de Contactos, sigue estos pasos:

1. Clona el repositorio:

    ```bash
    git clone https://github.com/Coreas94/MonomaAPITest.git
    cd MonomaAPITest
    ```

2. Instala las dependencias:

    ```bash
    composer install
    ```

3. Copia el archivo `.env.example` a `.env`:

    ```bash
    cp .env.example .env
    ```

4. Genera una clave de aplicación:

    ```bash
    php artisan key:generate
    ```

5. Configura los ajustes de tu base de datos en el archivo `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=monomaapi
    DB_USERNAME=tu_usuario_de_base_de_datos
    DB_PASSWORD=tu_contraseña_de_base_de_datos
    ```

6. Ejecuta las migraciones y los seeders de la base de datos:

    ```bash
    php artisan migrate --seed
    ```

## Configuración

Asegúrate de configurar los siguientes ajustes en tu archivo `.env`:

- **Base de Datos**: Configura los ajustes de conexión a tu base de datos.
- **Autenticación JWT**: Asegúrate de haber configurado la clave secreta de JWT ejecutando `php artisan jwt:secret`.

## Ejecutar pruebas

Para ejecutar los tests, usa el siguiente comando:

```bash
php artisan test
```

## Ejecutar la Aplicación

Para ejecutar la aplicación, usa el siguiente comando:

```bash
php artisan serve
```



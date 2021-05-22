<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Aplicacion Convertidor Texto a Audio

Por: Yoser Perez

El conversor de texto a voz está transformando el texto en voz humana artificial. Convierta el texto en el habla del idioma correspondiente. 

## Requisitos
------------
 - PHP >= 7.4.x
 - Laravel >= 8.x
 - MySQL 5.4+, MariaDB, PostgreSQL 9.6+

## Instalación

* Este paquete requiere PHP 7+ y Laravel 8.x.
* Primero, instale laravel 8.xy asegúrese de que la configuración de conexión de la base de datos sea correcta.
* Clona este repositorio.
* Ejecute composer install desde la raíz del proyecto.
* Ejecute php artisan desde la raíz del proyecto.

- **Cree una cuenta en VoiceRSS y obtenga su clave API de VoiceRSS**		
	
	[Crea una cuenta en VoiceRSS.](http://www.voicerss.org).<br />
	[Iniciar sesión en VoiceRSS.](http://www.voicerss.org/login.aspx)<br />
	[Obtenga su clave API](http://www.voicerss.org/personel/)

- **Archivo de entorno Configure su clave de API (.env)**
		
	VOICE_RSS_API_KEY=pi_key

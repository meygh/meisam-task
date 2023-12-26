<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Simple Flight API Project

This web api project produce some simple methods to  manage users' flights history.

List of functionalities and methods:

- Add flights as 2d array related to users.
- Retrieve list of the first departure and the last destination that user had ever.

### Notice:
- This api platform supports versioning
  - v1
  - latest
- No endpoint has developed at this time to manage users, however, users will be stored in the database if is a new one depends on Passport ID in order to further operations.

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## Technologies and Tools

- **[Nginx](https://nginx.com)**
- **[PHP 8.1](https://php.net)**
- **[Laravel](https://laravel.com)**
- **[MySQL (MariaDb)](https://mariadb.org)**
- **[phpMyAdmin](https://phpmyadmin.net)**
- **[Docker & Docker Compose](https://docker.com)**

## Instruction to launch the project

To start the project you can follow the **Makefile** in the root directory.

### Simple steps to start and stop the project

**UP**
```shell
docker-compose up -d
```

**DOWN**
```shell
docker-compose down
```

**Prepare the project to run**
```shell
docker-compose exec php composer require
```

# HTTP Routes

- **[API Root](http://localhost/api)**
- **[phpMyAdmin](http://127.0.0.1:8081)**

## API endpoints

- **Add Flights**
  - http://localhost/api/v1/add-flights

- **Get Flights History**
  - http://localhost/api/v1/add-flights

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

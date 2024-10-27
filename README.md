## Requerimientos

- PHP >= 8.1
- Composer
- Docker (en caso de utilizar Laravel Sail)
- MySQL 8 (en caso de no utilizar Laravel Sail)

## Instalación

### Con Laravel Sail (requiere Docker)

1. Clonar el repositorio
```bash
git clone https://github.com/marcosmendez627/adoclic-laravel.git
```
2. Acceder al directorio del proyecto
3. Instalar las dependencias
```bash
composer install
```
4. Copiar el archivo `.env.example` con el nombre `.env`
```bash
cp .env.example .env
```
5. Configurar las siguientes variables de entorno para la conexión a la base de datos en el archivo `.env`
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```
6. Levantar los contenedores de Docker
```bash
./vendor/bin/sail up -d
```
7. Generar la llave de la aplicación
```bash
./vendor/bin/sail artisan key:generate
```
8. Ejectuar las migraciones
```bash
./vendor/bin/sail artisan migrate
```
9. Ejectuar los seeders para poblar las tablas `categories` y `entities` de la base de datos
```bash
./vendor/bin/sail artisan db:seed
```

#### Tests
Para ejecutar los tests, se debe ejecutar el siguiente comando:
```bash
./vendor/bin/sail artisan test
```

### Sin Laravel Sail
1. Clonar el repositorio
```bash
git clone https://github.com/marcosmendez627/adoclic-laravel.git
```
2. Acceder al directorio del proyecto
3. Instalar las dependencias
```bash
composer install
```
4. Copiar el archivo `.env.example` con el nombre `.env`
```bash
cp .env.example .env
```
5. Generar la llave de la aplicación
```bash
php artisan key:generate
```
6. Crear una base de datos MySQL vacía y configurar las variables de entorno para la conexión a la misma en el archivo `.env`: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD`
7. Ejectuar las migraciones
```bash
php artisan migrate
```
8. Ejectuar los seeders para poblar las tablas `categories` y `entities` de la base de datos
```bash
php artisan db:seed
```

#### Tests
Para ejecutar los tests, se debe ejecutar el siguiente comando:
```bash
php artisan test
```

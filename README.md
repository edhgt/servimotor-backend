# Servimotor Backend

## Guía de instalación desde cero paso a paso
```bash
# copiar archivo de variables de entorno
cp .env.example .env

# instalar dependencias
composer i

# instalar llave privada
php artisan key:generate

# instalar link simbólico para acceder a archivos del local storage
php artisan storage:link

# ejecutar migraciones y seeders
php artisan migrate --seed

# si se desaea reinstalar la base de datos
php artisan migrate:fresh --seed
```

## Instalación desde cero de forma automática e interactiva
Para ejecutar de forma automática e interactiva ejecute y siga las instrucciones del siguiente comando

```bash
./install.sh
```

## Comandos post-instalación en entorno de producción
```bash
composer install --optimize-autoloader --no-dev
php artisan optimize
```
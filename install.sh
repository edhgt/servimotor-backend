#!/bin/sh

# Verificar si Composer está instalado
if ! command -v composer &> /dev/null
then
    echo "Composer no está instalado. Por favor instalelo primero."
    exit 1
fi

# Verificar si PHP está instalado
if ! command -v php &> /dev/null
then
    echo "PHP no está instalado. Por favor instalelo primero."
    exit 1
fi

# Verificar si el archivo .env ya existe
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Archivo .env copiado exitosamente."
else
    echo "El archivo .env ya existe, no es necesario copiarlo."
fi

# Instalar dependencias de Composer
composer install

# Generar la clave de la aplicación Laravel
php artisan key:generate

# Crear enlace simbólico para almacenamiento
php artisan storage:link

# Instrucción para configurar las variables de entorno
echo "Ahora configure las variables de entorno (DB_*) de su base de datos en el archivo .env."
echo "Cuando haya terminado, guarde los cambios y escriba 'continuar' para continuar con la instalación."

# Leer la entrada del usuario antes de continuar
read -p "Escriba 'continuar' para proceder con las migraciones y el seed: " user_input

# Verificar si el usuario escribió 'continuar'
if [[ "$user_input" != "continuar" ]]; then
    echo "Proceso cancelado."
    exit 1
fi

# Ejecutar las migraciones y sembrar la base de datos
php artisan migrate --seed

echo "Instalación y configuración completadas con éxito."

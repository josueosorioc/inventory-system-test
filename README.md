# Sistema de inventario

Sistema básico de gestión de artículos con crud de artículos y registro e inicio de sesión


## Requerimientos

- PHP => 8.2 - 8.3

## Inicializar proyecto

- Una vez clonado el proyecto correr el comando `composer install` dentro del proyecto
- Generar/Crear archivo '.env'  en la raiz del proyecto, se puede copiar los datos de .env.example
- Hecho lo anterior y finalizado el proceso de instalación de las paqueterías correr el comando `php artisan key:generate`
- Finalizado los pasos anteriores correr el comando `php artisan migrate --seed` para generar datos para tests, este genera un usuario por defecto con las siguientes credenciales "josue.osorio@example.com" y como contraseña "abc.123"

## Testing

Se han generado los métodos para validar el funcionamiento del sistema, el cual valida lo siguiente:
- Inicio de sesión
- Registro de usuario
- Registro de artículo
- Edición de artículo
- Eliminación de artículo

Estos se pueden validar corriendo el siguiente comando `php artisan test`,  en caso de ser necesario se puede realizar un "reseteo" de la BD con el siguiente comando `php artisan migrate:fresh --seed`

# API CRUD de Productos

## Requisitos

API CRUD de Productos
Requisitos

Primero validar de tener estos requisitos instalados:

- PHP 8.0 o superior
- Composer
- MySQL
- Laravel 10.x
- PHPUnit (para las pruebas unitarias)

Instalación

Sigue los siguientes pasos para instalar el proyecto en tu máquina local:

1. clonar el repositorio: https://github.com/angelmello10/crud-api.git


2. **Instalar dependencias de PHP:
   
   cd tu-repositorio
   composer install
   

3. Configurar el archivo `.env`:
   Copia el archivo `.env.example` y renómbralo a env: 
   cp .env.example .env
   
   Luego, configura las variables de entorno, especialmente la conexión a la base de datos:

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_de_base_de_datos
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   `

4. Generar la clave de aplicación:

   php artisan key:generate
   
5. Migrar las tablas de la base de datos:
   Si aún no has creado las tablas, ejecuta las migraciones:

   php artisan migrate

6. Instalar dependencias de Node.js (si usas frontend):
   Si tienes un frontend, ejecuta:
   
   npm install
   npm run dev
   

Cómo probar la API
1. Pruebas unitarias:

Para ejecutar las pruebas unitarias de la API, ejecuta el siguiente comando:


php artisan test


2. Pruebas con Postman:

-Registrarse:
  Para registrarse, envía una solicitud `POST` a `/api/register` con los siguientes parámetros:
  json
  {
    "name": "Nombre del usuario",
    "email": "email@dominio.com",
    "password": "contraseña",
    "password_confirmation": "contraseña"
  }
  

- Iniciar sesión:
  Para iniciar sesión, envía una solicitud `POST` a `/api/login` con los siguientes parámetros:
  `json
  {
    "email": "email@dominio.com",
    "password": "contraseña"
  }
  

- Obtener un token:
  Después de iniciar sesión, recibirás un token de acceso que debes incluir en las solicitudes subsiguientes.

Endpoints disponibles
Usuarios

-POST /api/register
  Registra un nuevo usuario.

- POST /api/login
  Inicia sesión y obtiene un token de acceso.

- POST /api/logout
  Cierra sesión y revoca el token de acceso.  
  (Requiere autenticación)

- GET /api/user  
  Obtiene los datos del usuario autenticado.  
  (Requiere autenticación)

Productos

- GET /api/productos
  Obtiene todos los productos registrados.

- POST /api/productos
  Crea un nuevo producto.  
  (Requiere autenticación)

- GET /api/productos/{id}
  Obtiene los detalles de un producto específico.

- PUT /api/productos/{id}
  Actualiza los detalles de un producto.  
  (Requiere autenticación)

- DELETE /api/productos/{id}
  Elimina un producto.  
  (Requiere autenticación)

Categorías

- GET /api/categorias
  Obtiene todas las categorías.

- POST /api/categorias
  Crea una nueva categoría.  
  (Requiere autenticación)

- DELETE /api/categorias/{id}
  Elimina una categoría.  
  (Requiere autenticación)

Notas adicionales

- El proyecto usa Laravel Sanctumpara la autenticación de API.




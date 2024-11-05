## **README.md**

### **Introducción**

Este proyecto proporciona una API RESTful para gestionar clientes, implementando funcionalidades de registro, consulta, eliminación y autenticación.

### **Requisitos Previos**

* **Servidor web:** Apache.
* **PHP:** php 8.3 Versión compatible con Laravel 11
* **Composer:** Gestor de dependencias de PHP.
* **Base de datos:** MySQL (o compatible)
* **Node.js y npm:**  Para herramientas de desarrollo frontend.

### **Instalación**

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/vojdel/Prueba-GDA-Jose-Daniel-Vasquez-Pineda.git
   ```
2. **Instalar dependencias:**
   ```bash
   cd Prueba-GDA-Jose-Daniel-Vasquez-Pineda
   composer install
   npm install && npm run build
   ```
3. **Configurar la base de datos:**
* Copiar el archivo `.env.example` a `.env` y ajustar las credenciales de la base de datos.
* Ejecutar las migraciones:
     ```bash
     php artisan migrate
     ```
4. **Generar la clave secreta:**
   ```bash
   php artisan key:generate
   ```

### **Configuración**

* **Autenticación:**
  * El sistema utiliza tokens para autenticar las solicitudes.
  * El token se genera al iniciar sesión y debe incluirse en el encabezado `Authorization` de cada solicitud en el formato `Bearer token`.

### **Uso**

#### **Endpoints**

* **Registro de un cliente:**
  * Método: POST
  * URL: /api/customers
  * Cuerpo: JSON con los datos del cliente (nombre, apellido, email, etc.)
* **Consulta de un cliente:**
  * Método: GET
  * URL: /api/customers/{id}
* **Eliminación de un cliente:**
  * Método: DELETE
  * URL: /api/customers/{id}
* **Autenticación:**
  * Método: POST
  * URL: /api/login
  * Cuerpo: JSON con las credenciales (email, password)


### **Logs**

* Los logs se almacenan en storage/logs/infologs.log
* Estan los logs de entrada y salida, para desactivar los de entrada es cambiar el valor de la variable APP_ENV de true a false

### **Documentación en Swagger**

* La documentación de la API con sus respectivos endpoints esta en http://localhost:8000/api/documentation
* Despues de cada cambio usar el comando de:

```
$ php artisan l5-swagger:generate
```

**Herramientas para generar documentación:**

* **Swagger UI:** Genera una interfaz interactiva para explorar la API.



### Endpoints del Proyecto

GET /api/customers
Obtiene todos los clientes

Respuesta
```
[
    {
        "id": 1,
        "name": "Juan Pérez",
        "email": "juan@example.com",
        "phone": "1234567890"
    },
    {
        "id": 2,
        "name": "María García",
        "email": "maria@example.com",
        "phone": "9876543210"
    }
]
```
GET /api/customers/{id}
Obtiene un cliente por ID

* Parámetros
```
| Nombre | Tipo    | Descripción    |
| ------ | ------- | -------------- |
| id     | integer | ID del cliente |
```

Respuesta
```
{
    "id": 1,
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "phone": "1234567890"
}
```
POST /api/customers
Crea un nuevo cliente

Parámetros
```
| Nombre | Tipo | Descripción | | --- | --- | --- | | name | string | Nombre del cliente | | email | string | Correo electrónico del cliente | | phone | string | Teléfono del cliente |
```
Respuesta
```
{
    "id": 3,
    "name": "Pedro López",
    "email": "pedro@example.com",
    "phone": "5555555555"
}
```
PUT /api/customers/{id}
Actualiza un cliente

Parámetros
```
| Nombre | Tipo | Descripción | | --- | --- | --- | | id | integer | ID del cliente | | name | string | Nombre del cliente | | email | string | Correo electrónico del cliente | | phone | string | Teléfono del cliente |
```
Respuesta
```
{
    "id": 1,
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "phone": "1234567890"
}
```
DELETE /api/customers/{id}
Elimina un cliente

Parámetros
```
| Nombre | Tipo | Descripción | | --- | --- | --- | | id | integer | ID del cliente |
```

Respuesta
```
{
    "message": "Cliente eliminado con éxito"
}
```
#### POST /api/register
Registra un nuevo usuario

Parámetros
```
| Nombre | Tipo | Descripción | | --- | --- | --- | | name | string | Nombre del usuario | | email | string | Correo electrónico del usuario | | password | string | Contraseña del usuario |
```

Respuesta
```
json
CopyInsert
{
    "id": 1,
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```
LoginController
POST /api/login
Inicia sesión un usuario

Parámetros
```
| Nombre | Tipo   | Descripción                    |
| ------ | ------ | ------------------------------ |
| email  | string | Correo electrónico del usuario |  | password | string | Contraseña del usuario |
```

Respuesta
```
{
    "id": 1,
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```
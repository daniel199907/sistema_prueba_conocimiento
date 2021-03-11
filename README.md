# sistema_prueba_conocimiento
Nombre del sistema: 

Inventario

Descripción: 

Sistema de 3 roles [ADMIN, GESTOR, CAPTURISTA] con 4 módulos que le permitirán al usuario iniciar sesión, registrar productos, listar productos, editar productos, eliminar productos y ver reportes en formato CVS de todos los productos registrados en la base de datos, así como la posibilidad de ver un reporte CVS dado un rango de fechas.

Para poder ejecutar el programa se requiere tener instalado:

     1.- PHP v8.0.2
     2.- MySQL v8.0.23
     3.- Composer v2.0.11
     4.- Symfony v5.2
     5.- Ejecutar el comando : 'composer install'
        -- Este comando ejecutará la instrucción de descargar todas las dependencias necesarias     para el correcto funcionamiento del proyecto.
     6.- Ejecutar el comando : 'symfony server:start'
        -- Este comando ejecutará el servidor de la aplicación, el comando únicamente funcionará si se tiene instalado Symfony en la versión requerida. En caso de que el proyecto se corra con otro servicio como "Xampp" se verá afectada la ruta para eliminar el producto de manera asíncrona. 

La base de datos se encuentra en la carpeta BASEDATOS a la misma altura que el proyecto inventario, esta carpeta contiene:
     1.- Script de la base de datos.
     2.- Modelo relacional de la base de datos.

El catálogo de la base de datos está lleno, existen 3 usuarios con roles distintos:
1.- Usuario: danielherro, contraseña: daniel199907, Perfil: Capturista
2.- Usuario: esme99, contraseña: 1234567891, Perfil: Gestor
3.- Usuario: guillermocas, contraseña: 1234567891, Perfil: Administrador

Nombre del desarrollador:
.- Daniel Rodriguez Herrera

Correo electrónico:
.- daniel199907@gmail.com

Teléfono:
.- 7775037364
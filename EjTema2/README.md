# Agenda Web en PHP y MySQL

Este es un proyecto simple de una agenda web desarrollada en **PHP y MySQL**. Permite añadir, actualizar, eliminar y vaciar contactos.

## Requisitos

- Servidor web Apache (recomendado: **WAMP**, **XAMPP** o **LAMP**).
- **MySQL**.
- Navegador web.

## Instalación

1. **Clona el repositorio o descarga los archivos**:

    ```bash
    git clone https://github.com/adamzgz/DAW_Campus_Digital.git
    cd DAW_Campus_Digital
    git checkout entorno_servidor
    ```

2. **Crea la base de datos**:

    Ejecuta el siguiente script SQL desde phpMyAdmin o cualquier cliente MySQL para crear la base de datos y la tabla de contactos:

    ```sql
    CREATE DATABASE agenda;

    USE agenda;

    CREATE TABLE contactos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL UNIQUE,
        telefono VARCHAR(20)
    );
    ```

3. **Configura la conexión a la base de datos**:

    Edita el archivo `conexion.php` y ajusta los datos de conexión a tu servidor MySQL:

    ```php
    $host = 'localhost';
    $usuario = 'root'; // Cambia esto si es necesario
    $contraseña = '';  // Cambia esto si es necesario
    $baseDeDatos = 'agenda';
    ```

4. **Inicia el servidor**:

    - Coloca la carpeta `EjTema2` en el directorio de tu servidor local (`htdocs` para XAMPP o `www` para WAMP).
    - Inicia **Apache** y **MySQL** desde tu entorno AMP.

5. **Accede al proyecto desde tu navegador web**:

    ```bash
    http://localhost/DAW_Campus_Digital/EjTema2/
    ```

## Funcionalidades

- **Añadir Contactos**:
  - Introduce un nombre y un teléfono. Si el contacto ya existe, se actualizará el teléfono.

- **Actualizar Contactos**:
  - Modifica el número de un contacto existente introduciendo su nombre y el nuevo número.

- **Eliminar Contactos**:
  - Introduce un nombre existente y deja el campo de teléfono vacío. El contacto será eliminado.

- **Vaciar Agenda**:
  - Haz clic en el botón "Vaciar Agenda" para eliminar todos los contactos de la base de datos.

- **Listar Contactos**:
  - Visualiza todos los contactos actuales organizados en una tabla con nombre y teléfono.

## Estructura del Proyecto

```plaintext
EjTema2/
├── conexion.php         // Configuración de la conexión a MySQL.
├── database.sql         // Script SQL para crear la base de datos.
├── estilos.css          // Estilos de la interfaz.
├── funciones.php        // Lógica para manejar la agenda.
├── index.php            // Archivo principal de la agenda.
└── README.md            // Documentación del proyecto.

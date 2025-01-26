"Sistema de autenticación básica en PHP."

Enunciado: Desarrolla un sistema de autenticación en PHP Nativo que permita a los usuarios registrarse y acceder al sistema. Implementa las siguientes funcionalidades:

Registro de usuario:

Un formulario HTML para capturar el nombre de usuario, correo electrónico y contraseña.
Validación del correo electrónico para asegurarte de que tiene un formato válido.
Las contraseñas deben almacenarse encriptadas (usa password_hash() de PHP).
Inicio de sesión:

Un formulario de login que permita a los usuarios ingresar con su correo electrónico y contraseña.
Valida las credenciales comparándolas con los datos almacenados.
Sesión de usuario:

Crea una sesión para mantener al usuario autenticado una vez que haya iniciado sesión.
Muestra un mensaje de bienvenida en una página protegida (solo accesible si el usuario está autenticado).
Cerrar sesión:

Implementa una opción para que el usuario cierre sesión y destruya la sesión activa.
# README #

This README would normally document whatever steps are necessary to get your application up and running.

# QUILLQUEST

Proyecto para DAW. App QuillQuest: Historias interactivas

# .htaccess

Cambiar Access-Control-Allow-Origin

# Configurar entorno

1. En config.php cambiar las siguientes variables según dónde se ejecute el proyecto

_ENVIRONMENT
_URL_ENVIRONMENT
_URL_LOGS
_URL_MAIL
_KEY_CAPTCHA

Para entorno de producción habilitar 'production', para desarrollo 'develop' y para local, poner 'localhost' o cualquier que se necesite.


2. En js/config.js necesitas poner las siguientes urls

rutaAjax
principalUrl
urlLogin

NOTA: Si se modifican estos ficheros en local, no subir al repositorio, quitarlos de los commits.

3. Crear las carpetas dataDB, dataLogs y tests si no están creadas al mismo nivel que el proyecto.

4. Crear la carpeta TmpSmarty dentro del proyecto QuillQuest si no está creada.

# Configurar base de datos

En primer lugar se necesita crear la base de datos e importar las tablas. Hay que crear también un usuario con privilegios.

En el directorio dataDB hay que guardar los datos de acceso a la base de datos( user, database, password y server) en formato json y después cifrado base64.
- Si tienes un entorno de producción los datos se tienen que guardar en el fichero db_prod.config.
- Si tienes un entorno local, se guardan en db_local.config.

Ejemplo json:
{
  "server": "name_server",
  "user": "name_user",
  "password": "password_user",
  "name": "name_db"
}

Después tienes que codificar el json en base64 y ponerlo en el fichero.

# Captcha key secret
Si se utiliza la función de captcha de google aquí se almacena la key secret sin condificar. Cambiar por la que corresponda.

# Configurar servidor de correo

Se necesita configurar el servidor de correo con los datos propios. La clase se encuentra en config/lmMailer.php

# Logs

Necesitas crear el directorio dataLogs en la raíz, mismo nivel que dataDB. También hay que crear los subdirectorios que se necesiten.
dataLogs/

- panel
- web
- mails

# Composer

Ejecutar composer para que se instalen todas las librerías.
Eliminar la carpeta de phpunits en producción -> muy importante


# Privilegios

En el caso de linux

# chown apache:apache -R "directory"
# chcon -t httpd_sys_content_t "directory" -R
# chcon -t httpd_sys_rw_content_t "directory" -R

Se necesitan dar privilegios a estos directorios:

- dataLogs/
- QuillQuest/TmpSmarty
- QuillQuest/images/
- tests/




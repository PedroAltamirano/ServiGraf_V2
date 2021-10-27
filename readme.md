# ERP

Sistema ERP construido en laravel.

## Acknowledgements

 - [Instalación](#montar-ambiente)
 - [Lógica](#documentacion)
 - [Edición](#roadmap)

Montar ambiente
===============

## Requisitos

- php7.4^ + composer
- node12^ + npm
- postgresql12 + php-pgsql o mysql8
- laravel requirements https://laravel.com/docs/7.x/
- nginx + php-fpm

## Install dependencies

```
$ composer install
$ npm install
$ npm run dev
```

Documentacion
=============

En esta seccion se encuentran las acciones que se pueden realizar dentro del sistema.

## Landing
- Paginas estaticas con informacion y galeria de la empresa
- Página de contacto

## Desktop
- Revision de resumen empresarial (BI y KPIs) para el admin
- Revision de pedidos, clientes por usuario

## Usuario
- Registro
- Login
- Estatus activo o inactivo
- Gestion de perfil

## Perfiles
- Gestion de perfiles
- Gestion de modulos y acciones por perfil

## Facturacion
- Creacion de facturas
- Gestion de caja chica (ingresos / egresos)

## RRHH
- Gestion de nomino (IESS Ecuador)
- Gestion de asistencia

## Produccion
- Gestion de pedidos
- Creacion de pedidos
- Reportes: pedidos, pagos, procesos
- Gestion de procesos
- Gestion de materiales

## CRM
- Gestion de contactos / clientes
- Gestion de tareas
- Creacion de tareas por contacto

## Sistema
- Gestion del sistema
- Gestion de facturacion
- Gestion de claves encriptadas

### Notificaciones
- Notificaciones en DDBB
- Se envia una notificacion a un usuario

Roadmap
=======

El proyecto sigue la arquitectura mvc de laravel.
La arquitectura del proyecto es modular, cada feature tiene una subcarpeta dentro de la estructura mvc de laravel.
Ejm. Organizaciones
```
app > Http > controllers > modulo > controller
app > Http > requests > modulo > controller
app > models > modulo > model
resources > views > modulo > view
```

El proyecto usa scss y postcss, para editar el css se debe cambiar los archivos de:
```
css propietario
resources > sass > styles.scss

sbadmin4 theme + general
resources > sass > app.scss

landing page theme
resources > sass > landing.scss
```

El proyecto genera los archivos js, ademas usa jq, para editar el js en:
```
general
resources > js > app.js

plugins init
resources > js > helpers.js

landing
resources > js > landing.js
```

Para mas informacion de css y js revisar:
```
webpack.mix.js
```

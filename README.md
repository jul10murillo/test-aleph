# 📌 Proyecto: Prueba Técnica Yafo Consultora

Este es un proyecto desarrollado en **Laravel 11** utilizando **Laravel Sail** para gestionar el entorno de desarrollo con **Docker**.

## 📁 Estructura del Proyecto

El proyecto está compuesto por las siguientes partes:

### **Backend** (Laravel 11)
- Implementación de API RESTful.
- Autenticación con Sanctum.
- Gestión de usuarios y roles.
- Base de datos MySQL con migraciones y seeders.
- Caché con Redis.

### **Frontend** (Vue.js o Blade Templates)
- Interfaz de usuario para la gestión de datos.
- Consumo de la API REST.
- Formularios con validaciones.

### **Base de Datos** (MySQL)
- Migraciones y modelos para estructurar la información.
- Relaciones entre usuarios, roles y permisos.
- Tablas optimizadas para consultas rápidas.

### **Servicios Adicionales**
- Manejo de colas de trabajo con Redis y Laravel Queues.
- Sistema de logs y monitoreo.

## 🚀 Requisitos

Antes de comenzar, asegúrate de tener instalado:
- **Docker** (https://www.docker.com/get-started)
- **Git** (https://git-scm.com/downloads)

## 📥 Clonar el Proyecto
Para obtener una copia local del proyecto, ejecuta:
```bash
git clone https://github.com/tu_usuario/tu_repositorio.git
cd tu_repositorio
```

## ⚙️ Configuración Inicial

1️⃣ **Copiar el archivo de entorno**:
```bash
cp .env.example .env
```

2️⃣ **Levantar los contenedores de Docker**:
```bash
./vendor/bin/sail up -d
```
📌 Esto iniciará los servicios como **MySQL, Redis y Laravel**.

3️⃣ **Generar la clave de la aplicación**:
```bash
./vendor/bin/sail artisan key:generate
```

4️⃣ **Ejecutar migraciones y sembrar datos si es necesario**:
```bash
./vendor/bin/sail artisan migrate --seed
```

## 🔧 Solución de Problemas y Configuración Adicional

Durante la configuración del proyecto, enfrentamos algunos problemas relacionados con la conexión a MySQL y Redis. A continuación, se detallan las soluciones aplicadas:

- **Error de conexión a MySQL (`php_network_getaddresses`):**
  - Se corrigió cambiando `DB_HOST=mysql` en el archivo `.env`.
  - Se reiniciaron los contenedores con `./vendor/bin/sail down && ./vendor/bin/sail up -d`.

- **Laravel seguía intentando usar MySQL como caché en lugar de Redis:**
  - Se cambió `CACHE_DRIVER=redis` en el archivo `.env`.
  - Se ejecutaron los comandos para limpiar y actualizar la configuración:
    ```bash
    ./vendor/bin/sail artisan cache:clear
    ./vendor/bin/sail artisan config:clear
    ./vendor/bin/sail artisan config:cache
    ```
  - Se verificó que Redis estuviera activo con `./vendor/bin/sail exec redis redis-cli ping`.

- **Errores de migración en MySQL:**
  - Se creó la tabla de caché con `./vendor/bin/sail artisan cache:table` y luego se ejecutó `./vendor/bin/sail artisan migrate`.

## 🛠 Comandos Útiles con Sail

📌 **Levantar el entorno:**
```bash
./vendor/bin/sail up -d
```
📌 **Detener los servicios:**
```bash
./vendor/bin/sail down
```
📌 **Ejecutar comandos de Laravel Artisan:**
```bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan tinker
```
📌 **Ejecutar Composer dentro del contenedor:**
```bash
./vendor/bin/sail composer install
```
📌 **Acceder a MySQL dentro del contenedor:**
```bash
./vendor/bin/sail mysql
```
📌 **Ejecutar npm/yarn dentro del contenedor:**
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

## 📌 Notas
- Para cualquier cambio en el archivo `.env`, recuerda ejecutar:
  ```bash
  ./vendor/bin/sail artisan config:clear
  ```
- Si experimentas problemas con la conexión a MySQL, verifica que `DB_HOST=mysql` en el archivo `.env`.

## 📧 Contacto
Si tienes preguntas o problemas, contacta a: **tucorreo@ejemplo.com**


# Reparaz Estates - Plataforma Inmobiliaria

Proyecto de despliegue de una aplicación web inmobiliaria desarrollada con **HTML5, CSS3, PHP y MySQL**, utilizando sesiones para la gestión de usuarios.

---

## Descripción del proyecto

La aplicación simula una web inmobiliaria donde existen tres tipos de usuarios:

- Administrador
- Vendedor
- Comprador

Además, existe una parte pública donde cualquier usuario puede consultar los pisos sin necesidad de registro.

---

## Tecnologías utilizadas

- HTML5
- CSS3
- PHP
- MySQL (MariaDB)
- Apache (XAMPP / entorno local)
- Sesiones PHP

---

## Roles del sistema

### Administrador
- Gestión completa de usuarios (CRUD)
- Gestión completa de pisos (CRUD)

---

### Vendedor
- Crear pisos
- Ver sus propios pisos
- Consultar estado (vendido/disponible)

---

### Comprador
- Ver pisos disponibles
- Buscar pisos
- Realizar compras
- Consultar sus compras

---

## Parte pública (sin login)

- Visualización de pisos disponibles
- Detalle de cada piso
- Últimos pisos publicados

---

## Base de datos

Tablas principales:

- usuarios
- pisos
- compras

---

## Acceso al sistema

### Admin
- Email: admin@reparazestates.com
- Password: ****

---

## Instalación

1. Importar la base de datos en phpMyAdmin
2. Colocar el proyecto en `htdocs`
3. Iniciar Apache y MySQL en XAMPP
4. Acceder a: http://localhost/inmobiliaria

## Funcionalidades destacadas

- Sistema de login con sesiones
- Control de acceso por roles
- CRUD completo de usuarios y pisos
- Sistema de compras
- Panel diferenciado por tipo de usuario
- Imágenes en los pisos
- Web pública sin necesidad de login

---

## Autor

Proyecto desarrollado como práctica de **Desarrollo Web Entorno Servidor** por Cecilia de la Cámara
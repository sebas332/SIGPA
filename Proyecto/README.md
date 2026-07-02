# 🎓 Sistema de Gestión Académica (SGA) - Arquitectura MVC

Este es un **Sistema Integral de Gestión Académica (SGA)** de nivel empresarial, construido completamente desde cero siguiendo estrictamente el patrón de arquitectura **MVC (Modelo-Vista-Controlador)** en **PHP nativo con PDO (Orientado a Objetos)** y **MySQL/MariaDB**.

El sistema ha sido diseñado prestando especial atención a la estructura relacional de 16 tablas, garantizando compatibilidad absoluta con disparadores (**Triggers**) y procedimientos almacenados (**Stored Procedures**), tales como `sp_validar_sesiones_competencia`.

---

## 🏛 Estructura Arquitectónica del Proyecto

El sistema está organizado en una jerarquía clásica y limpia de MVC, asegurando una separación total de responsabilidades (SoC):

```text
/Proyecto
 ├── app/
 │    ├── Controllers/    # Lógica de negocio e intermediación (AuthController, FichaController, etc.)
 │    ├── Models/         # Interacción con la base de datos (Usuario, Rol, Ambiente, Asistencia, etc.)
 │    └── Views/          # Vistas dinámicas y plantillas modulares en HTML5/Bootstrap 5
 ├── config/
 │    ├── config.php      # Definición de constantes globales (DB, rutas, nombre del sitio)
 │    └── Database.php    # Conector Singleton PDO para consultas eficientes y seguras
 ├── public/
 │    ├── css/            # Estilos personalizados (styles.css)
 │    └── index.php       # FRONT CONTROLLER: Punto único de entrada y enrutador principal
 ├── README.md            # Manual de arquitectura y despliegue
 └── index.php            # Alias de reenvío automático para despliegues transparentes en XAMPP
```

---

## ✨ Características Principales y Roles

El sistema soporta flujos diferenciados para los 3 roles de negocio fundamentales:

1. **🛡 Coordinador**:
   - Acceso total a los paneles de administración.
   - Gestión de **Programas de Formación**, **Competencias** y **Resultados de Aprendizaje (RA)**.
   - Matrícula de **Fichas** y asignación de aprendices e instructores líderes.
   - Administración de **Usuarios** y asignación múltiple de roles.
   - Programación académica de sesiones en **Ambientes** disponibles.
   - Ejecución interactiva del procedimiento almacenado `sp_validar_sesiones_competencia`.

2. **👔 Instructor**:
   - Visualización de fichas lideradas y programación académica asignada.
   - **Toma de Asistencia** interactiva en tiempo real (con soporte para excusas y observaciones).
   - Consulta del catálogo de ambientes y reporte de **Novedades/Averías**.

3. **🎓 Aprendiz**:
   - Visualización de sus fichas matriculadas y cronograma de clases.
   - Resumen y control en tiempo real de su **Historial de Asistencias e Inasistencias**.

---

## 🚀 Despliegue y Guía Rápida de Prueba

1. **Servidor Local (XAMPP)**:
   - Clona o copia el proyecto en `c:\xampp\htdocs\Proyecto`.
   - Inicia los servicios de **Apache** y **MySQL**.

2. **Base de Datos**:
   - Importa el script `bd_proyecto_final.sql` en tu gestor MySQL/MariaDB (phpMyAdmin o CLI).

3. **Acceso web**:
   - Navega a `http://localhost/Proyecto` en tu navegador web.

4. **🔑 Credenciales de Prueba Precargadas**:
   En la pantalla de inicio de sesión, dispones de botones de autocompletado rápido para probar los 3 roles al instante:
   - **Coordinador**: Usuario `ana_coord` | Contraseña `hashed_pass_coord`
   - **Instructor**: Usuario `dcordero` | Contraseña `hashed_pass_123`
   - **Aprendiz**: Usuario `hasler_g` | Contraseña `hashed_pass_456`

---

## 🛡 Consideraciones de Calidad y Triggers

- **Backticks y 'ñ'**: Todas las consultas a la tabla `usuarios` respetan el uso de backticks para la columna `` `contraseña` ``.
- **Manejo de Triggers**: Si las reglas de negocio de un trigger arrojan un `SIGNAL SQLSTATE '45000'`, el sistema captura la excepción de forma elegante y muestra una notificación en pantalla mediante alertas Flash.
- **Diseño Premium**: Interfaz moderna implementada con **Bootstrap 5 CDN**, fuentes **Inter** y catálogo visual de ambientes.

# Tareas pendientes — Cooperativa Agrícola

## 💡 Material de Inspiración

En la carpeta `frontend_demo` van a encontrar una versión de prueba del sistema con un diseño corporativo terminado, moderno y funcional. 
**Este material está ahí exclusivamente para que sirva como inspiración visual.** La idea es que naveguen por la demo, vean cómo está organizada la información, cómo son los formularios y cómo se muestran los datos, y traten de replicar y adaptar esa calidad estética y estructural en su propio código PHP. ¡No pueden simplemente copiar el código (porque está bloqueado y minificado), así que tendrán que pensar cómo construirlo ustedes!

## Objetivo

Convertir el prototipo actual en un sistema básico para registrar, consultar, editar y eliminar trámites vinculados con productores y transportes de granos.

## Forma de trabajo

- El grupo debe dividir estas tareas entre sus cinco integrantes como decida en clase.
- Cada tarea tiene que hacerse, probarse y explicarse: no alcanza con pegar código generado por ChatGPT.
- Para usar ChatGPT gratuito, pedir **una tarea pequeña por consulta**. Por ejemplo: “Ayudame a cambiar este formulario de GET a POST; explicame cada cambio”. No pedir “haceme todo el sistema”.
- Antes de copiar código, comparar los nombres de campos, archivos y tablas con los que existen realmente en el proyecto.
- Al terminar cada tarea, probarla en el navegador y anotar: qué archivo se modificó, qué se probó y qué resultado dio.

## Tareas por hacer

### 1. Definir qué registra el sistema

- Escribir en el README una explicación de 5 a 8 líneas: qué es un trámite, quién lo registra, qué información contiene y quién puede consultarlo.
- Acordar que un trámite representa un movimiento o gestión de un productor: por ejemplo, el traslado de granos en un camión.
- Mantener como datos mínimos: productor/proveedor, fecha, patente, hora, dirección, producto y unidad de medida.
- Agregar y justificar dos datos propios de la cooperativa: `tipo_tramite` y `estado`.

**Para comprobarlo:** cualquier integrante debe poder explicar qué representa un registro sin decir “sensor”.

### 2. Crear y documentar la base de datos

- Crear un archivo `base_de_datos.sql` en el proyecto.
- Incluir la creación de la base de datos y de las tablas necesarias: usuarios y trámites.
- Definir una clave primaria numérica para cada trámite, por ejemplo `id` autoincremental.
- Definir tipos de datos adecuados para fecha, hora y los textos.
- Insertar al menos tres trámites de ejemplo para poder probar el reporte.
- Incluir instrucciones breves en el README para importar el archivo desde phpMyAdmin.

**Para comprobarlo:** otra computadora debe poder importar el `.sql` y ver los registros de prueba.

### 3. Corregir el alta de trámites

- Revisar el formulario `sensores/front/ingresodatos.html` y cambiar su método de `GET` a `POST`.
- Cambiar `sensores/back/ingresodatos.php` para que reciba los datos con `$_POST`.
- Validar en PHP que ningún campo obligatorio llegue vacío.
- Incorporar los campos tipo de trámite y estado.
- Guardar el trámite en la tabla definida en la tarea 2.
- Mostrar un mensaje de éxito y un mensaje de error comprensible, sin exponer errores técnicos de MySQL.

**Para comprobarlo:** registrar un trámite válido, verlo en la base de datos y comprobar que uno incompleto no se guarda.

### 4. Hacer un reporte que realmente funcione

- Crear una pantalla de resultados clara para los reportes. No enlazar directamente al `reporte.php` actual hasta corregirlo: hoy mezcla backend, presentación y datos heredados.
- Mostrar una tabla con: ID, productor/proveedor, patente, fecha, hora, dirección, producto, unidad, tipo y estado.
- Agregar un filtro por productor/proveedor y un segundo filtro por producto, fecha o estado.
- Mostrar cuántos resultados se encontraron.
- Si no hay resultados, mostrar un mensaje claro y no una pantalla vacía.
- Enlazar el botón “Ver reporte” sólo cuando la pantalla haya sido probada.

**Para comprobarlo:** mostrar todos los registros, filtrar al menos dos veces y comprobar que el total cambia.

### 5. Corregir la edición de trámites

- Revisar `sensores/clases/datos.php`: la actualización actual usa una propiedad `IDS` que no existe y una columna `datos` que no coincide con el alta.
- Crear un flujo de dos pasos: ingresar ID, buscar el trámite y mostrar un formulario con sus datos actuales.
- Permitir editar solamente campos definidos por el grupo: por ejemplo fecha, dirección, producto, tipo y estado.
- Enviar la edición mediante `POST`.
- Validar que el ID exista antes de actualizar.
- Volver al reporte o mostrar el registro actualizado como confirmación.

**Para comprobarlo:** modificar un trámite existente y confirmar el cambio tanto en la base como en el reporte.

### 6. Corregir la eliminación de trámites

- Revisar la eliminación actual: también usa una cantidad incorrecta de parámetros y no identifica correctamente el ID del trámite.
- Buscar el trámite por ID y mostrar un resumen antes de borrarlo.
- Pedir confirmación explícita antes de eliminar.
- Enviar la eliminación mediante `POST`.
- Si el ID no existe, mostrar un mensaje claro.

**Para comprobarlo:** eliminar un registro de prueba y verificar que no aparezca en el reporte.

### 7. Arreglar el acceso de usuarios

- Cambiar los formularios de inicio de sesión, registro y cambio de contraseña de `GET` a `POST`.
- Verificar que la confirmación de contraseña coincida al registrar un usuario.
- Antes de cambiar una contraseña, comprobar usuario, contraseña actual y confirmación de la nueva.
- Guardar contraseñas usando `password_hash` y validar el ingreso con `password_verify`.
- Corregir las rutas antiguas que todavía remitan a otro proyecto.

**Para comprobarlo:** registrar un usuario, iniciar sesión con él, fallar con una contraseña incorrecta y cambiar su contraseña correctamente.

### 8. Proteger el panel

- Crear una sesión PHP al iniciar sesión correctamente.
- Bloquear el acceso a las pantallas de trámites y reportes si no hay una sesión activa.
- Crear una opción de cerrar sesión.
- Definir dos permisos simples: administrador puede editar/eliminar; operador puede registrar y consultar. Si el grupo decide otra división, debe documentarla.

**Para comprobarlo:** intentar abrir el panel sin iniciar sesión y comprobar que redirige al login.

### 9. Mejorar seguridad y orden del código

- Reemplazar las consultas SQL construidas con texto concatenado por consultas preparadas.
- Centralizar la conexión a MySQL en un solo archivo y quitar conexiones duplicadas.
- No dejar usuario, contraseña, puerto y nombre de base repetidos por distintos archivos.
- No mostrar al usuario errores internos de MySQL.
- Quitar o reemplazar las referencias visibles heredadas: “sensores”, “EcoTidy”, “contenedores” y contenido de limpieza.

**Para comprobarlo:** recorrer todas las pantallas principales y verificar que hablan de la cooperativa y de trámites agrícolas.

### 10. Preparar la entrega

- Completar el README con propósito, requisitos, instalación, importación de la base, usuarios de prueba y funciones terminadas.
- Preparar una lista de pruebas: alta válida, alta inválida, reporte, filtros, edición, eliminación, login y bloqueo sin sesión.
- Cada integrante debe poder explicar una parte concreta que haya realizado y demostrarla funcionando.

**Entrega final mínima:** repositorio con `base_de_datos.sql`, README actualizado y todos los flujos de la lista probados.

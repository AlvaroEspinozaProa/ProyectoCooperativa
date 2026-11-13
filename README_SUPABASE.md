# Cooperativa Agrícola — versión migrada a Supabase

## Qué cambió
- Se retiró PHP y la conexión local con MySQL del proyecto convertido.
- Los trámites se guardan en Supabase, tabla `public.tramites`.
- El acceso, el registro y el cambio de contraseña usan Supabase Auth.
- Se mantienen las páginas HTML y las hojas CSS existentes.
- Se agregaron scripts JavaScript para registrar, buscar, actualizar, eliminar y listar trámites.

## 1. Preparar Supabase
1. Creá un proyecto en https://supabase.com/.
2. Abrí `supabase/schema.sql` y ejecutalo desde **SQL Editor > New query > Run**.
3. En Supabase, abrí **Project Settings > API** (o **API Keys**).
4. Copiá la **Project URL** y la clave pública **Publishable** (o `anon` en proyectos que todavía muestran esa clave).
5. Abrí `assets/js/supabase.js` y reemplazá:
   - `PEGAR_AQUI_TU_PROJECT_URL`
   - `PEGAR_AQUI_TU_PUBLISHABLE_O_ANON_KEY`

   No uses nunca `service_role` ni una secret key en archivos del navegador.

## 2. Configurar autenticación
- En Supabase, entrá a **Authentication > Providers > Email** y verificá que Email esté habilitado.
- Para pruebas escolares podés desactivar temporalmente la confirmación de correo en **Authentication > Settings**. Si la dejás activada, al registrarse el usuario tendrá que confirmar el correo antes de iniciar sesión.
- Los usuarios se crean desde `login/front/formulario_registro.html`.
- El inicio de sesión se realiza con correo electrónico y contraseña.
- El cambio de contraseña verifica primero el correo y la contraseña actual, y luego actualiza la contraseña de esa cuenta.

## 3. Abrir el proyecto
No abras los HTML con `file://`. Ejecutá la carpeta con un servidor local, por ejemplo:
- Visual Studio Code: extensión **Live Server** y abrir `home_page.html`.
- XAMPP: colocar la carpeta dentro de `htdocs` y abrir `http://localhost/TP_trabajo_integrador/home_page.html`.

No hace falta habilitar Apache/PHP para esta versión; Live Server también sirve los archivos estáticos.

## 4. Estructura de datos
La tabla `tramites` contiene:
- `id`: identificador automático.
- `proveedor`: nombre del proveedor.
- `matricula`: matrícula del transporte.
- `fecha`: fecha del trámite.
- `hora`: hora del trámite.
- `direccion`: dirección.
- `producto`: producto transportado.
- `unidad_medida`: kg, t u otro.
- `creado_en`: fecha y hora de creación.

## 5. Seguridad
Las políticas SQL permiten las operaciones CRUD solamente a usuarios autenticados. Todos los usuarios autenticados de este proyecto comparten el acceso a los trámites. Para producción conviene agregar roles y políticas por usuario/administrador.

## 6. Archivos JavaScript
- `assets/js/supabase.js`: conexión común.
- `assets/js/auth.js`: registro, login y cambio de contraseña.
- `assets/js/auth-guard.js`: protege el sistema y permite cerrar sesión.
- `sensores/js/tramites.js`: alta, búsqueda, actualización y eliminación.
- `sensores/js/reporte.js`: reporte y filtros.

## Importante sobre los datos antiguos
Esta migración crea una tabla nueva en Supabase, pero no copia automáticamente los registros que estuvieran guardados en tu MySQL local. Si necesitás conservarlos, exportalos desde phpMyAdmin como CSV y luego importalos a `public.tramites`, verificando que los nombres de columnas coincidan.

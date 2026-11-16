# Conectar el proyecto a Supabase

1. Entrá a [Supabase](https://supabase.com/dashboard), iniciá sesión y abrí tu proyecto.
2. En la parte superior del panel, hacé clic en **Connect**.
3. En las opciones de conexión, buscá los datos de la **API** para aplicaciones (no la cadena de conexión de la base de datos). Copiá:
   - **Project URL**: tiene el formato `https://...supabase.co`.
   - **Publishable key**: comienza con `sb_publishable_`. Si tu proyecto usa las claves anteriores, podés usar la clave pública `anon`.
4. En este repositorio, abrí `assets/js/supabase.js` y pegá cada valor entre las comillas correspondientes:

   ```js
   const SUPABASE_URL = "https://TU-PROYECTO.supabase.co";
   const SUPABASE_PUBLISHABLE_KEY = "sb_publishable_TU_CLAVE";
   ```

   Reemplazá los ejemplos por los valores de tu proyecto y guardá el archivo. No copies toda la configuración que muestra Supabase: solo la URL y la clave.

Si no encontrás la clave en **Connect**, abrí **Settings > API Keys** en Supabase y copiá la clave **Publishable**. Nunca uses una clave `secret` o `service_role` en este archivo.

## Crear las tablas

1. En el mismo proyecto de Supabase, abrí **SQL Editor** y hacé clic en **New query**.
2. En este repositorio, abrí el archivo `supabase/schema.sql` y copiá todo su contenido, desde `begin;` hasta `commit;` inclusive.
3. Pegalo en el editor de Supabase y hacé clic en **Run**. Comprobá que aparezca un mensaje de ejecución exitosa.
4. En **Table Editor**, verificá que aparezca la tabla `tramites`.

El archivo crea la tabla y sus permisos sin borrar sus registros; podés ejecutarlo de nuevo. Está pensado para un proyecto nuevo: si ya existe una tabla `tramites` con otra estructura, hacé una copia de seguridad y revisá su compatibilidad antes de ejecutarlo.

Las cuentas las administra **Supabase Auth**, por eso no hace falta crear una tabla de usuarios ni guardar contraseñas mediante este SQL. Los usuarios autenticados comparten los trámites y todos pueden consultarlos, modificarlos y eliminarlos; limitá el registro de usuarios o cambiá las políticas si necesitás otros permisos.

# Guía de Trabajo:

Hola equipo. Estuve revisando el código de su repositorio (la home_page.html, el sistema de login y el panel de administración de los sensores).

Quiero felicitarlos porque el nivel de backend que lograron con PHP es excelente. Armar un sistema con inicio de sesión, registro y un CRUD completo para gestionar sensores muestra un dominio muy bueno de las bases de datos y la programación del lado del servidor.

Ahora el objetivo es trasladar parte de esa funcionalidad a la página principal (home_page.html) para que los clientes que entren a la web puedan interactuar y solicitar servicios.

Les dejo las dos tareas estructuradas para dividirse en el equipo:

### Equipo 1: Calculadora de Presupuestos (JavaScript)
En la home_page.html muestran los servicios de limpieza residencial y comercial, pero el cliente no tiene forma de saber cuánto le saldría. Vamos a armar un cotizador automático.

1. En la sección de servicios de home_page.html, agreguen un bloque para cotizar. Necesitan un selector (<select>) para elegir el tipo de servicio (Residencial o Comercial), un campo numérico (<input type="number">) para ingresar los metros cuadrados, y un botón para calcular.
2. Dejen un contenedor o etiqueta de texto vacía con un id claro abajo del botón (por ejemplo, id="resultado-precio").
3. Creen un archivo JavaScript para la calculadora. Armen una función que se ejecute al hacer clic en el botón, lea los datos del selector y de los metros cuadrados, y haga el cálculo.
4. Muestren el resultado en el contenedor vacío usando .innerHTML con el monto estimado.
5. Agreguen una validación simple: si el usuario deja el campo de metros vacío o ingresa un número menor o igual a cero, deben mostrar un mensaje pidiendo que ingrese un valor válido.

### Equipo 2: Formulario de Contacto Real (PHP y MySQL)
Al final de la home_page.html tienen un formulario de contacto, pero actualmente no envía la información a ningún lado. Vamos a reutilizar la estructura de PHP que ya armaron en la carpeta de sensores.

1. En phpMyAdmin, creen una tabla llamada mensajes_contacto adentro de su base de datos. Pónganle las columnas id, nombre, email y mensaje.
2. En home_page.html, modifiquen la etiqueta del formulario para que use method="POST" y apunte a un archivo procesar_contacto.php en el atributo action.
3. Asegúrense de que todos los campos del formulario (input y textarea) tengan el atributo name configurado.
4. Creen el archivo procesar_contacto.php. Reciban los datos con $_POST, conéctense a la base de datos usando el archivo de conexión que ya tienen, y ejecuten la consulta INSERT INTO para guardar el mensaje.
5. Al finalizar el guardado, redirijan al usuario de vuelta a la home_page.html.

### Objetivo de esta etapa
La meta es que la página principal deje de ser estática. Un visitante debería poder calcular un presupuesto estimado en el acto y mandar una consulta desde el formulario que quede registrada de verdad en la base de datos.

Si se traban con la conexión de PHP o las variables de JavaScript, me dicen y lo miramos en la compu.
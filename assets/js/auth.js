
document.addEventListener("DOMContentLoaded", () => {

    const loginForm = document.getElementById("loginForm");

    if (!loginForm) return;

    loginForm.addEventListener("submit", async (event) => {

        event.preventDefault();

        const mensaje = document.getElementById("authMessage");
        const boton = loginForm.querySelector("button[type='submit']");

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("contrasena").value;

        mensaje.classList.add("d-none");

        boton.disabled = true;
        boton.textContent = "Ingresando...";

        try {

            // Iniciar sesión con Supabase
            const { data, error } =
                await window.supabaseClient.auth.signInWithPassword({
                    email: email,
                    password: password
                });

            if (error) {
                mensaje.textContent =
                    "Correo electrónico o contraseña incorrectos.";

                mensaje.className = "alert alert-danger mt-3";
                return;
            }

            // Inicio de sesión correcto
            mensaje.textContent = "¡Inicio de sesión exitoso!";
            mensaje.className = "alert alert-success mt-3";

            // Redirigir al sistema
            window.location.href = "sensores/sistema.html";

        } catch (error) {

            mensaje.textContent =
                "Ocurrió un error al conectar con Supabase.";

            mensaje.className = "alert alert-danger mt-3";

            console.error(error);

        } finally {

            boton.disabled = false;
            boton.textContent = "Ingresar";

        }

    });

});

function mostrarMensajeAuth(mensaje, texto, tipo) {
    mensaje.textContent = texto;
    mensaje.className = `alert alert-${tipo} mt-3`;
}

function clienteDisponible(mensaje) {
    if (window.supabaseClient) return true;
    mostrarMensajeAuth(mensaje, "Falta configurar Supabase. Consultá README_SUPABASE.md.", "warning");
    return false;
}

function cambiarEstadoBoton(boton, ocupado, texto) {
    boton.disabled = ocupado;
    boton.textContent = texto;
}

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", async (event) => {
            event.preventDefault();
            const mensaje = document.getElementById("authMessage");
            const boton = loginForm.querySelector("button[type='submit']");
            if (!clienteDisponible(mensaje)) return;

            cambiarEstadoBoton(boton, true, "Ingresando...");
            try {
                const { error } = await window.supabaseClient.auth.signInWithPassword({
                    email: document.getElementById("email").value.trim(),
                    password: document.getElementById("contrasena").value
                });
                if (error) {
                    mostrarMensajeAuth(mensaje, "Correo electrónico o contraseña incorrectos.", "danger");
                    return;
                }
                window.location.href = "sensores/sistema.html";
            } catch (error) {
                console.error(error);
                mostrarMensajeAuth(mensaje, "No se pudo conectar con Supabase.", "danger");
            } finally {
                cambiarEstadoBoton(boton, false, "Ingresar");
            }
        });
    }

    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", async (event) => {
            event.preventDefault();
            const mensaje = document.getElementById("authMessage");
            const boton = registerForm.querySelector("button[type='submit']");
            const password = document.getElementById("ca").value;
            if (!clienteDisponible(mensaje)) return;
            if (password !== document.getElementById("cc").value) {
                mostrarMensajeAuth(mensaje, "Las contraseñas no coinciden.", "warning");
                return;
            }

            cambiarEstadoBoton(boton, true, "Registrando...");
            try {
                const { data, error } = await window.supabaseClient.auth.signUp({
                    email: document.getElementById("ce").value.trim(),
                    password,
                    options: { data: { nombre: document.getElementById("n").value.trim() } }
                });
                if (error) {
                    mostrarMensajeAuth(mensaje, error.message, "danger");
                    return;
                }
                registerForm.reset();
                mostrarMensajeAuth(
                    mensaje,
                    data.session
                        ? "Usuario registrado. Ya podés iniciar sesión."
                        : "Usuario registrado. Revisá tu correo y confirmá la cuenta antes de iniciar sesión.",
                    "success"
                );
            } catch (error) {
                console.error(error);
                mostrarMensajeAuth(mensaje, "No se pudo conectar con Supabase.", "danger");
            } finally {
                cambiarEstadoBoton(boton, false, "Registrar");
            }
        });
    }

    const recoveryForm = document.getElementById("recoveryForm");
    if (recoveryForm) {
        recoveryForm.addEventListener("submit", async (event) => {
            event.preventDefault();
            const mensaje = document.getElementById("authMessage");
            const boton = recoveryForm.querySelector("button[type='submit']");
            if (!clienteDisponible(mensaje)) return;

            cambiarEstadoBoton(boton, true, "Enviando...");
            try {
                const { error } = await window.supabaseClient.auth.resetPasswordForEmail(
                    document.getElementById("u").value.trim(),
                    { emailRedirectTo: new URL("cambio_contrasena.html", window.location.href).href }
                );
                if (error) {
                    mostrarMensajeAuth(mensaje, error.message, "danger");
                    return;
                }
                mostrarMensajeAuth(mensaje, "Si el correo existe, recibirás un enlace para restablecer la contraseña.", "success");
            } catch (error) {
                console.error(error);
                mostrarMensajeAuth(mensaje, "No se pudo conectar con Supabase.", "danger");
            } finally {
                cambiarEstadoBoton(boton, false, "Enviar enlace");
            }
        });
    }

    const changePasswordForm = document.getElementById("changePasswordForm");
    if (changePasswordForm) {
        changePasswordForm.addEventListener("submit", async (event) => {
            event.preventDefault();
            const mensaje = document.getElementById("authMessage");
            const boton = changePasswordForm.querySelector("button[type='submit']");
            const passwordNueva = document.getElementById("nc").value;
            if (!clienteDisponible(mensaje)) return;
            if (passwordNueva !== document.getElementById("cc").value) {
                mostrarMensajeAuth(mensaje, "Las contraseñas nuevas no coinciden.", "warning");
                return;
            }

            cambiarEstadoBoton(boton, true, "Actualizando...");
            try {
                const { data, error: sessionError } = await window.supabaseClient.auth.getSession();
                if (sessionError || !data.session) {
                    mostrarMensajeAuth(mensaje, "Abrí el enlace recibido por correo para restablecer la contraseña.", "warning");
                    return;
                }
                const { error } = await window.supabaseClient.auth.updateUser({ password: passwordNueva });
                if (error) {
                    mostrarMensajeAuth(mensaje, error.message, "danger");
                    return;
                }
                changePasswordForm.reset();
                mostrarMensajeAuth(mensaje, "Contraseña actualizada. Ya podés iniciar sesión.", "success");
            } catch (error) {
                console.error(error);
                mostrarMensajeAuth(mensaje, "No se pudo conectar con Supabase.", "danger");
            } finally {
                cambiarEstadoBoton(boton, false, "Actualizar contraseña");
            }
        });
    }
});

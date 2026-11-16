const db = window.supabaseClient;

function mostrarResultado(elemento, texto, tipo = "info") {
    if (!elemento) return;
    elemento.className = `alert alert-${tipo} mt-3`;
    elemento.textContent = texto;
    elemento.classList.remove("d-none");
}

async function sesionActiva(elemento) {
    if (!db) {
        mostrarResultado(elemento, "Falta configurar Supabase.", "warning");
        return false;
    }
    const { data, error } = await db.auth.getSession();
    if (error || !data.session) {
        mostrarResultado(elemento, "Tu sesión no está activa. Volvé a iniciar sesión.", "warning");
        return false;
    }
    return true;
}

document.addEventListener("DOMContentLoaded", () => {
    // REGISTRAR TRÁMITE
    const formIngreso = document.getElementById("formIngreso");
    if (formIngreso) {
        formIngreso.addEventListener("submit", async (event) => {
            event.preventDefault();
            const mensaje = document.getElementById("resultadoOperacion");
            if (!await sesionActiva(mensaje)) return;
            const tramite = {
                proveedor: document.getElementById("id").value.trim(),
                fecha: document.getElementById("f").value,
                matricula: document.getElementById("mat").value.trim(),
                hora: document.getElementById("h").value,
                direccion: document.getElementById("s").value.trim(),
                producto: document.getElementById("prod").value,
                unidad_medida: document.getElementById("undm").value
            };

            const { error } = await db.from("tramites").insert(tramite);
            if (error) {
                mostrarResultado(mensaje, `No se pudo registrar el trámite: ${error.message}`, "danger");
                console.error(error);
                return;
            }

            mostrarResultado(mensaje, "¡Trámite registrado correctamente!", "success");
            formIngreso.reset();
        });
    }

    // BUSCAR Y ACTUALIZAR TRÁMITE
    const formActualizar = document.getElementById("formActualizar");
    const btnBuscar = document.getElementById("buscarTramite");
    if (formActualizar && btnBuscar) {
        btnBuscar.addEventListener("click", async () => {
            const id = document.getElementById("id").value;
            const mensaje = document.getElementById("resultadoOperacion");
            if (!await sesionActiva(mensaje)) return;
            if (!id) {
                mostrarResultado(mensaje, "Ingresá el ID del registro que querés buscar.", "warning");
                return;
            }

            const { data, error } = await db
                .from("tramites")
                .select("*")
                .eq("id", id)
                .maybeSingle();

            if (error || !data) {
                mostrarResultado(mensaje, error ? error.message : "No se encontró un trámite con ese ID.", "danger");
                return;
            }

            document.getElementById("proveedor").value = data.proveedor ?? "";
            document.getElementById("matricula").value = data.matricula ?? "";
            document.getElementById("fecha").value = data.fecha ?? "";
            document.getElementById("hora").value = data.hora ?? "";
            document.getElementById("direccion").value = data.direccion ?? "";
            document.getElementById("producto").value = data.producto ?? "";
            document.getElementById("unidad_medida").value = data.unidad_medida ?? "";
            mostrarResultado(mensaje, "Registro encontrado. Modificá los campos y presioná Actualizar.", "success");
        });

        formActualizar.addEventListener("submit", async (event) => {
            event.preventDefault();
            const id = document.getElementById("id").value;
            const mensaje = document.getElementById("resultadoOperacion");
            if (!await sesionActiva(mensaje)) return;

            const cambios = {
                proveedor: document.getElementById("proveedor").value.trim(),
                matricula: document.getElementById("matricula").value.trim(),
                fecha: document.getElementById("fecha").value,
                hora: document.getElementById("hora").value,
                direccion: document.getElementById("direccion").value.trim(),
                producto: document.getElementById("producto").value,
                unidad_medida: document.getElementById("unidad_medida").value
            };

            const { data, error } = await db
                .from("tramites")
                .update(cambios)
                .eq("id", id)
                .select("id");

            if (error) {
                mostrarResultado(mensaje, `No se pudo actualizar: ${error.message}`, "danger");
                return;
            }
            if (!data || data.length === 0) {
                mostrarResultado(mensaje, "No se modificó ningún registro. Revisá el ID.", "warning");
                return;
            }
            mostrarResultado(mensaje, "¡Registro actualizado correctamente!", "success");
        });
    }

    // ELIMINAR TRÁMITE
    const formEliminar = document.getElementById("formEliminar");
    if (formEliminar) {
        formEliminar.addEventListener("submit", async (event) => {
            event.preventDefault();
            const id = document.getElementById("n").value;
            const mensaje = document.getElementById("resultadoOperacion");
            if (!await sesionActiva(mensaje)) return;

            if (!confirm(`¿Seguro que querés eliminar el registro ${id}?`)) return;

            const { data, error } = await db
                .from("tramites")
                .delete()
                .eq("id", id)
                .select("id");

            if (error) {
                mostrarResultado(mensaje, `No se pudo eliminar: ${error.message}`, "danger");
                return;
            }
            if (!data || data.length === 0) {
                mostrarResultado(mensaje, "No se encontró un registro con ese ID.", "warning");
                return;
            }
            mostrarResultado(mensaje, "El registro se eliminó correctamente.", "success");
            formEliminar.reset();
        });
    }
});

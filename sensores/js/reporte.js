const reportDb = window.supabaseClient;

document.addEventListener("DOMContentLoaded", async () => {
    const tabla = document.getElementById("tablaTramites");
    if (!tabla) return;

    const tbody = document.getElementById("tramitesBody");
    const filtroTexto = document.getElementById("buscarProveedor");
    const filtroSelect = document.getElementById("filtroProveedor");
    const mensaje = document.getElementById("mensajeReporte");
    let tramites = [];

    function mostrarFilas(lista) {
        tbody.innerHTML = "";

        if (!lista.length) {
            tbody.innerHTML = '<tr><td colspan="8" class="text-center">No se encontraron trámites.</td></tr>';
            return;
        }

        lista.forEach((item) => {
            const fila = document.createElement("tr");
            [
                item.id,
                item.proveedor,
                item.matricula,
                item.fecha,
                item.hora,
                item.direccion,
                item.producto,
                item.unidad_medida
            ].forEach((valor) => {
                const celda = document.createElement("td");
                celda.textContent = valor ?? "-";
                fila.appendChild(celda);
            });
            tbody.appendChild(fila);
        });
    }

    function filtrar() {
        const texto = filtroTexto.value.trim().toLowerCase();
        const proveedor = filtroSelect.value;
        const filtrados = tramites.filter((item) => {
            const coincideTexto = !texto || item.proveedor.toLowerCase().includes(texto);
            const coincideSelect = proveedor === "todos" || item.proveedor === proveedor;
            return coincideTexto && coincideSelect;
        });
        mostrarFilas(filtrados);
    }

    const { data, error } = await reportDb
        .from("tramites")
        .select("*")
        .order("fecha", { ascending: false })
        .order("hora", { ascending: false });

    if (error) {
        mensaje.textContent = `No se pudo cargar el reporte: ${error.message}`;
        mensaje.className = "alert alert-danger";
        return;
    }

    tramites = data || [];
    const proveedores = [...new Set(tramites.map((item) => item.proveedor))].sort();
    proveedores.forEach((proveedor) => {
        const option = document.createElement("option");
        option.value = proveedor;
        option.textContent = proveedor;
        filtroSelect.appendChild(option);
    });

    mostrarFilas(tramites);
    filtroTexto.addEventListener("input", filtrar);
    filtroSelect.addEventListener("change", filtrar);

    document.getElementById("verTodos").addEventListener("click", () => {
        filtroTexto.value = "";
        filtroSelect.value = "todos";
        mostrarFilas(tramites);
    });

    mensaje.textContent = `Se encontraron ${tramites.length} trámite(s).`;
    mensaje.className = "alert alert-success";
});

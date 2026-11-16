import assert from "node:assert/strict";
import { readFile } from "node:fs/promises";
import test from "node:test";
import vm from "node:vm";

const root = new URL("../", import.meta.url);
const leer = (ruta) => readFile(new URL(ruta, root), "utf8");
const jwt = (role) => `eyJhbGciOiJub25lIn0.${Buffer.from(JSON.stringify({ role })).toString("base64url")}.firma`;

async function ejecutarConfiguracion(clave) {
    const original = await leer("assets/js/supabase.js");
    const config = original
        .replace('const SUPABASE_URL = "";', 'const SUPABASE_URL = "https://proyecto.supabase.co";')
        .replace('const SUPABASE_PUBLISHABLE_KEY = "";', `const SUPABASE_PUBLISHABLE_KEY = "${clave}";`);
    let argumentos;
    const window = { supabase: { createClient: (...args) => { argumentos = args; return { auth: {} }; } } };
    vm.runInNewContext(config, {
        window,
        atob: (valor) => Buffer.from(valor, "base64").toString("utf8"),
        console: { error() {} }
    });
    return { window, argumentos };
}

test("la configuración no crea un cliente con valores vacíos", async () => {
    const config = await leer("assets/js/supabase.js");
    const window = { supabase: { createClient: () => { throw new Error("no debe ejecutarse"); } } };
    vm.runInNewContext(config, { window, console: { error() {} } });
    assert.equal(window.supabaseClient, null);
});

test("la configuración crea un cliente al cargar URL y clave públicas", async () => {
    const { window, argumentos } = await ejecutarConfiguracion("sb_publishable_clave-publica-de-prueba");
    assert.deepEqual(argumentos, ["https://proyecto.supabase.co", "sb_publishable_clave-publica-de-prueba"]);
    assert.deepEqual(window.supabaseClient, { auth: {} });
});

test("la configuración acepta solo claves públicas", async () => {
    const anon = await ejecutarConfiguracion(jwt("anon"));
    assert.ok(anon.argumentos);

    for (const clave of ["sb_secret_clave-privada", jwt("service_role"), jwt("authenticated")]) {
        const resultado = await ejecutarConfiguracion(clave);
        assert.equal(resultado.window.supabaseClient, null);
        assert.equal(resultado.argumentos, undefined);
    }
});

test("la recuperación envía un enlace a una ruta ASCII", async () => {
    const auth = await leer("assets/js/auth.js");
    const listeners = {};
    const boton = { disabled: false, textContent: "Enviar enlace" };
    const formulario = { querySelector: () => boton, addEventListener: (_, handler) => { listeners.submit = handler; } };
    const mensaje = { textContent: "", className: "" };
    let solicitud;
    const window = {
        location: { href: "http://127.0.0.1:5500/login/front/recuperar_contrasena.html" },
        supabaseClient: { auth: { resetPasswordForEmail: async (...args) => { solicitud = args; return { error: null }; } } }
    };
    const document = {
        addEventListener: (_, handler) => handler(),
        getElementById: (id) => ({ recoveryForm: formulario, authMessage: mensaje, u: { value: "alumno@example.com" } }[id] || null)
    };
    vm.runInNewContext(auth, { window, document, console: { error() {} }, URL });
    await listeners.submit({ preventDefault() {} });
    assert.equal(solicitud[0], "alumno@example.com");
    assert.equal(solicitud[1].emailRedirectTo, "http://127.0.0.1:5500/login/front/cambio_contrasena.html");
});

test("el esquema y CRUD requieren usuarios autenticados", async () => {
    const [schema, tramites, reporte] = await Promise.all([
        leer("supabase/schema.sql"),
        leer("sensores/js/tramites.js"),
        leer("sensores/js/reporte.js")
    ]);
    for (const columna of ["proveedor", "matricula", "fecha", "hora", "direccion", "producto", "unidad_medida"]) {
        assert.match(schema, new RegExp(`\\b${columna}\\b`));
    }
    assert.match(schema, /enable row level security/);
    assert.match(schema, /to authenticated/g);
    assert.doesNotMatch(schema, /to anon\s*(?:using|with check)/);
    assert.match(tramites, /auth\.getSession/);
    assert.match(reporte, /auth\.getSession/);
});

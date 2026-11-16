// Reemplazá estos dos valores con los datos públicos de tu proyecto Supabase.
const SUPABASE_URL = ""; // PEGAR_AQUI_TU_PROJECT_URL
const SUPABASE_PUBLISHABLE_KEY = ""; // PEGAR_AQUI_TU_PUBLISHABLE_O_ANON_KEY

function esClavePublica(clave) {
    if (clave.startsWith("sb_secret_")) return false;
    if (clave.startsWith("sb_publishable_")) return true;

    try {
        const payload = clave.split(".")[1];
        const base64 = payload && payload.replace(/-/g, "+").replace(/_/g, "/");
        return base64 && JSON.parse(atob(base64.padEnd(Math.ceil(base64.length / 4) * 4, "="))).role === "anon";
    } catch {
        return false;
    }
}

const configuracionLista =
    /^https:\/\/[^\s]+\.supabase\.co$/.test(SUPABASE_URL) &&
    esClavePublica(SUPABASE_PUBLISHABLE_KEY);

if (!configuracionLista || !window.supabase) {
    window.supabaseClient = null;
    console.error("Falta configurar Supabase. Consultá README_SUPABASE.md.");
} else {
    window.supabaseClient = window.supabase.createClient(
        SUPABASE_URL,
        SUPABASE_PUBLISHABLE_KEY
    );
}


// ==========================================
// CONEXIÓN CON SUPABASE
// ==========================================

// Datos de tu proyecto Supabase
const SUPABASE_URL = "https://iyvcpklaegbcjcgikalw.supabase.co";

const SUPABASE_KEY = "sb_publishable_f5TiokGXUYMxAKWZq8_qIg_o2OUY7Tv";

// Crear conexión con Supabase
const { createClient } = window.supabase;

const supabaseClient = createClient(
    SUPABASE_URL,
    SUPABASE_KEY
);

// Hacer disponible la conexión en todo el proyecto
window.supabaseClient = supabaseClient;

console.log("Conexión con Supabase preparada correctamente");

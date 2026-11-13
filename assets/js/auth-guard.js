// Protege las páginas internas y agrega un botón para cerrar sesión.
document.addEventListener("DOMContentLoaded", async () => {
    const { data, error } = await window.supabaseClient.auth.getSession();

    if (error || !data.session) {
        const isFrontPage = window.location.pathname.includes("/sensores/front/");
        window.location.href = isFrontPage ? "../../home_page.html" : "../home_page.html";
        return;
    }

    const nav = document.querySelector(".navbar-nav");
    if (nav && !document.getElementById("logoutButton")) {
        const item = document.createElement("li");
        item.className = "nav-item";
        item.innerHTML = '<button id="logoutButton" class="nav-link btn btn-link text-start" type="button"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</button>';
        nav.appendChild(item);

        document.getElementById("logoutButton").addEventListener("click", async () => {
            await window.supabaseClient.auth.signOut();
            window.location.href = window.location.pathname.includes("/sensores/front/")
                ? "../../home_page.html"
                : "../home_page.html";
        });
    }
});

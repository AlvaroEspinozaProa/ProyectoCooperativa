// Protege las páginas internas y agrega un botón para cerrar sesión.
document.addEventListener("DOMContentLoaded", async () => {
    const isFrontPage = window.location.pathname.includes("/sensores/front/");
    const loginUrl = isFrontPage ? "../../home_page.html" : "../home_page.html";
    if (!window.supabaseClient) {
        window.location.href = loginUrl;
        return;
    }

    const { data, error } = await window.supabaseClient.auth.getSession();

    if (error || !data.session) {
        window.location.href = loginUrl;
        return;
    }

    const nav = document.querySelector(".navbar-nav");
    if (nav && !document.getElementById("logoutButton")) {
        const item = document.createElement("li");
        item.className = "nav-item";
        item.innerHTML = '<button id="logoutButton" class="nav-link btn btn-link text-start" type="button"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</button>';
        nav.appendChild(item);

        document.getElementById("logoutButton").addEventListener("click", async () => {
            const { error: signOutError } = await window.supabaseClient.auth.signOut();
            if (signOutError) {
                console.error(signOutError);
                return;
            }
            window.location.href = loginUrl;
        });
    }
});

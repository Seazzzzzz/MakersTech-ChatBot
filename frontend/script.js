//SERVICIOS

const buttons = document.querySelectorAll(".btn-filter");
const products = document.querySelectorAll(".services-1");

// Función para filtrar
function filtrarProductos(brand) {
    products.forEach(product => {
        if (brand === "all" || product.getAttribute("data-brand") === brand) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }
    });
}

// Mostrar solo HP al inicio
filtrarProductos("hp");

// Escuchar clics en los botones
buttons.forEach(button => {
    button.addEventListener("click", () => {
        const brand = button.getAttribute("data-brand");
        filtrarProductos(brand);
    });
});

const tabs = document.querySelectorAll(".auth-tab");
const forms = document.querySelectorAll(".auth-form");

tabs.forEach(tab => {
    tab.addEventListener("click", () => {
    tabs.forEach(t => t.classList.remove("active"));
    forms.forEach(f => f.classList.remove("active"));

    tab.classList.add("active");
    document.getElementById(tab.dataset.tab + "-form").classList.add("active");
});
});

function register() {
    const data = {
    nombre: document.getElementById("register-nombre").value,
    email: document.getElementById("register-email").value,
    password: document.getElementById("register-password").value
};

    fetch("http://localhost:5000/register", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
})
.then(res => res.json())
.then(data => alert(data.mensaje))
.catch(err => console.error(err));
}

function login() {
    const data = {
    email: document.getElementById("login-email").value,
    password: document.getElementById("login-password").value
};

fetch("http://localhost:5000/login", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
})
    .then(res => res.json())
    .then(data => alert(data.mensaje))
    .catch(err => console.error(err));
}

//INICIAR SESION Y REGISTRARSE PAGINA

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});

//ESTILO NAVBAR

window.addEventListener("scroll", function() {
    const menu = document.querySelector(".menu");
    if (window.scrollY > 50) {
        menu.classList.add("scrolled");
    } else {
        menu.classList.remove("scrolled");
    }
});
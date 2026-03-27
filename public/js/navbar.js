// Toggle Mobile Menu
document
    .getElementById("mobile-menu-button")
    ?.addEventListener("click", function () {
        const menu = document.getElementById("mobile-menu");
        menu.classList.toggle("hidden");
        menu.classList.toggle("slide-down");
    });

// Toggle Mobile Dropdown
function toggleMobileDropdown(name) {
    const dropdown = document.getElementById(`${name}-dropdown`);
    const icon = document.getElementById(`${name}-icon`);
    const toggle = icon.parentElement;

    dropdown.classList.toggle("hidden");
    toggle.classList.toggle("open");
}

// Close dropdowns when clicking outside
document.addEventListener("click", function (event) {
    const dropdowns = document.querySelectorAll(".group");

    dropdowns.forEach((dropdown) => {
        if (!dropdown.contains(event.target)) {
            const menu = dropdown.querySelector('[class*="dropdown-menu"]');
            if (menu) {
                menu.classList.remove("opacity-100", "visible");
                menu.classList.add("opacity-0", "invisible");
            }
        }
    });
});

// Active link scroll spy (optional)
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar-modern");
    if (window.scrollY > 50) {
        navbar.classList.add("shadow-xl");
    } else {
        navbar.classList.remove("shadow-xl");
    }
});

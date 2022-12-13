const toggleMenu = document.getElementById("toggleMenu");
const nav = document.getElementById("navItems");

toggleMenu.addEventListener("click", () => {
    nav.classList.toggle("max-sl:hidden");
    console.log("test");
});

const urlParams = new URLSearchParams(window.location.search);
const status = urlParams.get("status");

console.log (status);

document.querySelectorAll(".status-item").forEach(link => {
    const linkStatus = new URL(link.href).searchParams.get("status");
    if (linkStatus === status) {
        link.classList.add("active");
    }
});

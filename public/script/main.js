import('./header.js');
if (currentPage === "cart") {
    import('./cart-item.js');
} else {
    import('./slider.js');
}

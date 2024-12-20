import('./header.js');
if (currentPage === "cart" || currentPage === "detail") {
    import('./cart-item.js');
    import('./detail.js');
} else {
    import('./slider.js');
}

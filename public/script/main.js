import('./header.js');
if (currentPage === "cart") {
    import('./cart-item.js');
    import('./detail.js');
} else {
    import('./slider.js');
}

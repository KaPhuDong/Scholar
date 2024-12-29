import('./header.js');
if (currentPage === "products/detail") {
    import('./detail.js');
} if (currentPage === "order/cart") {
    import('./cart-item.js');
} else {
    import('./slider.js');
}

import('./header.js');
if (currentPage === "products/detail") {
    import('./detail.js');
} if (currentPage === "orders/cart") {
    import('./cart-item.js');
} if (currentPage === "admin/dashBoard") {
    import('./dashBoard.js');
} else {
    import('./slider.js');
}

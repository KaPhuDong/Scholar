import('./header.js');
import('./order-histories.js');
if (currentPage === "products/detail") {
    import('./detail.js');
} if (currentPage === "orders/cart") {
    import('./cart-item.js');
} else {
    import('./slider.js');
}

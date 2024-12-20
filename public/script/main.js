import('./header.js');
import('./detail.js');
if (currentPage === "cart") {
    import('./cart-item.js');
} else {
    import('./slider.js');
}

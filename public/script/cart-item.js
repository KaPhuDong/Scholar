// Get all cart items
const cartItems = document.querySelectorAll('.cart-item');

// Loop through each cart item
cartItems.forEach((item) => {
    const decreaseBtn = item.querySelector('.decrease');
    const increaseBtn = item.querySelector('.increase');
    const quantityInput = item.querySelector('.quantity .number');

    // Event listeners
    decreaseBtn.addEventListener('click', () => {
        if (quantityInput.value > 1) {
            quantityInput.value--;
        }
    });

    increaseBtn.addEventListener('click', () => {
        quantityInput.value++;
    });
});


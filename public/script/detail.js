// Get all cart items
const quantityDetail = document.querySelectorAll('#quantity-detail');

// Loop through each cart item
quantityDetail.forEach((quantity) => {
    const decreaseBtn = quantity.querySelector('#decrease');
    const increaseBtn = quantity.querySelector('#increase');
    const quantityInput = quantity.querySelector('#quantity #number');

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


// Get elements
const decreaseBtn = document.querySelector('.decrease');
const increaseBtn = document.querySelector('.increase');
const quantityInput = document.querySelector('.quantity .number');

// Event listeners
decreaseBtn.addEventListener('click', () => {
    if (quantityInput.value > 1) {
        quantityInput.value--;
    }
});

increaseBtn.addEventListener('click', () => {
    quantityInput.value++;
});

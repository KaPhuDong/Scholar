const quantityInput = document.getElementById('quantity');
const increaseButton = document.getElementById('increase');
const decreaseButton = document.getElementById('decrease');

increaseButton.addEventListener('click', function() {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue < quantityInput.max) {
        quantityInput.value = currentValue + 1;
    }
});

decreaseButton.addEventListener('click', function() {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > quantityInput.min) {
        quantityInput.value = currentValue - 1;
    }
});

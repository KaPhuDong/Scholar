// // Select the necessary elements
// const checkBoxes = document.querySelectorAll('.check-box');
// const totalPriceElement = document.querySelector('.total .price');
// const quantityInputs = document.querySelectorAll('.quantity-form input');

// function calculateTotal() {
//     let total = 0;

//     // Loop through each checkbox to see if it's checked
//     checkBoxes.forEach((checkbox) => {
//         if (checkbox.checked) {
//             const price = parseFloat(checkbox.getAttribute('data-price'));
//             const quantityInput = checkbox.closest('.cart-item').querySelector('.quantity-form input');
//             const quantity = parseInt(quantityInput.value); // Get quantity from the input field
//             total += price * quantity; // Add the total for the selected item
//         }
//     });

//     // Update the total amount in the DOM
//     totalPriceElement.textContent = `$${total.toFixed(2)}`;
// }

// // Recalculate the total when a checkbox is changed
// checkBoxes.forEach((checkbox) => {
//     checkbox.addEventListener('change', calculateTotal);
// });

// // Recalculate the total when the quantity is changed (through input field or buttons)
// quantityInputs.forEach((input) => {
//     input.addEventListener('input', () => {
//         if (input.value < 1) {
//             input.value = 1; // Prevent quantity from being less than 1
//         }
//         const checkbox = input.closest('.cart-item').querySelector('.check-box');
//         if (checkbox.checked) {
//             calculateTotal(); // Recalculate the total when quantity changes
//         }
//     });
// });

// // Initialize the total when the page loads
// document.addEventListener('DOMContentLoaded', calculateTotal);

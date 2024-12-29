const quantityDetail = document.querySelectorAll('#quantity-detail-cart');
const checkBoxes = document.querySelectorAll('.check-box');
const totalPriceElement = document.querySelector('.total .price');


function calculateTotal() {
    let total = 0;

    checkBoxes.forEach((checkbox) => {
        if (checkbox.checked) {
            const price = parseFloat(checkbox.getAttribute('data-price'));
            const quantityInput = checkbox.closest('.cart-item').querySelector('#quantity-in-cart #number-in-cart');
            const quantity = parseInt(quantityInput.value);
            total += price * quantity;
        }
    });

    totalPriceElement.textContent = `$${total.toFixed(2)}`;
}

quantityDetail.forEach((quantity) => {
    const decreaseBtn = quantity.querySelector('#decrease-in-cart');
    const increaseBtn = quantity.querySelector('#increase-in-cart');
    const quantityInput = quantity.querySelector('#quantity-in-cart #number-in-cart');
    const checkbox = quantity.closest('.cart-item').querySelector('.check-box');

    decreaseBtn.addEventListener('click', () => {
        if (quantityInput.value > 1) {
            quantityInput.value--;
            if (checkbox.checked) {
                calculateTotal();
            }
        }
    });

    increaseBtn.addEventListener('click', () => {
        quantityInput.value++;
        if (checkbox.checked) {
            calculateTotal();
        }
    });

    quantityInput.addEventListener('input', () => {
        if (quantityInput.value < 1) {
            quantityInput.value = 1;
        }
        if (checkbox.checked) {
            calculateTotal();
        }
    });
});

checkBoxes.forEach((checkbox) => {
    checkbox.addEventListener('change', calculateTotal);
});

const deleteButtons = document.querySelectorAll('.delete-product');

deleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const orderDetailId = button.getAttribute('data-order-detail-id'); // ID sản phẩm cần xóa
        if (confirm('Are you sure you want to remove this product from your cart?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/Scholar/Orders/removeFromCart';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'order_detail_id';
            input.value = orderDetailId;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
});


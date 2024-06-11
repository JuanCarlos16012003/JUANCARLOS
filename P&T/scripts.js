document.getElementById('order-now').addEventListener('click', function() {
    window.location.href = 'order.html';
});

const cart = JSON.parse(localStorage.getItem('cart')) || [];

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const description = this.getAttribute('data-description');
        const price = parseFloat(this.getAttribute('data-price'));
        cart.push({ description, price });
        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Producto agregado al carrito');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/home.php')
        .then(response => response.json())
        .then(data => {
            let productosContainer = document.getElementById('productos');
            data.forEach(producto => {
                let productoDiv = document.createElement('div');
                productoDiv.classList.add('producto');
                productoDiv.innerHTML = `
                    <h3>${producto.nombre}</h3>
                    <p>${producto.descripcion}</p>
                    <img src="../uploads/${producto.imagen1}" alt="${producto.nombre}">
                    <a href="https://wa.me/${producto.numero_telefono}?text=Hola, estoy interesado en tu producto ${producto.nombre}" target="_blank" class="trade-button">Tradeear</a>
                `;
                productosContainer.appendChild(productoDiv);
            });
        });
});

document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/profile.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('nombre').textContent = data.user.nombres;
            document.getElementById('apellido').textContent = data.user.apellidos;
            document.getElementById('correo').textContent = data.user.correo;

            let productosContainer = document.getElementById('productos');
            data.productos.forEach(producto => {
                let productoDiv = document.createElement('div');
                productoDiv.classList.add('producto');
                productoDiv.innerHTML = `
                    <h3>${producto.nombre}</h3>
                    <p>${producto.descripcion}</p>
                    <img src="../uploads/${producto.imagen1}" alt="${producto.nombre}">
                    <a href="https://wa.me/${data.user.numero_telefono}?text=Hola, estoy interesado en tu producto ${producto.nombre}" target="_blank" class="trade-button">Tradeear</a>
                `;
                productosContainer.appendChild(productoDiv);
            });
        });
});

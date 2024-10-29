document.addEventListener("DOMContentLoaded", function () {
    const nombreInput = document.getElementById("nombre");
    const precioInput = document.getElementById("precio");
    const statusFieldNombre = document.getElementById("nombreStatus");
    const statusFieldPrecio = document.getElementById("precioStatus");
    const formProducto = document.getElementById("formProducto");

    // Validar el nombre del producto
    nombreInput.addEventListener("input", function () {
        const nombre = this.value;

        if (nombre.trim() === "") {
            statusFieldNombre.textContent = "El campo no puede estar vacío.";
            statusFieldNombre.style.color = "red";
            return;
        }

        // Comprobar si el nombre ya existe en la base de datos
        fetch(`product-search.php?search=${encodeURIComponent(nombre)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    statusFieldNombre.textContent = "El producto ya existe.";
                    statusFieldNombre.style.color = "red";
                } else {
                    statusFieldNombre.textContent = "Campo válido.";
                    statusFieldNombre.style.color = "green";
                }
            })
            .catch(error => {
                console.error('Error:', error);
                statusFieldNombre.textContent = "Error en la validación.";
                statusFieldNombre.style.color = "red";
            });
    });

    // Validar el campo de precio
    precioInput.addEventListener("input", function () {
        const precio = this.value;
        const regex = /^\d+(\.\d{1,2})?$/; // Acepta enteros o decimales con hasta 2 decimales

        if (!regex.test(precio)) {
            statusFieldPrecio.textContent = "Precio inválido. Debe ser un número con hasta 2 decimales.";
            statusFieldPrecio.style.color = "red";
        } else {
            statusFieldPrecio.textContent = "Precio válido.";
            statusFieldPrecio.style.color = "green";
        }
    });

    // Enviar el formulario
    formProducto.addEventListener("submit", function (event) {
        event.preventDefault(); // Previene el comportamiento predeterminado

        // Verificar que todos los campos sean válidos antes de enviar
        if (statusFieldNombre.style.color === "green" && statusFieldPrecio.style.color === "green") {
            const formData = new FormData(this);

            fetch('product-add.php', { // Cambia esta ruta al archivo correcto
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('El producto se agregó con éxito'); // Ventana emergente al agregar el producto
                    // Opcional: Limpiar el formulario después de agregar el producto
                    formProducto.reset();
                    statusFieldNombre.textContent = "";
                    statusFieldPrecio.textContent = "";
                } else {
                    alert('Error al agregar el producto: ' + data.message);
                }
            })
            .catch(error => {
                alert('Ocurrió un error: ' + error.message);
            });
        } else {
            alert("Por favor, corrige los errores antes de enviar.");
        }
    });
});

// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();  // Evita el envío predeterminado del formulario

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;

    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON;
    try {
        finalJSON = JSON.parse(productoJsonString);
    } catch (error) {
        alert("El formato JSON no es válido");
        return;
    }

    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;

    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            alert(client.responseText);  // Mostramos el mensaje de respuesta del servidor
        }
    };
    client.send(productoJsonString);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function buscarProducto(event) {
    event.preventDefault();

    // OBTENER EL TÉRMINO DE BÚSQUEDA
    const searchTerm = document.getElementById('search').value;

    // VERIFICAR SI HAY UN TÉRMINO DE BÚSQUEDA
    if (searchTerm.trim() === '') {
        alert('Por favor, ingresa un término de búsqueda.');
        return;
    }

    // HACER UNA SOLICITUD FETCH AL SERVIDOR
    fetch('./backend/read.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'searchTerm=' + encodeURIComponent(searchTerm)
    })
    .then(response => response.json())
    .then(productos => {
        // LIMPIAR LA TABLA ANTES DE MOSTRAR LOS RESULTADOS
        const productosTable = document.getElementById('productos');
        productosTable.innerHTML = '';

        if (productos.error) {
            alert(productos.error);
            return;
        }

        // RECORRER LOS PRODUCTOS Y AGREGARLOS A LA TABLA
        productos.forEach(producto => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>${producto.detalles ? producto.detalles : 'Sin descripción'}</td> <!-- Mostrar la descripción -->
            `;
            productosTable.appendChild(row);
        });
    })
    .catch(error => console.error('Error al buscar productos:', error));
}

function init() {
    // Convierte el JSON a string para poder mostrarlo
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}

// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

let editProductId = null; // Variable para almacenar el ID del producto en edición

function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);
    listarProductos();
}

function listarProductos() {
    $.get('./backend/product-list.php', function(data) {
        let productos = JSON.parse(data);
        let template = '';
        productos.forEach(producto => {
            let descripcion = `
                <ul>
                    <li>precio: ${producto.precio}</li>
                    <li>unidades: ${producto.unidades}</li>
                    <li>modelo: ${producto.modelo}</li>
                    <li>marca: ${producto.marca}</li>
                    <li>detalles: ${producto.detalles}</li>
                </ul>
            `;
            template += `
                <tr productId="${producto.id}">
                    <td>${producto.id}</td>
                    <td class="editable-product" data-id="${producto.id}">${producto.nombre}</td>
                    <td>${descripcion}</td>
                    <td>
                        <button class="btn btn-danger product-delete">Eliminar</button>
                    </td>
                </tr>
            `;
        });
        $('#products').html(template);
    });
}

// Evento para editar un producto al hacer clic
$(document).on('click', '.editable-product', function() {
    const row = $(this).closest('tr');
    editProductId = row.attr('productId');

    $('#name').val(row.children().eq(1).text());
    $('#description').val(JSON.stringify({
        precio: row.find('li').eq(0).text().split(': ')[1],
        unidades: row.find('li').eq(1).text().split(': ')[1],
        modelo: row.find('li').eq(2).text().split(': ')[1],
        marca: row.find('li').eq(3).text().split(': ')[1],
        detalles: row.find('li').eq(4).text().split(': ')[1],
    }, null, 2));

    $('#edit-button').show().text('Actualizar Producto');
});

// Función para actualizar el producto
$('#edit-button').click(function() {
    if (editProductId) {
        let productoJsonString = $('#description').val();
        let finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $('#name').val();
        finalJSON['id'] = editProductId; // Asegúrate de incluir el ID del producto
        productoJsonString = JSON.stringify(finalJSON, null, 2);

        $.ajax({
            url: './backend/product-edit.php', // Cambia a la URL de tu script PHP para editar
            type: 'POST',
            contentType: 'application/json',
            data: productoJsonString,
            success: function(response) {
                console.log('Respuesta del servidor:', response); // Agrega este log para ver la respuesta
                try {
                    // Verifica si la respuesta ya es un objeto JSON
                    let respuesta = typeof response === 'object' ? response : JSON.parse(response);
                    alert(`${respuesta.status}: ${respuesta.message}`);
                    listarProductos();
                    $('#edit-button').hide();
                    editProductId = null;
                } catch (e) {
                    alert('Error al procesar la respuesta: ' + e.message);
                    console.error('Error en la respuesta:', e); // Agrega este log para depurar errores
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error en la solicitud: ' + textStatus + ' - ' + errorThrown);
                console.error('Error en la solicitud:', jqXHR);
            }
        });
    }
});




// Función para eliminar un producto
$(document).on('click', '.product-delete', function() {
    if (confirm("¿De verdad deseas eliminar el producto?")) {
        const row = $(this).closest('tr');
        var id = row.attr('productId');
        
        $.get(`./backend/product-delete.php?id=${id}`, function(response) {
            let respuesta = JSON.parse(response);
            alert(`${respuesta.status}: ${respuesta.message}`);
            listarProductos();
        });
    }
});

// Función para agregar un nuevo producto
$('#product-form').submit(function(e) {
    e.preventDefault();
    var productoJsonString = $('#description').val();
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = $('#name').val();
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    $.ajax({
        url: './backend/product-add.php', // Cambia a la URL de tu script PHP para agregar
        type: 'POST',
        contentType: 'application/json',
        data: productoJsonString,
        success: function(response) {
            let respuesta = JSON.parse(response);
            alert(`${respuesta.status}: ${respuesta.message}`);
            listarProductos();
        }
    });
});

// Búsqueda al teclear
$('#search').on('input', function() {
    const query = $(this).val().toLowerCase();
    $('#products tr').filter(function() {
        const name = $(this).find('td:eq(1)').text().toLowerCase();
        const description = $(this).find('td:eq(2)').html().toLowerCase(); // Usar HTML para acceder a los detalles
        return name.indexOf(query) > -1 || description.indexOf(query) > -1; // Filtra por nombre o descripción
    }).show();
    
    $('#products tr').filter(function() {
        const name = $(this).find('td:eq(1)').text().toLowerCase();
        const description = $(this).find('td:eq(2)').html().toLowerCase(); // Usar HTML para acceder a los detalles
        return name.indexOf(query) === -1 && description.indexOf(query) === -1; // Oculta si no coincide
    }).hide();
});

// Inicializar
$(document).ready(function() {
    init();
});

function deleteProduct(id, e) {
    Swal.fire({
        title: '¿Estás seguro de querer eliminar este producto?',
        text: 'Una vez eliminado, la acción no se podrá revertir.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, borrar.',
        cancelButtonText: 'No, mantener.'
    }).then((result) => {

        if (result.value) {
            $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/dashboard/eliminar_producto/' + id,
                data: id,
                success: function (data) {
                    if (data.status === true) {
                        Swal.fire(
                            '¡Borrado!',
                            'El producto ha sido eliminado.',
                            'success'
                        )
                        var p = e.parentNode.parentNode;
                        p.closest('tr').remove()
                    } else {
                        Swal.fire(
                            '¡Oops!',
                            'No se pudo eliminar el producto.',
                            'error'
                        )
                    }
                }
            });


        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    })
}

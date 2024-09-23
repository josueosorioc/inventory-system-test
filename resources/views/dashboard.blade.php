@extends('main')

@section('title', 'Dashboard de articulos')

@section('content')
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="mb-4">Listado de artículos</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('add.article') }}" class="btn btn-secondary">Registrar artículo</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let configDT = {};
        configDT.ajax = {
            url: "{{ route('list.articles.data') }}",
            dataSrc: ""
        };
        configDT.columns = [{
                data: 'nombre',
                className: 'text-center',
            },
            {
                data: 'cantidad',
                className: 'text-center',

            },
            {
                data: 'precio',
                className: 'text-center',
            },
            {
                data: 'user_id',
                className: 'text-center',
                render: function(data, type, row, meta) {
                    return `<span class="badge text-bg-primary">${row.user.name}</span>`
                }
            },
            {
                data: 'acciones',
                className: 'text-center',
                name: 'acciones',
                render: function(data, type, row, meta) {
                    if (row.user.id == {{ Auth::id() }}) {
                        return `
                            <a href="{{ url('/') }}/articulos/ver/${row.id}" class="btn btn-primary">Ver</a>
                            <a href="{{ url('/') }}/articulos/editar/${row.id}" class="btn btn-secondary">Editar</a>
                            <button onclick="deleteArticle(${row.id})" class="btn btn-danger">Eliminar</button>
                        `;
                    } else {
                        return `<a href="{{ url('/') }}/articulos/ver/${row.id}" class="btn btn-primary">Ver</a>`;
                    }
                }
            },
        ]
        let table = new DataTable('#dataTable', configDT);

        function deleteArticle(id) {
            Swal.fire({
                title: "¿Estas seguro de eliminar este artículo?",
                text: "Esta accion es irreversible",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "DELETE",
                        url: `{{ url('/') }}/articulos/delete/${id}`,
                    }).done(function(res) {
                        Swal.fire(
                            'Registro eliminado',
                            'El artículo ha sido eliminada con éxito',
                            'success'
                        );
                        table.rows().invalidate().draw(false);
                        table.ajax.reload();
                    });
                }
            });
        }
    </script>
@endsection

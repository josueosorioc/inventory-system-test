@extends('main')

@section('title', 'Dashboard de articulos')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-4">Listado de artículos</h3>
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
                    return ``;
                }
            },
        ]
        let table = new DataTable('#dataTable', configDT);
    </script>
    </script>
@endsection

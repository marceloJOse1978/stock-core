<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Tabela - {{$title}}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$title}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                            <a
                                class="btn btn-primary dropdown-toggle"
                                href="#"
                                role="button"
                                data-toggle="dropdown"
                            >
                                Recurso
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{url("clients/create")}}">Gravar</a>
                                <a class="dropdown-item" href="{{url("export/clients")}}">Exportar EXCEL</a>
                                <a class="dropdown-item" href="{{url("import/clients")}}">Importar EXCEL</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Dados Armazenados</h4>
                </div>
                <div class="pb-20">
                    <table
                        class="data-table table hover nowrap"
                    >
                        <thead>
                            
                            <tr>
                                <th>NIF</th>
                                <th class="table-plus datatable-nosort">Nome</th>
                                <th>Telemovel</th>
                                <th>Endereço</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($collection as $item)
                                <tr>
                                    <td class="table-plus">{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>
                                        <div class="table-actions">
                                            <form action="{{ route('clients.destroy',$item->id) }}" method="Post">
                                                <a href="{{ route('clients.edit',$item->id) }}" data-color="#265ed7"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" style=" border: hidden; background:none;"   data-color="#e95959"><i style="font-size: 20px" class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                                <a href="{{ url("clients/$item->id") }}" data-color="green" ><i class="icon-copy fa fa-user-circle" aria-hidden="true"></i></a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        /* TABELA DE ITEM START */
        function dataTables() {
            $('.data-table').DataTable({
                responsive: true,
                searching: true,
                bLengthChange: false,
                bPaginate: true,
                bInfo: false,
                processing: true,
                ajax:"{{route('clients.index')}}",
                dataSrc: 'data',
                columns: [
                    { data: 'code' },
                    { data: 'name' },
                    { data: 'mobile' },
                    { data: 'address' },
                    { data: 'action' }
                ],
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
                "language": {
                    "info": "_INICIO_-_FIM_ DE _TOTAL_ ENTRE",
                    searchPlaceholder: "Search",
                    paginate: {
                        next: '<i class="ion-chevron-right"></i>',
                        previous: '<i class="ion-chevron-left"></i>'
                    }
                },
            });
        }
        $(document).ready(function () {
            dataTables();
        });
        /* TABELA DE ITEM END */
});
</script>
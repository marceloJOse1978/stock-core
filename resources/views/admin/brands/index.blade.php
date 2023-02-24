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
                                <a class="dropdown-item" href=" {{url("brands/create")}} ">Gravar</a>
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
                        class="data-table table hover data-table-export nowrap"
                    >
                        <thead>
                            <th>Titulo</th>
                            <th>Estado</th>
                            <th>:</th>
                        </thead>
                        <tbody>
                            {{-- @foreach ($collection as $item)
                                <tr>
                                    <td class="table-plus">{{$item->title}}</td>
                                    <td>
                                        @if (!empty($item->status))
                                            <span
                                                class="badge badge-pill"
                                                data-bgcolor="#e7ebf5"
                                                data-color="#265ed7"
                                                >Activo</span
                                            >
                                        @else
                                            <span
                                                class="badge badge-pill"
                                                data-bgcolor="red"
                                                data-color="#ffff"
                                                >Inactivo</span
                                            >
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <form action="{{ route('brands.destroy',$item->id) }}" method="Post">
                                                <a href="{{ route('brands.edit',$item->id) }}" data-color="#265ed7"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style=" border: hidden; background:none;"   data-color="#e95959"><i style="font-size: 20px" class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
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
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            refreshTable()
        });
        
        function refreshTable() { 
            $('.data-table').DataTable({
                processing: true,
                ajax: "{{route('brands.index')}}",
                dataSrc: 'data',
                columns: [
                    { data: 'title' },
                    { data: 'status' },
                    { data: 'action' }
                ]
            });
        }
    });
  </script>   

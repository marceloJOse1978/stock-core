<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Perfil - Usuário</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Perfil
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            <img
                                src="{{(empty($row->pic_path))?url("public/setting/empty.png"):url("public/storage/user/$row->pic_path")}}"
                                alt=""
                                class="avatar-photo"
                            />
                        </div>
                        <h5 class="text-center h5 mb-0">{{$row->name}}</h5>
                        <p class="text-center text-muted font-14">
                           {{$row->role}}
                        </p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Informação</h5>
                            <ul>
                                <li>
                                    <span>Email Endereço:</span>
                                    {{$row->email}}
                                </li>
                                <li>
                                    <span>Numero de Telefone:</span>
                                    {{$row->phone}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <!-- Export Datatable start -->
                        <div class="pd-20">
                            <h4 class="text-blue h4">Dados Armazenados</h4>
                        </div>
                        <table
                            class="data-table table hover data-table-export nowrap"
                        >
                            <thead>
                                
                                <tr>
                                    <th class="table-plus datatable-nosort">Nº Documento</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>:</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
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
                    search:false,
                    ajax: "{{route('timeworks.show',$id)}}",
                    dataSrc: 'data',
                    columns: [
                        { data:'number'},
                        { data:'client_id'},
                        { data:'status' },
                        { data:'action' }
                    ]
                });
            }
        });
        </script>

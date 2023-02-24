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
            ajax: "{{route('all.index')}}",
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
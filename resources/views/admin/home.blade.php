<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="title pb-20">
            {{-- <h2 class="h3 mb-0">Hospital Overview</h2> --}}
        </div>

        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"> {{$stock}} </div>
                            <div class="font-14 text-secondary weight-500">
                               Estoque
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf">
                                <i class="icon-copy dw dw-groceries-store"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{$client}}</div>
                            <div class="font-14 text-secondary weight-500">
                                Total de Clientes
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <i class="icon-copy dw dw-user-11"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"> {{$product}} </div>
                            <div class="font-14 text-secondary weight-500">
                                Catalogo de Produto
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy dw dw-price-tag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $document }}</div>
                            <div class="font-14 text-secondary weight-500">Documento Emitido</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06">
                                <i class="icon-copy dw dw-file"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-10">
            <div class="col-md-8 mb-20">
                <div class="card-box height-100-p pd-20">
                    <div
                        class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3"
                    >
                        <div class="h5 mb-md-0">Movimente Financeiro</div>
                    </div>
                    <div id="activities-chart"></div>
                </div>
            </div>
            <div class="col-md-4 mb-20">
                <div
                    class="card-box min-height-200px pd-20 mb-20"
                    data-bgcolor="#455a64"
                >
                    <div class="d-flex justify-content-between pb-20 text-white">
                        <div class="icon h1 text-white">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
                        </div>
                        <div class="font-14 text-right">
                            <div><i class="icon-copy ion-arrow-up-c"></i></div>
                            <div class="font-12">Vendas deste Mês</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="text-white">
                            <div class="font-14">VENDA</div>
                            <div class="font-24 weight-500">{{$buy}}</div>
                        </div>
                        <div class="max-width-150">
                            <div id="appointment-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                    <div class="d-flex justify-content-between pb-20 text-white">
                        <div class="icon h1 text-white">
                            <i class="icon-copy dw dw-groceries-store"></i>
                        </div>
                        <div class="font-14 text-right">
                            <div><i class="icon-copy ion-arrow-down-c"></i></div>
                            <div class="font-12">Compras deste Mês</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="text-white">
                            <div class="font-14">COMPRA</div>
                            <div class="font-24 weight-500">{{$sale}}</div>
                        </div>
                        <div class="max-width-150">
                            <div id="surgery-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 mb-20">
                <div class="card-box pb-10">
                    <div class="h5 pd-20 mb-0">Nossos Clientes</div>
                    <table
                        class="data-table-clients table nowrap"
                    >
                        <thead>
                            
                            <tr>
                                <th>NIF</th>
                                <th class="table-plus datatable-nosort">Nome</th>
                                <th>Telemovel</th>
                                <th>Endereço</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collection as $item)
                                <tr>
                                    <td class="table-plus">{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{$item->address}}</td>
                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<script>
var options = {
    series: [
    {
        name: "Patients",
        data: [{{$chart["total"]}}]
    }
    ],
    chart: {
        height: 300,
        type: 'line',
        zoom: {
            enabled: false,
        },
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 16,
            opacity: 0.2
        },
        toolbar: {
            show: false
        }
    },
    colors: ['#f0746c', '#255cd3'],
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: [3,3],
        curve: 'smooth'
    },
    grid: {
        show: false,
    },
    markers: {
        colors: ['#f0746c', '#255cd3'],
        size: 5,
        strokeColors: '#ffffff',
        strokeWidth: 2,
        hover: {
            sizeOffset: 2
        }
    },
    xaxis: {
        categories: [<?php echo $chart["date"] ?>],
        labels:{
            style:{
                colors: '#8c9094'
            }
        }
    },
    yaxis: {
        min: 0,
        max: 35,
        labels:{
            style:{
                colors: '#8c9094'
            }
        }
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: 0,
        labels: {
            useSeriesColors: true
        },
        markers: {
            width: 10,
            height: 10,
        }
    }
};
</script>
<script>
    $('document').ready(function(){
        $('.data-table-clients').DataTable({
            responsive: true,
                searching: false,
                bLengthChange: false,
                bPaginate: true,
                bInfo: false,
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
    });  
</script>
<!-- Datatable Setting js -->
		<script src="{{ asset('') }}vendors/scripts/datatable-setting.js"></script>

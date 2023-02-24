<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Painel - {{$title}}</h4>
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

        <div class="row pb-10">
            <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"> 
                                {{number_format($entrada,2)}} 
                            </div>
                            <div class="font-14 text-secondary weight-500">
                                ENTRADA
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf">
                                <i class="icon-copy fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"> 
                                {{number_format($saida,2)}} 
                            </div>
                            <div class="font-14 text-secondary weight-500">
                                SAIDA
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <span class="icon-copy fa fa-money"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-12 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"> 
                                {{number_format($saldo,2)}} 
                            </div>
                            <div class="font-14 text-secondary weight-500">
                                SALDO
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06">
                                <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form grid Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Capo de Busca</h4>
                    <p class="mb-30">Filtro de Pesquisa</p>
                </div>
            </div>
                <form action="{{url("reports/core/cash")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <label for="">Data Inicial</label>
                            <div class="form-group">
                                <input type="date" name="date_init" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <label for="">Data Final</label>
                            <div class="form-group">
                                <input type="date" name="date_end" class="form-control" />
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <label for=""></label>
                            <label for=""></label>
                            <div class="form-group">
                                <div class="col-sm-1 col-md-1">
                                    <button type="submit" class="btn btn-primary">PESQUISAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="pd-20 card-box mb-30">
            <div class="h5 pd-20 mb-0">MOVIMENTO DO CAIXA </div>
            <table
                class="table hover multiple-select-row data-table-export nowrap"
            >
                <thead>
                    
                    <tr>
                        <th>Descrição</th>
                        <th class="table-plus datatable-nosort">Movimento </th>
                        <th class="table-plus datatable-nosort">Montante</th>
                        <th>Usuário</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                        <tr>
                            <td class="table-plus">{{$item->title}}</td>
                            <td>{{(empty($item->status)? "SAIDA" : "ENTRADA" )}}</td>
                            <td>{{number_format($item->amount,2,".",",")}}</td>
                            <td>{{$item->users->name}}</td>
                            <td>{{$item->date}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
    <script src="{{asset('')}}public/src/plugins/apexcharts/apexcharts.min.js"></script>
    {{-- <script>
        var options3 = {
        series: [{
            name: 'SALDO DO MÊS',
            data: [{{$sums}}]
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '25%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: [<?php echo $months ?>],
        },
        yaxis: {
            title: {
                text: 'Motante'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Motante"
                }
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart3"), options3);
    chart.render();
    </script> --}}
    

        
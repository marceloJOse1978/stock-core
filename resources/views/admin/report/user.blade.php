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
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a
                            class="btn btn-primary dropdown-toggle"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                        >
                            Actividade
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            
                            <a class="dropdown-item" href="#">Exportar Relatório</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"> {{number_format($dividas,0,".")}} </div>
                            <div class="font-14 text-secondary weight-500">
                                Total Dividas
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf">
                                <i class="icon-copy dw dw-calendar1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{number_format($dentro_prazo,0,".")}}</div>
                            <div class="font-14 text-secondary weight-500">
                                Dentro de Prazo
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <span class="icon-copy ti-heart"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{number_format($fora_do_prazo,0,".")}}</div>
                            <div class="font-14 text-secondary weight-500">
                                Fora do Prazo
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i
                                    class="icon-copy fa fa-stethoscope"
                                    aria-hidden="true"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{number_format($liquidado,0,".")}}</div>
                            <div class="font-14 text-secondary weight-500">Total Liquidado</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06">
                                <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
                        <div class="col-md-3 col-sm-12">
                            <label for="">Data Inicial</label>
                            <div class="form-group">
                                <input type="date" name="date_init" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="">Data Final</label>
                            <div class="form-group">
                                <input type="date" name="date_end" class="form-control" />
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-12">
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
        
        <div class="card-box pb-10">
            <div class="h5 pd-20 mb-0">Usuário </div>
            <table
                class="table hover multiple-select-row data-table-export nowrap"
            >
                <thead>
                    
                    <tr>
                        <th>NO</th>
                        <th class="table-plus datatable-nosort">Usuário </th>
                        <th class="table-plus datatable-nosort">Montante</th>
                        <th>Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                        <tr>
                            <td class="table-plus">{{$item->title}}</td>
                            <td>{{number_format($item->amount,2,".",",")}}</td>
                            <td>{{$item->users->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        
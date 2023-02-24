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
                            Recurso
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route("export.inventory")}}">INVENTÁRIO</a>
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
                            <div class="weight-700 font-24 text-dark"> 50 </div>
                            <div class="font-14 text-secondary weight-500">
                                Total do Dia
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
                            <div class="weight-700 font-24 text-dark">124,551</div>
                            <div class="font-14 text-secondary weight-500">
                                Total Do Ano
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
                            <div class="weight-700 font-24 text-dark">400+</div>
                            <div class="font-14 text-secondary weight-500">
                                Total Gasto
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
                            <div class="weight-700 font-24 text-dark">$50,000</div>
                            <div class="font-14 text-secondary weight-500">Total à Retorna</div>
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
        {{-- <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Capo de Busca</h4>
                    <p class="mb-30">Filtro de Pesquisa</p>
                </div>
            </div>
            <form>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label for="">Data Inicial</label>
                        <div class="form-group">
                            <input type="date" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label for="">Data Final</label>
                        <div class="form-group">
                            <input type="date" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label>Produto</label>
                        <select
                            class="custom-select2 form-control"
                            name="product_id"
                            id="product_id"
                            style="width: 100%; height: 38px">
                            <option value="0">Selecione um Produto</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->title}}</option>
                            @endforeach
                        </select>
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
            </div>
        </div> --}}
        
        <div class="card-box pb-10">
            <div class="h5 pd-20 mb-0">Estoque</div>
            <table
                class="table hover multiple-select-row data-table-export nowrap"
            >
                <thead>
                    
                    <tr>
                        <th>Produto</th>
                        <th class="table-plus datatable-nosort">Quantidade</th>
                        <th class="table-plus datatable-nosort">Total</th>
                        <th class="table-plus datatable-nosort"><i class="icon-copy ion-android-more-vertical"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                        <tr>
                            <td class="table-plus">{{$item->products->title}}</td>
                            <td>{{"$item->qtd ".$item->units->title}}</td>
                            <td>{{$item->net_total}}</td>
                            <td><a href="{{route("stocks.show",$item->product_id)}}"><i class="icon-copy dw dw-exchange"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        
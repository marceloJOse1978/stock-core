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
        </div>
        <!-- Form grid Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Capo de Busca</h4>
                    <p class="mb-30">Filtro de Pesquisa</p>
                </div>
            </div>
                <form action="{{url("reports/clients")}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 col-sm-12">
                            <label>FILTRAR PAGAMENTO</label>
                            <select
                                class=" form-control"
                                name="type"
                                style="width: 100%; height: 38px">
                                <option value="">Todos</option>
                                <option value="1">Dividas</option>
                                <option value="2">Fora Do Prazo</option>
                                <option value="3">Dentro Do Prazo</option>
                                <option value="4">Liquidado</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-12">
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
            <div class="h5 pd-20 mb-0">Documento</div>
            <table
                class="table hover data-table-report nowrap"
            >
                <thead>
                    
                    <tr>
                        <th>NO.</th>
                        <th class="table-plus datatable-nosort">Cliente - Nome</th>
                        <th class="table-plus datatable-nosort">Documento - Total</th>
                        <th>Total - Pago</th>
                        <th><span class="icon-copy ti-menu-alt"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                        <tr>
                            <td class="table-plus">{{$item->type}} {{$item->number}}</td>
                            <td>{{(empty($item->client_id))?"Consumidor Final":$item->clients->name}}</td>
                            <td>{{number_format($item->amount_gross,2,",",".")}}</td>
                            <td>{{number_format($item->payments()->sum("amount"),2,",",".") }}</td>
                            <td>
                                <a
                                    href="#"
                                    class="btn-block"
                                    data-toggle="modal"
                                    data-target="#modal-id{{$item->id}}"
                                    type="button"
                                >
                                    <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <div
                            class="modal fade bs-example-modal-lg"
                            id="modal-id{{$item->id}}"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="modal-{{$item->id}}"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <form action="{{route("payments.update",$item->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modal-{{$item->id}}">
                                                Factura Aberta {{$item->number}}
                                            </h4>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-hidden="true"
                                            >
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="invoice-desc">
                                                        <div class="invoice-desc-head clearfix">
                                                            <div class="invoice-sub">Descrição</div>
                                                            <div class="invoice-rate">Montante</div>
                                                        </div>
                                                        <div class="invoice-desc">

                                                            @foreach ($item->payments()->get() as $itens)
                                                                <ul>
                                                                    <li class="clearfix">
                                                                        <div class="invoice-sub">{{$itens->title}}</div>
                                                                        <div class="invoice-rate">{{ number_format($itens->amount,2,",",".") }}</div>
                                                                    </li>
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="col-lg-12">
                                                        <div class="col-xl-12 col-lg-12 col-md-12 mb-20">
                                                            <div class="card-box height-100-p widget-style3">
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="widget-data">
                                                                        <?php
                                                                        $total_d=-1*$item->amount_gross+$item->payments()->sum("amount")
                                                                        ?>
                                                                        <div class="weight-700 font-24 text-dark"> {{number_format($total_d,0,".")}} </div>
                                                                        <div class="font-14 text-secondary weight-500">
                                                                            Total Dividas
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-icon">
                                                                        <div class="icon" data-color="#00eccf">
                                                                            <i class="icon-copy dw dw-money"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 mb-20">
                                                            <div class="card-box height-100-p widget-style3">
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="widget-data">
                                                                        <div class="weight-700 font-24 text-dark">{{number_format($item->payments()->sum("amount"),0,".")}}</div>
                                                                        <div class="font-14 text-secondary weight-500">
                                                                            Total Pago
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-icon">
                                                                        <div class="icon" data-color="#ff5b5b">
                                                                            <span class="icon-copy fa fa-bank"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (empty($item->pay))
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Titulo do Pagamento</label>
                                                                <input type="text" value="Pagamento Parcelado {{$item->payments()->count()+1}}" name="title" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>FORMA DE PAGAMENTO</label>
                                                                <select
                                                                    id="method_id"
                                                                    class="custom-select2 form-control"
                                                                    name="method_id"
                                                                    style="width: 100%; height: 38px">
                                                                    @foreach ($methods as $method)
                                                                        <option value="{{$method->id}}">{{$method->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="{{$data = (empty($item->payments()->sum("amount"))?$item->payments()->sum("amount") : 0 )}}" >Montante</label>
                                                                <input type="text" class="form-control" value="" name="amount">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">
                                                FECHAR
                                            </a>
                                            @if (empty($item->pay))
                                            <button type="submit" class="btn btn-primary">
                                                PAGAR   <i class="fa fa-plus"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $('document').ready(function(){
            $('.data-table-report').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "info": "_START_-_END_ of _TOTAL_ entries",
                    searchPlaceholder: "Search",
                    paginate: {
                        next: '<i class="ion-chevron-right"></i>',
                        previous: '<i class="ion-chevron-left"></i>'  
                    }
                },
            });
        });
    </script>

        
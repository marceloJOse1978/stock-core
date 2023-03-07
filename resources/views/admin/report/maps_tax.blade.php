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
        <!-- Form grid Start -->
        <div class="row pb-10">
            <div class="col-xl-12 col-lg-12 col-md-12 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"> 
                                {{number_format($total,2)}} 
                            </div>
                            <div class="font-14 text-secondary weight-500">
                                TOTOAL
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
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Capo de Busca</h4>
                    <p class="mb-30">Filtro de Pesquisa</p>
                </div>
            </div>
                <form action="{{url("reports/core/maps_tax")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <label for="">Ano</label>
                            <div class="form-group">
                               <select name="date_init" id="" class="form-control">
                                    @for ($i = 0; $i < 10 ; $i++)
                                        <option value="{{date("Y")-$i}}">{{date("Y")-$i}}</option>
                                    @endfor
                               </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="">Mês</label>
                            <div class="form-group">
                               <select name="date_end" id="" class="form-control">
                                   <option value="1">Janeiro</option>
                                   <option value="2">Fevereiro</option>
                                   <option value="3">Março</option>
                                   <option value="4">Abril</option>
                                   <option value="5">Maio</option>
                                   <option value="6">Junho</option>
                                   <option value="7">Julho</option>
                                   <option value="8">Agosto</option>
                                   <option value="9">Setembro</option>
                                   <option value="10">Outubro</option>
                                   <option value="11">Novembro</option>
                                   <option value="12">Dezembro</option>
                               </select>
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
        
        <div class="pd-20 card-box mb-30">
            <div class="h5 pd-20 mb-0">Mapa de Imposto </div>
            <table
                class="table hover multiple-select-row data-table-export nowrap"
            >
                <thead>
                    
                    <tr>
                        <th>NO.</th>
                        <th class="table-plus datatable-nosort">Cliente </th>
                        <th class="table-plus datatable-nosort">Taxa</th>
                        <th class="table-plus datatable-nosort">IVA/C</th>
                        <th>Usuário</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                        @if (!empty($item->document_id))
                            <tr>
                                <td class="table-plus">{{$item->documents->type." ".$item->documents->number}}</td>
                                <td>{{(empty($item->documents->clients->name))?"Consumidor Final" : $item->documents->clients->name}}</td>
                                <td>{{$item->percent}}%</td>
                                <td>{{number_format($item->total,2,".",",")}}</td>
                                <td>{{$item->documents->users->name}}</td>
                                <td>{{$item->date}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        
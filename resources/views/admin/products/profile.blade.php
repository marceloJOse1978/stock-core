<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Perfil - {{$title}}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{url("/")}}">Home</a>
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
                                src="{{(!empty($row->pic_path))? url("public/storage/products/$row->pic_path") : url("public/img/empty.png")}}"
                                alt=""
                                style="width:150px; max-height:150px ;"
                                class="avatar-photo"
                            />
                        </div>
                        <h5 class="text-center h5 mb-0">{{$row->title}}</h5>
                        <p class="text-center text-muted font-14">
                           {{$row->description}}
                        </p>
                        {{-- <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Informação</h5>
                            <ul>
                                <li>
                                    <span>Preço do Fornecedor:</span>
                                    {{$row->supply_price}}
                                </li>
                                <li>
                                    <span>Preço:</span>
                                    {{$row->gross_price}}
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a
                                            class="nav-link active"
                                            data-toggle="tab"
                                            href="#setting"
                                            role="tab"
                                            >Informação</a
                                        >
                                        <li class="nav-item">
                                            <a
                                                class="nav-link"
                                                data-toggle="tab"
                                                href="#tasks"
                                                role="tab"
                                                >Stock</a
                                            >
                                        </li>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    
                                    <!-- Setting Tab start -->
                                    <div
                                        class="tab-pane fade show active"
                                        id="setting"
                                        role="tabpanel">
                                        <div class="profile-setting">
                                            <div class="container pd-0">
                                                {{-- tabela de Stock --}}
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                                                    <!-- basic table  Start -->
                                                    <div class="pd-20 card-box mb-30">
                                                        <div class="clearfix mb-20">
                                                            <div class="pull-left">
                                                                <h4 class="text-blue h4">Informação</h4>
                                                            </div>
                                                        </div>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Referencia:</th>
                                                                    <th scope="col">{{$row->reference}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">Codigo de Barra:</th>
                                                                    <th scope="col">{{$row->barcode}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">Nome:</th>
                                                                    <th scope="col">{{$row->title}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">Taxa de Imposto:</th>
                                                                    <th scope="col">{{$row->tax_id}}%</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">Preço do Fornecedor:</th>
                                                                    <th scope="col">{{number_format($row->supply_price,2)}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">Preço:</th>
                                                                    <th scope="col">{{number_format($row->gross_price,2)}}</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                    
                                    <!-- Tasks Tab start -->
                                    <div class="tab-pane fade" 
                                    id="tasks" 
                                    role="tabpanel">
                                        <div class="pd-20 profile-task-wrap">
                                            <div class="container pd-0">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                                                    <!-- basic table  Start -->
                                                    <div class="pd-20 card-box mb-30">
                                                        <div class="clearfix mb-20">
                                                            <div class="pull-left">
                                                                <h4 class="text-blue h4">Movimento de Stock</h4>
                                                            </div>
                                                        </div>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Origem</th>
                                                                    <th scope="col">Descrição</th>
                                                                    <th scope="col">QTD</th>
                                                                    <th scope="col">Move</th>
                                                                    <th scope="col">PVP</th>
                                                                    <th scope="col">Custo</th>
                                                                    <th scope="col">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($rows as $item)
                                                                <tr>
                                                                    <th scope="row">{{$index++}}</th>
                                                                    <td>{{ (empty($item->document_id))? "Inicio" : $item->documents->type." ".$item->documents->number }}</td>
                                                                    <td>{{$item->title}}</td>
                                                                    <td>{{$item->qty}} {{$item->units->title}}</td>
                                                                    @if (!empty($item->move))
                                                                    <td><span class="badge badge-primary">Entrada</span></td>
                                                                    @else
                                                                    <td><span class="badge badge-danger">Saída</span></td>
                                                                    @endif
                                                                    <td>{{number_format($item->net_total)}}</td>
                                                                    <td>{{number_format($item->gross_total)}}</td>
                                                                    <td>{{number_format($item->net_total*$item->qty)}}</td>
                                                                </tr>
                                                                @endforeach
                                                                {{-- <tr>
                                                                    <th scope="row">3</th>
                                                                    <td>Larry</td>
                                                                    <td>the Bird</td>
                                                                    <td>@twitter</td>
                                                                </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- basic table  End -->                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tasks Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
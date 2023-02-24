<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Perfil - {{$title}}</h4>
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
                                RECURSO
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">COMPRAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-10">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"> {{$entrada}} </div>
                                <div class="font-14 text-secondary weight-500">
                                    ENTRADA
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
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{$saida}}</div>
                                <div class="font-14 text-secondary weight-500">
                                    SAÍDA
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
                <div class="col-xl-4 col-lg-4 col-md-12 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{$stock}}</div>
                                <div class="font-14 text-secondary weight-500">
                                    Total
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
            </div>
            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            <a
                                href="modal"
                                data-toggle="modal"
                                data-target="#modal"
                                class="edit-avatar"
                                ><i class="fa fa-profile"></i
                            ></a>
                            <img
                                src="{{(!empty($product->pic_path))? url("public/storage/products/$product->pic_path") : url("public/img/empty.png")}}"
                                alt=""
                                class="avatar-photo"
                            />
                        </div>
                        <h5 class="text-center h5 mb-0">{{$product->title}}</h5>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Informação Produto</h5>
                            <ul>
                                <li>
                                    <span>Referencia:</span>
                                    {{$product->reference}}
                                </li>
                                <li>
                                    <span>Codígo de Barra:</span>
                                    {{$product->barcode}}
                                </li>
                                <li>
                                    <span>Unidade:</span>
                                    {{$product->units->title}}
                                </li>
                                <li>
                                    <span>Imposto:</span>
                                    {{$product->tax_id}}%
                                </li>
                                <li>
                                    <span>Descrição:</span>
                                    {{$product->description}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
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
									<th scope="col">Total</th>
								</tr>
							</thead>
							<tbody>
                                @foreach ($rows as $item)
								<tr>
									<th scope="row">{{$index++}}</th>
									<td>{{ (empty($item->document_id))? "De Fornecedor" : $item->documents->type." ".$item->documents->number }}</td>
									<td>{{$item->title}}</td>
									<td>{{$item->qty}} {{$item->units->title}}</td>
                                    @if (!empty($item->move))
                                    <td><span class="badge badge-primary">Entrada</span></td>
                                    @else
                                    <td><span class="badge badge-danger">Saída</span></td>
                                    @endif
									<td>{{number_format($item->net_total)}}</td>
                                    @if (!empty($item->move))
									<td>{{number_format($item->net_total*$item->qty)}}</td>
                                    @else
									<td>{{number_format($item->net_total*$item->qty*-1)}}</td>
                                    @endif
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
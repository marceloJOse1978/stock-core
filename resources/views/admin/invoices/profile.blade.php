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
            <div class="invoice-wrap">
                <div class="invoice-box">
                    <div class="invoice-header">
                        <div class="logo text-center">
                            <img src="vendors/images/deskapp-logo.png" alt="" />
                        </div>
                    </div>
                    <h4 class="text-center mb-30 weight-600">{{$title}}</h4>
                    <div class="row pb-30">
                        <div class="col-md-6">
                            <h5 class="mb-15">{{$info->name_bs}}</h5>
                            
                            <p class="font-14 mb-5">
                                No: <strong class="weight-600">{{$collection->number}}</strong>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                <p class="font-14 mb-5">{{$info->nif}}</p>
                                <p class="font-14 mb-5">{{$info->address_bs}}</p>
                                <p class="font-14 mb-5">{{$info->phone_bs}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-desc pb-30">
                        <div class="invoice-desc-head clearfix">
                            <div class="invoice-sub">Descrição</div>
                            <div class="invoice-rate">QTD</div>
                            <div class="invoice-hours">CUSTO</div>
                            <div class="invoice-subtotal">TOTAL</div>
                        </div>
                        <div class="invoice-desc-body">
                            <ul>
                                @foreach ($collection->other_items as $item)
                                    <li class="clearfix">
                                        <div class="invoice-sub">{{$item->title}}</div>
                                        <div class="invoice-rate">{{$item->qty}}</div>
                                        <div class="invoice-hours">{{number_format($item->pvp,2,",",".")}}</div>
                                        <div class="invoice-subtotal">
                                            <span class="weight-600">{{number_format($item->cost,2,",",".")}}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="invoice-desc-footer">
                            <div class="invoice-desc-head clearfix">
                                <div class="invoice-rate">Deconto</div>
                                <div class="invoice-subtotal">Total</div>
                            </div>
                            <div class="invoice-desc-body">
                                <ul>
                                    <li class="clearfix">
                                        <div class="invoice-rate font-20 weight-600">
                                            {{number_format($collection->discount,2,".",",")}}
                                        </div>
                                        <div class="invoice-subtotal">
                                            <span class="weight-600 font-24 text-danger"
                                                >{{number_format($collection->gross_total,2,".",",")}}</span
                                            >
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (empty($invoice->status))
<form action=" {{url("stocks/".$invoice->id)}} " method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
@endif
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
                        
                        <a class="btn btn-primary"
                            href="javascript:;"
                            data-toggle="right-sidebar"
                        >
                            <i class="icon-copy fa fa-gears"></i> Configurar
                        </a>
                    </div>
                </div>
            </div>
            <div class="right-sidebar items">
                <div class="sidebar-title">
                    <h3 class="weight-600 font-16 text-blue">
                        Configurar Factura
                    </h3>
                    <div class="close-sidebar" data-toggle="right-sidebar-close">
                        <i class="icon-copy ion-close-round"></i>
                    </div>
                </div>
                <div class="right-sidebar-body customscroll">
                    <div class="right-sidebar-body-content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Numero da {{$title}}</label>
                                    <input type="text" name="number" value="{{$invoice->number}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Fornecerdor</label>
                                    <select
                                        class="custom-select2 form-control"
                                        name="provider_id"
                                        style="width: 100%; height: 38px">
                                        <option value="{{ $retVal = (empty($invoice->providers->id)) ? null : $invoice->providers->id }}" >-- {{$retVal = (empty($invoice->providers->id)) ? "Seleciona um Fornecedor" : $invoice->providers->name}} --</option>
                                        @foreach ($clients as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Desconto</label>
                                    <input type="text" name="discount" class="form-control" value="{{$invoice->discount}}">
                                    <span>*se for em persentagem coloque % no final exemplo:5%</span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Referencia</label>
                                    <input type="text" class="form-control" name="external_reference" value="{{$invoice->external_reference}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea class="form-control" name="observations" id="" cols="30" rows="10">{{$invoice->observations}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row pb-10">
                    <div class="col-md-8">
                        <!-- Default Basic Forms Start -->
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix">
                                <div class="pull-left">
                                <h4 class="text-blue h4">{{$title}}</h4>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Qtd</th>
                                        <th scope="col">P. Unidade</th>
                                        <th scope="col">Total</th>
                                        @if (empty($invoice->status))
                                            <th scope="col">remover</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock as $item)
                                        <tr>
                                            <td scope="row">{{$item->title}}</td>
                                            <td scope="row">{{$item->qty}}</td>
                                            <td scope="row">{{number_format($item->pvp, 2, ',', '.')}}</td>
                                            <td scope="row">{{number_format($item->cost, 2, ',', '.')}}</td>
                                            @if (empty($invoice->status))
                                                <td scope="row">
                                                    <a href="{{url("itens/$item->id")}}" style=" border: hidden;"  data-color="#e95959"><i style="font-size: 20px" class="icon-copy fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (empty($invoice->status))
                        
                    @endif
                    <div class="col-md-4">
                        <!-- Default Basic Forms Start -->
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h4">{{$title}}</h4>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>QTD</label>
                                    <input type="text" name="qty" id="qty" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Preço por Unidade</label>
                                    <input type="text" name="pvp" id="pvp" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Preco Total </label>
                                    <input type="text" name="cost" id="total" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Preço do Item </label>
                                    <input type="text" name="amount" class="form-control">
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Aviso de Stock</label>
                                    <input type="text" class="form-control" name="stockAlert" value="2">
                                </div>
                            </div>
                        </div>
                        @if (empty($invoice->status))
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">SALVA</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>
                        @if (empty($invoice->status))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="reset-options pt-30 text-center">
                                        <a href="{{url("stocks/$invoice->id")}}" class="btn btn-danger" id="reset-settings">
                                            FINALIZAR COMPRA
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="row">
                            <div class="col-md-12">
                                <div class="reset-options pt-30 text-center">
                                    <a href="{{url("stocks/$invoice->id")}}" class="btn btn-danger" id="reset-settings">
                                        EMITIR DOCUMENTO
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{-- <div class="row reset-options pt-30">
                            <div class="col-md-8">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">{{number_format($gross_total, 2, ',', '.')}}</th>
                                        </tr>
                                        <tr>
                                            <th scope="col">Desconto @if (!empty($percn)) ({{explode(" ",$percn)[0].explode(" ",$percn)[1]}}) @endif</th>
                                            <th scope="col">
                                                {{number_format($discounts, 2, ',', '.')}} 
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="col">Total</th>
                                            <th scope="col">{{number_format($total, 2, ',', '.')}}</th>
                                        </tr>
                                    </thead>
                                </table>                   
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@if (empty($invoice->status))
</form>
@endif
<script>
    $("#payment").change(function (e) { 
        e.preventDefault();
        if ($('#payment').is(':checked')) {
            $("#payment_input").css("display","none");
        }else{
            $("#payment_input").css("display","block");
        }
    });
    if ($('#payment').is(':checked')) {
        $("#payment_input").css("display","none");
    }else{
        $("#payment_input").css("display","block");
    }
    $("#total").focus(function (e) { 
       var qty = $("#qty").val();
       var pvp = $("#pvp").val();
       $("#total").val(qty*pvp);
        
    });
</script>
        
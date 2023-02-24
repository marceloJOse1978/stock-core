<form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
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
            <div class="row pb-10" data-toggle="buttons">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="select-role">
                        <div class="btn-group btn-group-toggle" >
                            <label class="btn ">
                                <input 
                                    type="radio"
                                    @if ($data->type=="RG")
                                        checked
                                    @endif
                                    name="type" 
                                    value="RG"  
                                />
                                <div class="icon">
                                    <img
                                        src="{{url("public/vendors/images/briefcase.svg")}}"
                                        class="svg"
                                        alt=""
                                    />
                                </div>
                                <span>Recibo</span>
                                Emitir Recibo Geral
                            </label>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="select-role">
                        <div class="btn-group btn-group-toggle" >
                            <label class="btn ">
                                <input type="radio" name="type" id="type" value="FT"  />
                                <div class="icon">
                                    <img
                                        src="{{url("public/vendors/images/briefcase.svg")}}"
                                        class="svg"
                                        alt=""
                                    />
                                </div>
                                <span>Factura</span>
                                Emitir Factura Normal
                            </label>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="select-role">
                        <div class="btn-group btn-group-toggle" >
                            <label class="btn">
                                <input 
                                    type="radio" 
                                    name="type" 
                                    id="type"  
                                    value="FP" 
                                    @if ($data->type=="FP")
                                        checked
                                    @endif  
                                />
                                <div class="icon">
                                    <img
                                        src="{{url("public/vendors/images/briefcase.svg")}}"
                                        class="svg"
                                        alt=""
                                    />
                                </div>
                                <span>Pro Forma</span>
                                Emitir Factura Pro Forma
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="select-role">
                        <div class="btn-group btn-group-toggle" >
                            <label class="btn ">
                                <input 
                                    type="radio" 
                                    name="type" 
                                    value="NE"
                                    @if ($data->type=="NE")
                                        checked
                                    @endif  
                                />
                                <div class="icon">
                                    <img
                                        src="{{url("public/vendors/images/briefcase.svg")}}"
                                        class="svg"
                                        alt=""
                                    />
                                </div>
                                <span>Nota de Entrega</span>
                                Emitir Nota de Entraga
                            </label>
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
                                
                                <div class="btn-list">
                                    <a 
                                        href="javascript:;"
                                        data-toggle="right-sidebar"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success btn-lg btn-block"
                                        >
                                        ITEMS
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="right-sidebar items">
                                <div class="sidebar-title">
                                    <h3 class="weight-600 font-16 text-blue">
                                        ITEMS
                                    </h3>
                                    <div class="close-sidebar" data-toggle="right-sidebar-close">
                                        <i class="icon-copy ion-close-round"></i>
                                    </div>
                                </div>
                                <div class="right-sidebar-body customscroll">
                                    <div class="right-sidebar-body-content">
                                        <div class="form-group mb-0">
                                            <input
                                                type="text"
                                                class="form-control search-input"
                                                placeholder="Pesquisar..."
                                                id="peq-like"
                                            />
                                        </div>
                                        <br>
                                        <br>
                                        <div id="iten"></div>
                                    </div>
                                </div>
                            </div>
                            <table class="table data-table-doc">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Qtd</th>
                                        <th>IVA/C</th>
                                        <th>Desconto</th>
                                        <th>P. Unidade</th>
                                        <th>Total</th>
                                        <th>remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Referencia</label>
                                    <input type="text" class="form-control" id="external_reference" name="external_reference"  value="{{$data->external_reference}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea class="form-control" id="observations" name="observations" id="" cols="30" rows="10">{{$data->observations}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="faq-wrap">
                            <h4 class="mb-20 h4 text-blue">CONFIGURAÇÃO DO DOCUMENTO</h4>
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#"
                                            class="btn btn-block"
                                            data-toggle="collapse"
                                            data-target="#faq1"
                                        >
                                            NOº DOCUMENTO
                                        </a>
                                    </div>
                                    <div id="faq1" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Número do {{$title}}</label>
                                                        <input id="number" type="text" name="number" value="{{$elements["document"]}}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#"
                                            class="btn btn-block collapsed"
                                            data-toggle="collapse"
                                            data-target="#faq2"
                                        >
                                            CLIENTE
                                        </a>
                                    </div>
                                    <div id="faq2" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Cliente</label>
                                                        <select
                                                            id="client_id"
                                                            class="custom-select2 form-control"
                                                            name="client_id"
                                                            style="width: 100%; height: 38px">
                                                            <option value="{{$data->client_id}}">-- {{ (empty($data->client_id)) ? "Consumidor Final" : $data->clients->name }} --</option>
                                                            <option value="0">Consumidor Final</option>
                                                            @foreach ($clients as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#"
                                            class="btn btn-block collapsed"
                                            data-toggle="collapse"
                                            data-target="#faq3"
                                        >
                                            DATA DO DOCUMENTO
                                        </a>
                                    </div>
                                    <div id="faq3" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            {{-- ITEMS --}}
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Data</label>
                                                        <input id="date" type="date" class="form-control" name="date" value="{{$data->date}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Data de Vencimento</label>
                                                        <input type="date" id="date_due" class="form-control" name="date_due" value="{{$data->date_due}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#"
                                            class="btn btn-block collapsed"
                                            data-toggle="collapse"
                                            data-target="#faq4"
                                        >
                                            DESCONTOS
                                        </a>
                                    </div>
                                    <div id="faq4" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            {{-- ITEMS --}}
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Desconto</label>
                                                        <input id="discount" type="text" value="{{$data->discount}}" name="discount" class="form-control">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#"
                                            class="btn btn-block collapsed"
                                            data-toggle="collapse"
                                            data-target="#faq5"
                                        >
                                            PAGAMENTO
                                        </a>
                                    </div>
                                    <div id="faq5" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <label class="col-sm-12 col-md-12 col-form-label">Pago</label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input
                                                        id="pay"
                                                        type="checkbox"
                                                        @if (!empty($data->pay))
                                                            checked
                                                        @endif
                                                        class="switch-btn"
                                                        name="pay"
                                                        value="1"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row" id="method">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>FORMA DE PAGAMENTO</label>
                                                        <select
                                                            id="method_id"
                                                            class="custom-select2 form-control"
                                                            name="method_id"
                                                            style="width: 100%; height: 38px">
                                                            @foreach ($methods as $item)
                                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-list">
                                    <a 
                                        href="javascript:;"
                                        class="save"
                                    >
                                        <button
                                            id="finalize"
                                            type="button"
                                            class="btn btn-danger btn-lg btn-block"
                                        >
                                            EMITIR DOCUMENTO
                                        </button>
                                    </a>
                                    <a 
                                        href="{{route("documents.index")}}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success btn-lg btn-block"
                                        >
                                            NOVO DOCUMENTO
                                        </button>
                                    </a>
                                </div>
                                <div class="row reset-options pt-30">
                                    <div class="col-md-8">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sub Total</th>
                                                    <th scope="col" id="sub">0,00</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Desconto </th>
                                                    <th scope="col" id="des">
                                                        0,00 
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">IVA/C</th>
                                                    <th scope="col" id="iva">0,00</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Total</th>
                                                    <th scope="col" id="total">0,00</th>
                                                </tr>
                                            </thead>
                                        </table>                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- PAU PARA TODAS OBRAS START --}}
<div
    class="modal fade bs-example-modal-lg"
    id="modal-all"
    tabindex="-1"
    role="dialog"
    aria-labelledby="all"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="all">
                   {{-- titulo gerar automatico --}}
                </h4>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-hidden="true"
                >
                    <i class="icon-copy fa fa-close" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                {{-- CONTEUDO DO VERSOR --}}
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    SAIR
                </button>
                <div id="save">
                    <a href="#" id="" class="btn btn-primary">
                        SALVAR
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- PAU PARA TODAS OBRAS END --}}
<script src="{{asset("js/document-init.js")}}"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* TABELA DE ITEM START */
        function dataTables() {
            $('.data-table-doc').DataTable({
                responsive: true,
                searching: false,
                bLengthChange: false,
                bPaginate: true,
                bInfo: false,
                processing: true,
                ajax:"{{url('document')}}",
                dataSrc: 'data',
                columns: [
                    { data: 'title' },
                    { data: 'qtd' },
                    { data: 'impost' },
                    { data: 'discount_for_itens' },
                    { data: 'net_total' },
                    { data: 'gross_total' },
                    { data: 'action' }
                ],
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
        }


        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: "{{url('itens')}}",
                dataType: "text",
                success: function (response) {
                    $("#iten").html(response);
                }
            });
            dataTables();
            total();
            items("");
            e.preventDefault();
            if ($("#pay").is(":checked") == false) {
                $("#method").css("display", "none");
            } 
            if ($("#pay").is(":checked") == true) {
                $("#method").css("display", "block");
            }
        });
    /* TABELA DE ITEM END */
   


    $("#pay").change(function (e) { 
        e.preventDefault();
        if ($("#pay").is(":checked") == false) {
            $("#method").css("display", "none");
        } 
        if ($("#pay").is(":checked") == true) {
            $("#method").css("display", "block");
        }
    });











    /* --- PESQUISAR POR PRODUTO START --- */
    

  
    
    $("#peq-like").keyup(function (e) { 
        items($(this).val());
    });





    function items(like=null) { 
        if (like=="") {
            like=0
        }
        $.ajax({
            type: "GET",
            url: "{{url('itens')}}/"+like,
            dataType: "text",
            success: function (response) {
                $("#iten").html(response);
            }
        });
    }





    /* --- PESQUISAR POR PRODUTO END --- */




    /* REGISTRAR NOVO ITEM START */
    $('body').on('click', '.itens', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "{{url('itens/create')}}/"+id,
            data: $('form').serialize(),
            dataType: "text",
            success: function (response) {
                console.log(response);
                localStorage.setItem("document_id",response.document_id);
                total();
                $('.data-table-doc').DataTable().ajax.reload();
                success("REGISTRAR ITENS");
            }
        });
    });
    /* REGISTRAR NOVO ITEM END */

    /* MODEL SHOW DE ALL START */


    /* SETTING ITENS START */
    $('body').on('click', '.setting-itens', function () {
        var id = $(this).data("setting");
        $('#modal-all').modal("show");
        /* BUSCAR O FORMULARIO */
        $.ajax({
            type: "GET",
            url: "{{url('itens')}}/"+id+"/setting",
            data: $('form').serialize(),
            dataType: "text",
            success: function (response) {
               $(".modal-body").html(response);
               $("#save").html('<a href="#" id="save-itens" class="btn btn-primary">SALVAR ITENS</a>');
            }
        });
    });
    /* SETTING ITENS END */



    /* MODEL SHOW DE ALL END */






    /* SEND CONTROLLER FOR CONTROLLER START */
    $('body').on('click', '#save-itens', function () {
        var id =$("#product_id").val();
        $.ajax({
            type: "GET",
            url: "{{url('itens/create')}}/"+id,
            data:{
                client_id:$("#client_id").val(),
                type:$("input[name='type']:checked").val(),
                product_id:$("#product_id").val(),
                qty:$("#qty").val(),
                gross_total:$("#gross_total").val(),
                discount_for_itens:$("#discount_for_itens").val(),
                number:$("#number").val(),
                date:$("#date").val(),
                pay:$("#pay").val(),
                date_due:$("#date_due").val(),
                method_id:$("#method_id").val(),
                discount:$("#discount").val(),
                observations:$("#observations").val(),
                external_reference:$("#external_reference").val(),
            },
            dataType: "text",
            success: function (response) {
                console.log(response);
                localStorage.setItem("document_id",response.document_id);
                total();
                $('.data-table-doc').DataTable().ajax.reload();
                success("REGISTRAR ITENS");
            }
        });
    });
    /* SEND CONTROLLER FOR CONTROLLER END */


    /* APAGAR ITENS START */
    $("body").on("click",".delete-itens", function () {
        var url = $(this).data("url");;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "TEXT",
            success: function (response) {
                $('.data-table-doc').DataTable().ajax.reload();
                total()
                success("DADOS REMOVIDOS");
            }
        });
    });
    /* APAGAR ITENS END */

    /* BOTÃO DE EMISSÃO START */
    $("#finalize").click(function (e) { 
        e.preventDefault();
        if (confirm("Este Documento não poder ser eliminado tem certeza ?")==true) {
            
            $.ajax({
                type: "GET",
                url: "{{route('finalize',$elements['id'])}}",
               data:{
                    client_id:$("#client_id").val(),
                    type:$("input[name='type']:checked").val(),
                    number:$("#number").val(),
                    date:$("#date").val(),
                    pay:$("#pay").val(),
                    method_id:$("#method_id").val(),
                    date_due:$("#date_due").val(),
                    discount:$("#discount").val(),
                    observations:$("#observations").val(),
                    external_reference:$("#external_reference").val(),
                },
                dataType: "TEXT",
                success: function (response) {
                    $('.data-table-doc').DataTable().ajax.reload();
                    total();
                    window.open("{{route('document.emission',$elements['id'])}}",'_blank');
                }
            });
        }
        
    });
    /* BOTÃO DE EMISSÃO END */





});

function success (message) {
        Lobibox.notify('success', {
            title: 'GRAVADO',
            msg:message
        });
    }
    function error (message="PROBLEMA AO ENVIAR") {
        Lobibox.notify('error', {
            title: 'ERRO',
            msg: message
        });
    }

    function total() { 
        $.ajax({
            type: "GET",
            url: "{{route('document')}}",
            dataType: "JSON",
            success: function (response) {
                $("#sub").text(response.total.sub);
                $("#des").text(response.total.discount);
                $("#iva").text(response.total.iva);
                $("#total").text(response.total.total);
            }
        });
    }
</script>

        
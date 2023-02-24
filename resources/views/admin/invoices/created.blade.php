<form action="{{route('invoices.store')}}" method="POST" enctype="multipart/form-data">
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
                                        CATALOGO
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
                                        <a 
                                            href="javascript:;"
                                        >
                                            <button
                                                type="button"
                                                data-toggle="modal"
									            data-target="#other_items"
                                                class="btn btn-success btn-lg btn-block"
                                            >
                                                OUTRO ITEM
                                            </button>
                                        </a>
                                        <br>
                                        <br>
                                        <div id="iten"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="modal fade"
                                id="other_items"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="other_itemModal"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="other_itemModal">
                                                OUTROS ITEMS
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
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-12 col-form-label">Referencia</label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        placeholder=""
                                                        name="reference"
                                                        id="reference"
                                                        
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-12 col-form-label">Titulo</label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        placeholder=""
                                                        name="title"
                                                        id="title"
                                                        
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-12 col-form-label">Quantidade</label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        placeholder=""
                                                        name="qty"
                                                        id="qty"
                                                        
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-12 col-form-label">Unidade</label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        placeholder=""
                                                        name="unit"
                                                        id="unit"
                                                        
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-12 col-form-label">Desconto</label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        placeholder=""
                                                        name="discount_for_itens"
                                                        id="discount_for_itens"
                                                        
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-12 col-form-label">Imposto de Iva</label>
                                                <div class="col-sm-12 col-md-12">  
                                                    <select class="form-control" name="tax" id="tax">
                                                        <option value="14">Padrão do Sistema</option>
                                                        <option value="5">5% IVA</option>
                                                        <option value="7">7% IVA</option>
                                                        <option value="14">14% IVA</option>
                                                        <option value="27">27% IVA</option>
                                                        <option value="0">ISENTO DE IVA</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-12 col-form-label">Preço</label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        placeholder=""
                                                        name="gross_total"
                                                        id="gross_total"
                                                        
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-dismiss="modal"
                                            >
                                                FECHAR
                                            </button>
                                            <button type="button" id="other_item" class="btn btn-primary">
                                               CRIAR
                                            </button>
                                        </div>
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
                                    <input type="text" class="form-control" id="external_reference" name="external_reference" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea class="form-control" id="observations" name="observations" id="" cols="30" rows="10"></textarea>
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
                                            Fornecedor
                                        </a>
                                    </div>
                                    <div id="faq2" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Fornecedor</label>
                                                        <select
                                                            id="provider_id"
                                                            class="custom-select2 form-control"
                                                            name="provider_id"
                                                            style="width: 100%; height: 38px">
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
                                                        <input id="date" type="date" class="form-control" name="date" value="{{date("Y-m-d")}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Data de Vencimento</label>
                                                        <input type="date" id="date_due" class="form-control" name="date_due">
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
                                                        <input id="discount" type="text" name="discount" class="form-control">
                                                        <span>*se for em persentagem coloque % no final exemplo:5%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="pay" value="1">
                                <div class="btn-list">
                                    <button
                                        id="finalize"
                                        type="submit"
                                        class="btn btn-danger btn-lg btn-block"
                                    >
                                        EMITIR DOCUMENTO
                                    </button>
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
            <div class="modal-body" id="modal-body">
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
                    <a href="#"  class="btn btn-primary">
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
                ajax:"{{route('table.invoice')}}",
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
                url: "{{route('itens.invoice')}}",
                dataType: "text",
                success: function (response) {
                    $("#iten").html(response);
                }
            });
            total();
            dataTables();
            items("");
        });
    /* TABELA DE ITEM END */
   














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
            url: "{{url('invoice/item/')}}/"+like,
            dataType: "text",
            success: function (response) {
                $("#iten").html(response);
            }
        });
    }





    /* --- PESQUISAR POR PRODUTO END --- */




    /* REGISTRAR NOVO ITEM START */
    $('body').on('click', '#other_item', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "{{url('invoice')}}/0/created",
            data: $('form').serialize(),
            dataType: "text",
            success: function (response) {
                console.log(response);
                total();
                $("#reference").val("");
                $("#title").val("");
                $("#qty").val("");
                $("#unit").val("");
                $("#discount_for_itens").val("");
                $("#gross_total").val("");

                items($("#peq-like").val());
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
            url: "{{url('invoice')}}/"+id+"/stock",
            data: $('form').serialize(),
            dataType: "text",
            success: function (response) {
               $("#modal-body").html(response);
               items($("#peq-like").val());
               $("#save").html('<a href="#" id="save-itens" class="btn btn-primary">SALVAR ITENS</a>');
            }
        });
    });
    /* SETTING ITENS END */



    /* MODEL SHOW DE ALL END */






    /* SEND CONTROLLER FOR CONTROLLER START */
    $('body').on('click', '#save-itens', function () {
        var id =$("#product_id_O").val();
        $.ajax({
            type: "GET",
            url: "{{url('invoice')}}/"+id+"/created",
            data:{
                provider_id:$("#provider_id").val(),
                product_id:$("#product_id_O").val(),
                qty:$("#qty_O").val(),
                tax:$("#tax_O").val(),
                gross_total:$("#gross_total_O").val(),
                discount_for_itens:$("#discount_for_itens_O").val(),
                number:$("#number").val(),
                date:$("#date").val(),
                pay:$("#pay").val(),
                date_due:$("#date_due").val(),
                discount:$("#discount").val(),
                observations:$("#observations").val(),
                external_reference:$("#external_reference").val(),
            },
            dataType: "text",
            success: function (response) {
                console.log(response);
                items($("#peq-like").val());
                $('#modal-all').modal("hide");
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
                total();
                items($("#peq-like").val());
                success("DADOS REMOVIDOS");
            }
        });
    });





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
            url: "{{url('invoice/table')}}",
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
<script src="src/plugins/slick/slick.min.js"></script>
<script>
    jQuery(document).ready(function () {
        jQuery(".product-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            infinite: true,
            speed: 1000,
            fade: true,
            asNavFor: ".product-slider-nav",
        });
        jQuery(".product-slider-nav").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: ".product-slider",
            dots: false,
            infinite: true,
            arrows: false,
            speed: 1000,
            centerMode: true,
            focusOnSelect: true,
        });
        $("input[name='demo3_22']").TouchSpin({
            initval: 1,
        });
    });
</script>
<?php $_SESSION["invoice_id"]=null ?>
        
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Editação de {{$title}}</h4>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                      {{-- <h4 class="text-blue h4">{{$title}}</h4> --}}
                    </div>
                </div>
                <form action=" {{url("products/".$row->id)}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="pd-20 card-box mb-30">
                                <div class="clearfix">
                                    <div class="pull-left">
                                    {{-- <h4 class="text-blue h4">{{$title}}</h4> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Referencia</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder=""
                                            value="{{$row->reference}}"
                                            name="reference"
                                            
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Codigo de Barra</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder=""
                                            name="barcode"
                                            value="{{$row->barcode}}"
                                            
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nome</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder=""
                                            name="title"
                                            value="{{$row->title}}"
                                            
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Descrição</label>
                                    <div class="col-sm-12 col-md-10">
                                        <textarea class="form-control" name="description" id="" cols="30" rows="10"> {{$row->description}} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Tipo de Estoque</label>
                                    <div class="col-sm-12 col-md-10">  
                                        <select class="form-control" name="stock_type" id="stock_type">
                                            <option value="{{$row->stock_type}}">-- 
                                                    @switch($row->stock_type)
                                                    @case('A')
                                                        Armazém
                                                    @break
                                                    @case('AP')
                                                        APP
                                                    @break
                                                    @case('L')
                                                        Levantamento
                                                    @break
                                                    @case('S')
                                                        Sem Stock
                                                    @break
                                                @endswitch -- 
                                            </option>
                                            
                                            <option value="L">Levantamento</option>
                                            <option value="A">Armazém</option>
                                            <option value="AP">App</option>
                                            <option value="S">Sem Stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Imposto de Iva</label>
                                    <div class="col-sm-12 col-md-10">  
                                        <select class="form-control" name="tax_id" id="">
                                            <option value="{{$row->tax_id}}"> -- {{ $row->tax_id." IVA" }} --</option>
                                            <option value="Padrão do Sistema">Padrão do Sistema</option>
                                            <option value="5">5% IVA</option>
                                            <option value="7">7% IVA</option>
                                            <option value="14">14% IVA</option>
                                            <option value="27">27% IVA</option>
                                            <option value="0">ISENTO DE IVA</option>
                                        </select>
                                    </div>
                                </div>
            
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Categória</label>
                                    <div class="col-sm-12 col-md-10">  
                                        <select class="form-control category_id" name="category_id" >
                                            @if (isset($category_id->id))
                                                <option value="{{$category_id->id}}">-- {{$category_id->title}} --</option>
                                            @else
                                                <option value="0">Selecione uma Categória</option>
                                            @endif
                                            <option  value="">-- Criar Categória --</option>
                                            @foreach ($category as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Variação</label>
                                    <div class="col-sm-12 col-md-10">  
                                        <select class="form-control varient_id" name="variant_id" id="">
                                            @if (isset($variant_id->id))
                                                <option value="{{$variant_id->id}}">-- {{$variant_id->title}} --</option>
                                            @else
                                                <option value="0">Selecione uma Variação</option>
                                            @endif
                                            <option  value="">-- Criar Variação --</option>
                                            @foreach ($variant as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Marca</label>
                                    <div class="col-sm-12 col-md-10">  
                                        <select class="form-control brand_id" name="brand_id" id="">
                                            @if (isset($brand_id->id))
                                                <option value="{{$brand_id->id}}">-- {{$brand_id->title}} --</option>
                                            @else
                                                <option value="0">Selecione uma Marca</option>
                                            @endif
                                            <option  value="">-- Criar Marca --</option>
                                            @foreach ($brand as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Unidade</label>
                                    <div class="col-sm-12 col-md-10">  
                                        <select class="form-control" name="unit_id" id="">
                                            @if (isset($unit_id->id))
                                                <option value="{{$unit_id->id}}">-- {{$unit_id->title}} --</option>
                                            @else
                                                <option value="0">Selecione uma Unidade</option>
                                            @endif
                                            @foreach ($units as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Foto do Produto</label>
                                    <div class="col-sm-12 col-md-10">  
                                        <div class="custom-file">
                                            <input type="file" name="pic_path" class="custom-file-input" value="{{$row->pic_path}}">
                                            <label class="custom-file-label">Buscar Arquivo{{-- --{{$row->pic_path}}-- --}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="pd-20 card-box mb-30">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-form-label">Preço do Produto</label>
                                    <div class="col-sm-12 col-md-12">
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder=""
                                            name="supply_price"
                                            value=" {{$row->supply_price}} "
                                            id="total"
                                            
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-form-label">Preço</label>
                                    <div class="col-sm-12 col-md-12">
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder=""
                                            value=" {{$row->gross_price}} "
                                            name="gross_price"
                                            
                                        />
                                    </div>
                                </div>
                                <div id="stock_control" class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-form-label">Controle do Estoque</label>
                                    <div class="col-sm-12 col-md-12">
                                        <input
                                            @if (!empty($row->stock_control))
                                                checked
                                            @endif
                                            type="checkbox"
                                            class="switch-btn"
                                            name="stock_control"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- modal de criar Elementos Init--}}
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div
                            class="modal fade"
                            id="category_modal"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="myLargeModalLabel"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">
                                            Criar uma Categória
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
                                       
                                            <label class="col-sm-12 col-md-12 col-form-label">Titulo</label>
                                            <div class="col-sm-12 col-md-12">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    placeholder=""
                                                    name="title_category"
                                                    
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div
                            class="modal fade"
                            id="varient_modal"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="myLargeModalLabel2"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel2">
                                            Criar uma Variação
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
                                       
                                            <label class="col-sm-12 col-md-12 col-form-label">Titulo</label>
                                            <div class="col-sm-12 col-md-12">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    placeholder=""
                                                    name="title_variant"
                                                    
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div
                            class="modal fade"
                            id="brand_modal"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="myLargeModalLabel1"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel1">
                                            Criar uma Marca
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
                                       
                                            <label class="col-sm-12 col-md-12 col-form-label">Titulo</label>
                                            <div class="col-sm-12 col-md-12">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    placeholder=""
                                                    name="title_brand"
                                                    
                                                />
                                            </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- modal de criar Elementos End --}}
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    
    /* Controller de Modal -- init */
    $('.category_id').change(function (e) { 
        var valor =$(this).val()
        if (valor=="") {
            $('#category_modal').modal("show");
        }
    });
    $('.brand_id').change(function (e) { 
        var valor =$(this).val()
        if (valor=="") {
            $('#brand_modal').modal("show");
        }
    });
    $('.varient_id').change(function (e) { 
        var valor =$(this).val()
        if (valor=="") {
            $('#varient_modal').modal("show");
        }
    });
    /* Controller de Modal -- end */
    $('#stock_type').change(function (e) { 
        var stock_type =$(this).val()
        if (stock_type == "A") {
            $("#stock").css("display", "block");
            $("#stock_control").css("display", "block");
        }else{
            $("#stock").css("display", "none");
            $("#stock_control").css("display", "none");
        }
        
    });
    $("body").ready(function () {
        var stock_type =$('#stock_type').val()
        if (stock_type == "A") {
            $("#stock").css("display", "block");
            $("#stock_control").css("display", "block");
        }else{
            $("#stock").css("display", "none");
            $("#stock_control").css("display", "none");
        }
    });
</script>




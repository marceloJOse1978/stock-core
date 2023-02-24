<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Formulário de {{$title}}</h4>
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
                <form action="{{ route('variants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Titulo</label>
                        <div class="col-sm-12 col-md-10">
                            <input
                                class="form-control"
                                type="text"
                                placeholder="Titulo da Variação"
                                name="title"
                                />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-10"></div>
                        <div class="col-sm-1 col-md-1">
                            <button type="submit" class="btn btn-primary" id="button">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#button").click(function (e) { 
        e.preventDefault();
        
        $.ajax({
            data: $('form').serialize(),
            url: "{{ route('variants.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $('form').trigger("reset");
                success(response.id);
            },
            error: function () {
                error();
            }
        });
    });
    function success (message) {
        Lobibox.notify('success', {
            title: 'GRAVADO',
            msg: "Dado NO."+message
        });
    }
    function error () {
        Lobibox.notify('error', {
            title: 'ERRO',
            msg: "PROBLEMA AO ENVIAR"
        });
    }
     
  });
</script>


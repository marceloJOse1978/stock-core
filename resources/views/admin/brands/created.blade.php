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
                <form action="{{route("brands.store")}}" method="post">
                    @csrf
                    <div class="form-group ">
                        <label class="col-sm-12 col-md-2 col-form-label">Titulo</label>
                        <div class="col-sm-12 col-md-10">
                            <input
                                class="form-control"
                                type="text"
                                placeholder="Titulo da Marca"
                                name="title"
                                />
                        </div>
                    </div>
                    <div class="form-group">
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

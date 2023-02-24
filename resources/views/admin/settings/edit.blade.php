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
                <form action="{{url("variants/$row->id")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Titulo</label>
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
                        <div class="col-sm-12 col-md-10"></div>
                        <div class="col-sm-1 col-md-1">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

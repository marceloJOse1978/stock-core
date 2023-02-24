<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>{{$title}}</h4>
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
            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                {{-- dropdown PARA GESTÃO DE FILES --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Zona de Ficherio</h4>
                        </div>
                    </div>
                    <form action="{{route("send.app",$id)}}" method="POST" enctype="multipart/form-data">
                        <div class="col-md-12 col-sm-12">
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-12 col-md-12 col-form-label">COMPROVATIVO</label>
                                <div class="col-sm-12 col-md-12">  
                                    <div class="custom-file">
                                        <input type="file" name="file_path" class="custom-file-input">
                                        <label class="custom-file-label">BUSCAR ARQUIVO</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <button
                            type="submit"
                            class="btn btn-success btn-lg btn-block"
                            >
                                UPLOAD
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>      

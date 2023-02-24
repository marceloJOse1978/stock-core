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
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-12 col-md-2 col-form-label">Nome</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="name"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="email"
                                placeholder=""
                                name="email"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-2 col-form-label">Telefone</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="phone"
                            />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-12 col-md-2 col-form-label">Conta</label>
                        <div class="col-sm-12 col-md-12">  
                            <select class="form-control" name="role" id="">
                                <option value="cash">Caixa</option>
                                <option value="account">Contador</option>
                                <option value="admin">Adminstrador</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-12 col-md-2 col-form-label">Foto de Perfil</label>
                        <div class="col-sm-12 col-md-12">  
                            <div class="custom-file">
                                <input type="file" name="pic_path" class="custom-file-input">
                                <label class="custom-file-label">Img</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-2 col-form-label">Senha padrão <br> *** password ***</label>
                    </div>
                   
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12"></div>
                        <div class="col-sm-1 col-md-1">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

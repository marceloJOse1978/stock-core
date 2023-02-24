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
                <form action=" {{url("clients/".$row->id)}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">NIF</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder="NIF do Cliente pode ser bilhete de Identidade"
                                name="code"
                                value="{{$row->code}}"
                                />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Referencia</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="reference"
                                value="{{$row->reference}}"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Nome</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="name"
                                value="{{$row->name}}"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Endereço</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="address"
                                value="{{$row->address}}"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Cidade</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="city"
                                value="{{$row->city}}"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Código Postal</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="code_postal"
                                value="{{$row->code_postal}}"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Telefone</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="phone"
                                value="{{$row->phone}}"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Telemovel</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="mobile"
                                value="{{$row->mobile}}"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Email</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="email"
                                placeholder=""
                                name="email"
                                value="{{$row->email}}"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">Web Site</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="website"
                                value="{{$row->website}}"
                                
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-md-12 col-form-label">País</label>
                        <div class="col-sm-12 col-md-12">
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                name="country"
                                value="{{$row->country}}"
                                
                            />
                        </div>
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


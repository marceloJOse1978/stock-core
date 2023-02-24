<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Perfil - Usuário</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Perfil
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            <img
                                src="{{$url=(!empty($row->pic_path))? url("public/storage/logo-img/$row->pic_path") : "public/setting/empty.png"}}"
                                alt=""
                                class="avatar-photo"
                            />
                        </div>
                        <h5 class="text-center h5 mb-0">{{$row->name}}</h5>
                        <p class="text-center text-muted font-14">
                           {{$row->role}}
                        </p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Informação</h5>
                            <ul>
                                <li>
                                    <span>Nome Da Empresa:</span>
                                    {{$row->name_bs}}
                                </li>
                                <li>
                                    <span>NIF ou BI:</span>
                                    {{$row->nif}}
                                </li>
                                <li>
                                    <span>Endereço Da Empresa:</span>
                                    {{$row->address_bs}}
                                </li>
                                <li>
                                    <span>Numero de Telefone:</span>
                                    {{$row->phone_bs}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a
                                            class="nav-link active"
                                            data-toggle="tab"
                                            href="#setting"
                                            role="tab"
                                            >Configuração</a
                                        >
                                        <li class="nav-item">
                                            <a
                                                class="nav-link"
                                                data-toggle="tab"
                                                href="#tasks"
                                                role="tab"
                                                >Documento</a
                                            >
                                        </li>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    
                                    <!-- Setting Tab start -->
                                    <div
                                        class="tab-pane fade show active"
                                        id="setting"
                                        role="tabpanel"
                                    >
                                        <div class="profile-setting">
                                            <form action="{{route("settings.store")}}" method="POST" enctype="multipart/form-data" >
                                                @csrf
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-12">
                                                        {{-- <h4 class="text-blue h5 mb-20">
                                                            Editar Seu Perfil
                                                        </h4> --}}
                                                        <div class="form-group">
                                                            <label>Nome Da Empresa</label>
                                                            <input
                                                                class="form-control form-control-lg"
                                                                type="text"
                                                                name="name_bs"
                                                                value="{{$row->name_bs}}"
                                                            />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Numero de Telefone</label>
                                                            <input
                                                                class="form-control form-control-lg"
                                                                type="text"
                                                                name="phone_bs"
                                                                value="{{$row->phone_bs}}"
                                                            />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Endereço</label>
                                                            <input
                                                                class="form-control form-control-lg"
                                                                type="text"
                                                                name="address_bs"
                                                                value="{{$row->address_bs}}"
                                                            />
                                                        </div>
                                                        <div class="form-group">
                                                            <label >Logotipo</label>
                                                            <div class="col-sm-12 col-md-12">  
                                                                <div class="custom-file">
                                                                    <input type="file" name="pic_path" class="custom-file-input">
                                                                    <label class="custom-file-label">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input
                                                                type="submit"
                                                                class="btn btn-primary"
                                                                value="Actualizar"
                                                            />
                                                        </div>
                                                    </li>
                                                    {{-- <li class="weight-500 col-md-6">
                                                    </li> --}}
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                    <!-- Tasks Tab start -->
                                    <div class="tab-pane fade" id="tasks" role="tabpanel">
                                        <div class="pd-20 profile-task-wrap">
                                            <div class="container pd-0">
                                                <form action="{{route("settings.store")}}" method="post" enctype="multipart/form-data" >
                                                    @csrf
                                                    <ul class="profile-edit-list row">
                                                        <li class="weight-500 col-md-12">
                                                            <div class="html-editor pd-20 card-box mb-30">
                                                                <textarea
                                                                    name="text"
                                                                    class="textarea_editor form-control border-radius-0"
                                                                    placeholder="TERMO DE DOCUMENTO ..."
                                                                >{{$row->text}}</textarea>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <input
                                                                    type="submit"
                                                                    class="btn btn-primary"
                                                                    value="Actualizar"
                                                                />
                                                            </div>
                                                        </li>{{-- 
                                                        <li class="weight-500 col-md-6">
                                                        </li> --}}
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tasks Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



        
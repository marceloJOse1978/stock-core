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
                            <a
                                href="modal"
                                data-toggle="modal"
                                data-target="#modal"
                                class="edit-avatar"
                                ><i class="fa fa-pencil"></i
                            ></a>
                            <img
                                src="{{$url=(!empty($row->pic_path))? url("storage/packges/$row->pic_path") : url("storage/imagens/empty.png")}}"
                                alt=""
                                class="avatar-photo"
                            />
                            <div
                                class="modal fade"
                                id="modal"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="modalLabel"
                                aria-hidden="true"
                            >
                                <div
                                    class="modal-dialog modal-dialog-centered"
                                    role="document"
                                >
                                    <div class="modal-content">
                                        <div class="modal-body pd-5">
                                            <div class="img-container">
                                                <img
                                                    id="image"
                                                    src="vendors/images/photo2.jpg"
                                                    alt="Picture"
                                                />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input
                                                type="submit"
                                                value="Update"
                                                class="btn btn-primary"
                                            />
                                            <button
                                                type="button"
                                                class="btn btn-default"
                                                data-dismiss="modal"
                                            >
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="text-center h5 mb-0">{{$row->title}}</h5>
                        <p class="text-center text-muted font-14">
                           {{$row->reference}}
                        </p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Informação</h5>
                            <ul>
                                <li>
                                    <span>Preço do Fornecedor:</span>
                                    {{$row->supply_price}}
                                </li>
                                <li>
                                    <span>Preço:</span>
                                    {{$row->gross_price}}
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
                                            >Em Estoque</a
                                        >
                                        <li class="nav-item">
                                            <a
                                                class="nav-link"
                                                data-toggle="tab"
                                                href="#tasks"
                                                role="tab"
                                                >Compra</a
                                            >
                                        </li>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    
                                    <!-- Setting Tab start -->
                                    <div
                                        class="tab-pane fade show active"
                                        id="setting"
                                        role="tabpanel">
                                        <div class="profile-setting">
                                            <div class="container pd-0">
                                                {{-- tabela de Stock --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                    
                                    <!-- Tasks Tab start -->
                                    <div class="tab-pane fade" 
                                    id="tasks" 
                                    role="tabpanel">
                                        <div class="pd-20 profile-task-wrap">
                                            <div class="container pd-0">
                                                {{-- Formulario de Stock --}}
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
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank"
                >Ankit Hingarajiya</a
            >
        </div>
    </div>
</div
<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="public/vendors/images/banner-img.png" alt="" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Bem-vindo De Volta
                        <div class="weight-600 font-30 text-blue">{{Auth::user()->name}} !</div>
                    </h4>
                    <p class="font-18 max-width-600">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde
                        hic non repellendus debitis iure, doloremque assumenda. Autem
                        modi, corrupti, nobis ea iure fugiat, veniam non quaerat
                        mollitia animi error corporis.
                    </p>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-6 mb-20">
                <div class="card-box height-100-p pd-20 min-height-200px">
                    <div class="d-flex justify-content-between pb-10">
                        <div class="h5 mb-0">TURNO DE HOJE</div>
                        <div class="dropdown">
                            <a
                                class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                data-color="#1b3133"
                                href="#"
                                role="button"
                                data-toggle="dropdown"
                            >
                                <i class="dw dw-more"></i>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                            >
                                <a class="dropdown-item" href="#"
                                    ><i class="dw dw-eye"></i> RELATORIO</a
                                >
                               {{--  <a class="dropdown-item" href="#"
                                    ><i class="dw dw-edit2"></i> Edit</a
                                >
                                <a class="dropdown-item" href="#"
                                    ><i class="dw dw-delete-3"></i> Delete</a
                                > --}}
                            </div>
                        </div>
                    </div>
                    <div class="user-list">
                        <ul>
                           @foreach ($timework as $item)
                            <li class="d-flex align-items-center justify-content-between">
                                <div class="name-avatar d-flex align-items-center pr-2">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img
                                            src="public/vendors/images/success.png"
                                            class="border-radius-100 box-shadow"
                                            width="50"
                                            height="50"
                                            alt=""
                                        />
                                    </div>
                                    <div class="txt">
                                        <span
                                            class="badge badge-pill badge-sm"
                                            data-bgcolor="#e7ebf5"
                                            data-color="#265ed7"
                                            >5 venda</span
                                        >
                                        <div class="font-14 weight-600">TURNO FECHADO</div>
                                        <div class="font-12 weight-500" data-color="#b2b1b6">
                                            {{$item->data_init}} até {{$item->data_end}}
                                        </div>
                                    </div>
                                </div>
                                <div class="cta flex-shrink-0">
                                    <a href="#" class="btn btn-sm btn-outline-primary"
                                        >VER</a
                                    >
                                </div>
                            </li>
                           @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p pd-20 min-height-200px">
                    <div class="max-width-300 mx-auto">
                        <img src="public/vendors/images/upgrade.svg" alt="" />
                    </div>
                    <div class="text-center">
                        <div class="h5 mb-1">TURNOS</div>
                        <div
                            class="font-14 weight-500 max-width-200 mx-auto pb-20"
                            data-color="#a6a6a7"
                        >
                           PARA ABRIR UM TURNO CLICA NESTE BOTÃO E QUANDO  TERMINAR PODE CLICAR NOVAMENTE PARA FECHAR
                        </div>
                        <a href="{{route("init.timeworks")}}" class="btn btn-primary btn-lg">{{$status}}</a>
                    </div>
                </div>
            </div>
        </div>
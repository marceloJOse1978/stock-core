<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Perfil - {{$title}}</h4>
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
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <h5 class="text-center h5 mb-0">{{$row->name}}</h5>
                        <p class="text-center text-muted font-14">
                            Lorem ipsum dolor sit amet
                        </p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Contacto e Informação</h5>
                            <ul>
                                <li>
                                    <span>Email:</span>
                                    {{$row->email}}
                                </li>
                                <li>
                                    <span>Telefone:</span>
                                    {{$row->phone}}
                                </li>
        
                                <li>
                                    <span>Endereço:</span>
                                    {{$row->address}}
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
                                            href="#timeline"
                                            role="tab"
                                            >Factura</a
                                        >
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            class="nav-link"
                                            data-toggle="tab"
                                            href="#setting"
                                            role="tab"
                                            >Editar</a
                                        >
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Timeline Tab start -->
                                    <div
                                        class="tab-pane fade show active"
                                        id="timeline"
                                        role="tabpanel"
                                    >
                                        <div class="pd-20">
                                            <div class="profile-timeline">
                                                <div class="timeline-month">
                                                    <h5>August, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 Aug</div>
                                                            <div class="task-name">
                                                                <i class="ion-android-alarm-clock"></i> Task
                                                                Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-chatboxes"></i> Task Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-clock"></i> Event Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-clock"></i> Event Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="timeline-month">
                                                    <h5>July, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 July</div>
                                                            <div class="task-name">
                                                                <i class="ion-android-alarm-clock"></i> Task
                                                                Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 July</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-chatboxes"></i> Task Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="timeline-month">
                                                    <h5>June, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 June</div>
                                                            <div class="task-name">
                                                                <i class="ion-android-alarm-clock"></i> Task
                                                                Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 June</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-chatboxes"></i> Task Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 June</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-clock"></i> Event Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Timeline Tab End -->
                                    <!-- Setting Tab start -->
                                    <div
                                        class="tab-pane fade height-100-p"
                                        id="setting"
                                        role="tabpanel"
                                    >
                                        <div class="profile-setting">
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-12">
                                                        <h4 class="text-blue h5 mb-20">
                                                            Editar - {{$title}}
                                                        </h4>
                                                        <form action=" {{url("clients/".$row->id)}} " method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">NIF</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder="NIF do Cliente pode ser bilhete de Identidade"
                                                                        name="code"
                                                                        value="{{$row->code}}"
                                                                        />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Referencia</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder=""
                                                                        name="reference"
                                                                        value="{{$row->reference}}"
                                                                        
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
                                                                        name="name"
                                                                        value="{{$row->name}}"
                                                                        
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Endereço</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder=""
                                                                        name="address"
                                                                        value="{{$row->address}}"
                                                                        
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Cidade</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder=""
                                                                        name="city"
                                                                        value="{{$row->city}}"
                                                                        
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Código Postal</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder=""
                                                                        name="code_postal"
                                                                        value="{{$row->code_postal}}"
                                                                        
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Telefone</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder=""
                                                                        name="phone"
                                                                        value="{{$row->phone}}"
                                                                        
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Telemovel</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder=""
                                                                        name="mobile"
                                                                        value="{{$row->mobile}}"
                                                                        
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="email"
                                                                        placeholder=""
                                                                        name="email"
                                                                        value="{{$row->email}}"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Web Site</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder=""
                                                                        name="website"
                                                                        value="{{$row->website}}"
                                                                        
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">country</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        class="form-control"
                                                                        type="text"
                                                                        placeholder=""
                                                                        name="country"
                                                                        value="{{$row->country}}"
                                                                        
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Enviar Email</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input
                                                                        type="checkbox"
                                                                        class="switch-btn"
                                                                        data-size="small"
                                                                        data-color="#0099ff"
                                                                        name="send_mail"~
                                                                        @if (!empty($row->send_mail))
                                                                            checked
                                                                        @endif
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-12 col-md-10"></div>
                                                                <div class="col-sm-1 col-md-1">
                                                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </li>
                                                </ul>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
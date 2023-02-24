<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Core - Login</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="public/vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="public/vendors/images/favicon-32x32.png"
		/>
		
		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>
        <link rel="stylesheet" type="text/css" href="{{asset('')}}public/vendors/styles/notify.css" />
		<link rel="stylesheet" type="text/css" href="{{asset('')}}public/vendors/styles/notify.min.css" />
		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="public/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="public/vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="public/vendors/styles/style.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
        <!-- End Google Tag Manager -->
		<script src="{{asset('')}}public/vendors/scripts/jquery-3.6.1.min.js"></script>
	</head>
	<body>
        <div class="login-page" id="app">
            <div class="login-header box-shadow">
                <div
                    class="container-fluid d-flex justify-content-between align-items-center"
                >
                    <div class="brand-logo">
                        <a href="#">
                            <img src="{{asset('')}}public/vendors/images/deskapp-logo.svg" alt="" />
                        </a>
                    </div>
                    <div class="login-menu">
                       {{--  <ul>
                            @if (empty($status))
                                <li><a href=" {{url("register")}} ">Register</a></li>
                            @endif
                        </ul> --}}
                    </div>
                </div>
            </div>
            <div
                class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-lg-7">
                            <img src="{{asset('')}}public/vendors/images/login-page-img.png" alt="" />
                        </div>
                        <div class="col-md-6 col-lg-5">
                            <div class="login-box bg-white box-shadow border-radius-10">
                                <div class="login-title">
                                    <h2 class="text-center text-primary">Entrada</h2>
                                </div>
                                <form action="{{ url('sign_in') }}" method="post">
									
									{{ csrf_field() }}
                                    {{-- <div class="select-role">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn active">
                                                <input type="radio" name="options" id="admin"  />
                                                <div class="icon">
                                                    <img
                                                        src="{{asset('')}}public/vendors/images/briefcase.svg"
                                                        class="svg"
                                                        alt=""
                                                    />
                                                </div>
                                                <span>Sou</span>
                                                Gestor
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="options" id="users" checked/>
                                                <div class="icon">
                                                    <img
                                                        src="{{asset('')}}public/vendors/images/person.svg"
                                                        class="svg"
                                                        alt=""
                                                    />
                                                </div>
                                                <span>Sou</span>
                                                Funcionário
                                            </label>
                                        </div>
                                    </div> --}}
                                    <div class="input-group custom">
                                        <input
                                            type="text"
											name="email"
                                            class="form-control form-control-lg"
                                            placeholder="Email ou Número de Telefone"
                                        />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"
                                                ><i class="icon-copy dw dw-user1"></i
                                            ></span>
                                        </div>
                                    </div>
                                    <div class="input-group custom">
                                        <input
										name="password"
                                            type="password"
                                            class="form-control form-control-lg"
                                            placeholder="**********"
                                        />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"
                                                ><i class="dw dw-padlock1"></i
                                            ></span>
                                        </div>
                                    </div>
                                    {{-- <div class="row pb-30">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="customCheck1"
                                                />
                                                <label class="custom-control-label" for="customCheck1"
                                                    >Lembra-me</label
                                                >
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="forgot-password">
                                                <a href="forgot-password.php">Esqueci a Senha</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group mb-0">
                                                <!--
                                                use code for form submit
                                            -->
                                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Entrar">
                                                
                                            </div>
                                            <div
                                                class="font-16 weight-600 pt-10 pb-10 text-center"
                                                data-color="#707373"
                                            >
                                            </div>
                                            <!-- <div class="input-group mb-0">
                                                <a
                                                    class="btn btn-outline-primary btn-lg btn-block"
                                                    href="register.html"
                                                    >Regista Conta</a
                                                >
                                            </div> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- js -->
        <script src="{{asset('')}}public/vendors/scripts/core.js"></script>
		<script src="{{asset('')}}public/vendors/scripts/script.min.js"></script>
		<script src="{{asset('')}}public/vendors/scripts/layout-settings.js"></script>
		<script src="{{asset('')}}public/vendors/scripts/dashboard3.js"></script>
        {{-- Notify --}}
		<script src="{{asset('')}}public/vendors/scripts/notify.js"></script>
		 
		 
		<script>
			$(function () {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$("body").on("submit","form", function (e) {
					e.preventDefault();
					$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
					dataType: "JSON",
					data: new FormData(this),
					processData: false,
					contentType: false,
					success: function (response) {
						if(response.notify==1){
							Lobibox.notify('success', {
								title: 'SUCESSO',
								msg: response.message
							});
						}else{
							Lobibox.notify('error', {
								title: 'ERRO',
								msg: response.message
							});
						}
						if (response.clear==1) {
							$('form').trigger("reset")
						}
						if (response.reload==1) {
							window.location.reload();
						}
						if (response.open!=null) {
							window.location.href =response.open;
						}
					},
					error: function (response)
					{
						console.log(response);
						error();
					}
				});   
			});
			function success (message="REALIZADO") {
				Lobibox.notify('success', {
					title: 'SUCESSO',
					msg: message
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
	</body>
</html>

<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Registrar - Empresa</title>

		<!-- Site favicon -->
		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/jquery-steps/jquery.steps.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

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
        <script src="{{asset('')}}vendors/scripts/jquery-3.6.1.min.js"></script>
	</head>
	<body>
        <div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="vendors/images/deskapp-logo.svg" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div>
        <div class="login-page">
            <div class="login-header box-shadow">
                <div
                    class="container-fluid d-flex justify-content-between align-items-center"
                >
                    <div class="brand-logo">
                        <a href="login.html">
                            <img src="vendors/images/deskapp-logo.svg" alt="" />
                        </a>
                    </div>
                    <div class="login-menu">
                        <ul>
                            <li><a href=" {{url("login")}} ">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div
                class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center"
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-lg-7">
                            <img src="vendors/images/register-page-img.png" alt="" />
                        </div>
                        <div class="col-md-6 col-lg-5">
                            <div class="register-box bg-white box-shadow border-radius-10">
                                <div class="wizard-content">
                                    @if (empty($id))
                                    <form action="{{route("settings")}}" method="POST" class="tab-wizard2 wizard-circle wizard">
                                        @csrf
                                        <h5>Credenciais básicas da conta</h5>
                                        <section>
                                            <div class="form-wrap max-width-600 mx-auto">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nome Completo*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="name" id="name" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"
                                                        >Endereço de email*</label
                                                    >
                                                    <div class="col-sm-8">
                                                        <input type="email" name="email" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"
                                                        >Telefone*</label
                                                    >
                                                    <div class="col-sm-8">
                                                        <input type="text" name="phone" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Senha*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="password" name="password" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- success Popup html Start -->
                                            <button
                                                type="button"
                                                id="success-modal-btn"
                                                hidden
                                                data-toggle="modal"
                                                data-target="#success-modal"
                                                data-backdrop="static"
                                            >
                                                Feito
                                            </button>
                                            <div
                                                class="modal fade"
                                                id="success-modal"
                                                tabindex="-1"
                                                role="dialog"
                                                aria-labelledby="exampleModalCenterTitle"
                                                aria-hidden="true"
                                            >
                                                <div
                                                    class="modal-dialog modal-dialog-centered max-width-400"
                                                    role="document"
                                                >
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center font-18">
                                                            <h3 class="mb-20">Seja Bem vindo a Core</h3>
                                                            <div class="mb-30 text-center">
                                                                <img src="vendors/images/success.png" />
                                                            </div>
                                                            Os dados Estão em processo confirma 
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="submit" class="btn btn-primary">ok</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- js -->
        <script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/jquery-steps/jquery.steps.js"></script>
		<script src="vendors/scripts/steps-setting.js"></script>
	</body>
</html>

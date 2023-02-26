<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Stock-{{ $title }}</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="{{asset('')}}public/vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('')}}public/src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('')}}public/src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('')}}public/loading/pace-theme-default.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('')}}public/loading/pace-theme-default.css"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="{{asset('')}}public/vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="{{asset('')}}public/vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="{{asset('')}}public/https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{asset('')}}public/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('')}}public/src/plugins/dropzone/src/dropzone.css"
		/>
		
		<link rel="stylesheet" type="text/css" href="{{asset('')}}public/vendors/styles/notify.css" />
		<link rel="stylesheet" type="text/css" href="{{asset('')}}public/vendors/styles/notify.min.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('')}}public/vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="{{asset('')}}public/vendors/styles/style.css" />
		<!-- switchery css -->
		<link
		rel="stylesheet"
		type="text/css"
		href="{{asset('')}}public/src/plugins/switchery/switchery.min.css"
		/>
		<!-- bootstrap-tagsinput css -->
		<link
		rel="stylesheet"
		type="text/css"
		href="{{asset('')}}public/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css"
		/>
		<!-- bootstrap-touchspin css -->
		<link
		rel="stylesheet"
		type="text/css"
		href="{{asset('')}}public/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('')}}public/src/plugins/jquery-steps/jquery.steps.css"
		/>
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
		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<p>
							<span id="days"> {{Session::get('days')}} </span>
							@if (Session::get('days')!="Inativo")
							 	dias
							@endif
						</p>
					</div>
				</div>
				@if (Session::get('days')!="Inativo")
					<div class="dashboard-setting user-notification">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="{{route("payments.app")}}">
								<i class="icon-copy dw dw-crown"></i>
							</a>
						</div>
					</div>
				@endif


				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a class="dropdown-toggle no-arrow" href="{{route("cash.index")}}">
							<i class="icon-copy dw dw-computer-1"></i>
						</a>
					</div>
				</div>
				
				<div class="user-notification">
					<div class="dropdown">
						{{-- <a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							@if (!empty($_SESSION["status"]))
								<span class="badge notification-active"></span>
							@endif
						</a> --}}
						{{-- <div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									@foreach ($_SESSION["notice"] as $item)
									<li>
										<a href="#">
											<img src="{{asset('')}}public/vendors/images/img.jpg" alt="" />
											<h3>{{$item->type}}</h3>
											<p>
												{{$item->message}}
											</p>
										</a>
									</li>
									@endforeach
								</ul>
							</div>
						</div> --}}
					</div>
				</div>
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="{{(empty(Auth::user()->pic_path))?url("public/setting/empty.png"):url("public/storage/user/".Auth::user()->pic_path)}}" alt="" />
							</span>
							<span class="user-name"> {{Auth::user()->name}} </span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href=" {{route("profile")}} "
								><i class="dw dw-user1"></i> Perfil</a
							>
							<a class="dropdown-item" href="{{route("settings.index")}}"
								><i class="dw dw-settings2"></i> Configuração</a
							>
							{{-- <a class="dropdown-item" href=""
								><i class="dw dw-help"></i> Ajuda</a
							> --}}
							{{-- <a class="dropdown-item" href="{{{route("core.upgrades")}}}"
								><i class="dw dw-up-arrow"></i> Upgrades</a
							> --}}
							<a class="dropdown-item" href="{{{route("checked.app")}}}"
								><i class="dw dw-keyhole"></i> Activa Serial</a
							>
							{{-- <a class="dropdown-item" href=" {{{route("core.packs")}}} "
								><i class="dw dw-file"></i> Extensões</a
							> --}}
							<a class="dropdown-item" href="{{url("/exit")}}"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>

		

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="{{url("/")}}">
					<img src="{{asset('')}}public/vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
					<img
						src="{{asset('')}}public/vendors/images/deskapp-logo-white.svg"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
								><span class="mtext">Home</span>
							</a>
							<ul class="submenu">
								{{-- <li><a href=" {{url("dashboard/welcome")}} ">Bem-vindo</a></li> --}}
								<li><a href=" {{url("dashboard/home")}} ">Dashboard</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon icon-copy dw dw-user1"></span
								><span class="mtext">Cliente</span>
							</a>
							<ul class="submenu">
								<li><a href=" {{route("clients.index")}} ">Cliente</a></li>
								<li><a href=" {{url("reports/clients")}} ">Conta Corrente</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon icon-copy dw dw-price-tag"></span
								><span class="mtext">Produto</span>
							</a>
							<ul class="submenu">
								<li><a href=" {{route("products.index")}} ">Produtos</a></li>
								<li><a href=" {{route("category.index")}} ">Categoria</a></li>
								<li><a href=" {{route("brands.index")}} ">Marca</a></li>
								<li><a href=" {{route("variants.index")}} ">Variação</a></li>
								<li><a href=" {{route("units.index")}} ">Unidade</a></li>
								<li><a href=" {{route("stocks.index")}} ">Estoque</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon icon-copy fi-page-export-doc"></span
								><span class="mtext">Relatório</span>
							</a>
							<ul class="submenu">
								<li><a href=" {{url("reports/cash")}} ">Movimento de Caixa</a></li>
								<li><a href=" {{route("timeworks.index")}} ">Tempo de Trabalho</a></li>
							{{-- 	<li><a href=" {{url("reports/users")}} ">Usuário</a></li> --}}
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon icon-copy dw dw-invoice"></span
								><span class="mtext">Documentos</span>
							</a>
							<ul class="submenu">
								<li><a href=" {{url("documents")}} ">Emitir Documento</a></li>
								<li><a href=" {{route("all.index")}} ">Todos</a></li>{{-- 
								<li><a href=" {{url("FT")}} ">Factura</a></li> --}}
								<li><a href=" {{url("FP")}} ">Factura Pro Forma</a></li>
								<li><a href=" {{url("RG")}} ">Recibo</a></li>
								<li><a href=" {{url("NE")}} ">Nota de Encomenda</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon icon-copy dw dw-groceries-store"></span
								><span class="mtext">Fornecedor</span>
							</a>
							<ul class="submenu">
								<li><a href=" {{route("providers.index")}} ">Fornecedor</a></li>
								<li><a href=" {{route("invoices.index")}} ">Factura de Entrada</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon icon-copy fa fa-pie-chart"></span
								><span class="mtext">Contabilidade</span>
								
							</a>
							<ul class="submenu">
								<li><a href=" {{url("reports/maps_tax")}} ">Mapa de Imposto</a></li>
								<li><a href=" {{url("reports/maps_tax_providers")}} ">Mapa de Impostos Fornecedor</a></li>
							</ul>
						</li>
						<li>
							<a href="{{route("users.index")}}" class="dropdown-toggle no-arrow">
								<span class="micon icon-copy dw dw-add-user"></span
								><span class="mtext">Usuário</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						{{-- <li>
							<div class="sidebar-small-cap">Extra</div>
						</li> --}}
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>STOCK CORE - UPGRADES</title>

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
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="public/vendors/images/favicon-16x16.png"
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
		<link rel="stylesheet" type="text/css" href="{{asset('')}}public/vendors/styles/notify.css" />
		<link rel="stylesheet" type="text/css" href="{{asset('')}}public/vendors/styles/notify.min.css" />

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="public/https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
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
			src="public/https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
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
	</head>
	<body>
		<div
			class="error-page d-flex align-items-center flex-wrap justify-content-center pd-20"
		>
			<div class="pd-10">
				<div class="error-page-wrap text-center">
					<h1>UP</h1>
					<h3>VERSÃO: {{Session::get("actual")}} Para {{Session::get("upgrades")}} </h3>
					<p>
						Desculpa, Se a pagina já terminou de processar e o não recebeu a Notificação de concluido 
					</p>
					<div class="pt-20 mx-auto max-width-200">
						<a href="{{url("/")}}" class="btn btn-primary btn-block btn-lg"
							>Voltar a Pagina Inicial</a
						>
					</div>
				</div>
			</div>
		</div>
		
		<!-- js -->
		<script src="public/vendors/scripts/core.js"></script>
		<script src="public/vendors/scripts/script.min.js"></script>
		<script src="public/vendors/scripts/process.js"></script>
		<script src="{{asset('')}}public/loading/pace.js"></script>
		<script src="{{asset('')}}public/loading/pace.min.js"></script>
		{{-- Notify --}}
		<script src="{{asset('')}}public/vendors/scripts/notify.js"></script>
		<script>
			$(function () {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					url: "{{route('upgrades.index')}}",
					type: "GET",
					dataType: "JSON",
					success: function (response) {
						if (response.erro!=null) {
							Lobibox.notify('error', {
								title: 'ERRO',
								msg: response.erro
							});
						}
						if (response.message!=null) {
							success(response.message);
						}
						if (response.open!=null) {
							window.location.href =response.open;
						}
					},
					error: function (response){
						console.log(response);
						error();
					}  
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

@if (empty(App\Models\Setting::find(1)->nif))
<div
	class="modal fade"
	id="login-modal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="myLargeModalLabel"
	aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
		<div class="col-md-12 col-lg-12">
			<div class="register-box bg-white box-shadow border-radius-10">
				<div class="wizard-content">
					<form action="{{url("/settings/company")}}" method="POST" class="tab-wizard2 wizard-circle wizard">
						@csrf
						<!-- Step 1 -->
						<h5>DADOS FISCAL  </h5>
						<section>
							<div class="form-wrap max-width-600 mx-auto">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"
										>Nome Da Empresa*</label
									>
									<div class="col-sm-8">
										<input type="text" id="name_bs" name="name_bs" class="form-control" required />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"
										>NIF*</label
									>
									<div class="col-sm-8">
										<input type="text" id="nif" name="nif" class="form-control" required />
									</div>
								</div>
							</div>
						</section>
						<!-- Step 2 -->
						<h5>DADOS PESSOAL</h5>
						<section>
							<div class="form-wrap max-width-600 mx-auto">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"
										>Endereço*</label
									>
									<div class="col-sm-8">
										<input type="text" id="address_bs" name="address_bs" class="form-control" required />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"
										>Numero de Telefone*</label
									>
									<div class="col-sm-8">
										<input type="text" id="phone_bs" name="phone_bs" class="form-control" required />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"
										>Email*</label
									>
									<div class="col-sm-8">
										<input type="text" id="email_bs" name="email_bs" class="form-control" required />
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
											{{-- <div class="mb-30 text-center">
												<img src="vendors/images/success.png" />
											</div> --}}
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
				</div>
			</div>
		</div>
	</div>
</div>	
@endif
<!-- Medium modal -->
<div
	class="modal fade"
	id="serial-key"
	tabindex="-1"
	role="dialog"
	aria-labelledby="myLargeModalLabel"
	aria-hidden="true"
>
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">
					ACTIVAR CHAVE
				</h4>
			</div>
			<div class="modal-body">
				<form action="{{route("send.serial")}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label class="col-sm-12 col-md-12 col-form-label">SERIAL</label>
						<div class="col-sm-12 col-md-12">
							<input
								class="form-control"
								type="text"
								placeholder="XXXX-XXX-XXX-XX Coloca como esta no recibo "
								name="serial"
								
							/>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<button
						type="submit"
						class="btn btn-success btn-lg btn-block"
						>
							Ok
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div
	class="modal fade"
	id="upgrades-modal"
	tabindex="-1"
	role="dialog"
	aria-hidden="true"
>
	<div
		class="modal-dialog modal-dialog-centered"
		role="document"
	>
		<div class="modal-content">
			<div class="modal-body text-center font-18">
				<h4 class="padding-top-30 mb-30 weight-500">
					NOVA ACTUALIZAÇÃO DESEJA ACTUALIZAR ?
				</h4>
				<div
					class="padding-bottom-30 row"
					style="max-width: 170px; margin: 0 auto"
				>
					<div class="col-6">
						<button
							type="button"
							class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
							data-dismiss="modal"
						>
							<i class="fa fa-times"></i>
						</button>
						Não
					</div>
					<div class="col-6">
							<a href="{{route("upgrades.index")}}">
								<button
									type="button"
									class="btn btn-primary border-radius-100 btn-block confirmation-btn"
									
								>
									<i class="fa fa-check"></i>
								</button>
							</a>
							Sim
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div
	class="modal fade"
	id="alert-modal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="myLargeModalLabel"
	aria-hidden="true"
>
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content bg-danger text-white">
			<div class="modal-body text-center">
				<h3 class="text-white mb-15">
					<i class="fa fa-exclamation-triangle"></i> AVISO !
				</h3>
				<p>
					POR FAVOR VERIFICA A DATA DESTE PC E <br> <br> FECHA O APP E VOLTA A LIGAR OBRIGADO. <br> <br> CASO NÃO VOLTAR AO NORMAL 
				</p>
				{{-- 
					<button
						type="button"
						class="btn btn-light"
						data-dismiss="modal"
					>
						Ok
					</button> 
				--}}
			</div>
		</div>
	</div>
</div>
</div>
</div>



<script src="{{asset('')}}public/vendors/scripts/core.js"></script>
<script src="{{asset('')}}public/vendors/scripts/script.min.js"></script>
<script src="{{asset('')}}public/loading/pace.js"></script>
<script src="{{asset('')}}public/loading/pace.min.js"></script>
<script src="{{asset('')}}public/vendors/scripts/process.js"></script>
<script src="{{asset('')}}public/vendors/scripts/layout-settings.js"></script>
<script src="{{asset('')}}public/src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="{{asset('')}}public/vendors/scripts/dashboard3.js"></script>
{{-- Notify --}}
<script src="{{asset('')}}public/vendors/scripts/notify.js"></script>

@if ($message = Session::get('success'))
<script>

$('#basicSuccessCustomTitle').ready(function () {
Lobibox.notify('success', {
	title: 'Feito',
	msg: "{{$message }}"
});
});
</script>
@endif 

@if ($message = Session::get('error'))
<script>
$('#basicDangerCustomTitle').ready(function () {
	Lobibox.notify('error', {
		title: 'Erro',
		msg:"{{$message}}" 
	});
});
</script>
@endif

@if ($message = Session::get('warning'))
<script>
$('#basicwarningCustomTitle').ready(function () {
	Lobibox.notify('warning', {
		title: 'Alerta',
		msg: '{{$message }}'
	});
});
</script>
@endif

@if ($message = Session::get('info'))
<script>
$('#basicwarningCustomTitle').ready(function () {
	Lobibox.notify('info', {
		title: 'Info',
		msg: '{{$message }}'
	});
});
</script>
@endif

@if ($errors->any())
<script>
$('#basicwarningCustomTitle').ready(function () {
	Lobibox.notify('warning', {
		title: 'Alerta',
		msg: 'Erro de Formulário'
	});
});
</script>
@endif
{{-- FORM START --}}

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
				$('.data-table').DataTable().ajax.reload();
				success(response.message);
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
	$("body").on("click",".install-itens", function () {
	var url = $(this).data("url");
	$.ajax({
		type: "GET",
		url: url,
		dataType: "json",
		success: function (response) {
			success(response.message);
		},
		error: function (response)
		{
			console.log(response);
			error();
		}
	});
	})
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

<script>
$('#login-modal').modal({
	backdrop: 'static',
	keyboard: false  // to prevent closing with Esc button (if you want this too)
})
</script>
@if (!empty(Session::get('upgrades')))
	<script>
	$('#upgrades-modal').modal({
		backdrop: 'static',
		keyboard: false  // to prevent closing with Esc button (if you want this too)
	})
	</script>
@endif

@if (Session::get('days') !="Inativo" && empty(Session::get('data_system')))
	<script>
	$('#alert-modal').modal({
		backdrop: 'static',
		keyboard: false  // to prevent closing with Esc button (if you want this too)
	})
	</script>
@endif

@if (Session::get('days')!="Inativo" && Session::get('days')<=0)
	<script>
	$('#serial-key').modal({
		backdrop: 'static',
		keyboard: false  // to prevent closing with Esc button (if you want this too)
	})
	</script>
@endif

{{-- FORM END --}}

<!-- switchery js -->
<script src="{{asset('')}}public/src/plugins/switchery/switchery.min.js"></script>
<!-- bootstrap-tagsinput js -->
<script src="{{asset('')}}public/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
{{-- form end --}}
<!-- Export Datatable End -->
<script src="{{asset('')}}public/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<!-- buttons for Export datatable -->
<script src="{{asset('')}}public/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="{{asset('')}}public/src/plugins/datatables/js/vfs_fonts.js"></script>

<!-- switchery js -->
<script src="{{asset('')}}public/src/plugins/switchery/switchery.min.js"></script>
<!-- bootstrap-tagsinput js -->
<script src="{{asset('')}}public/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<!-- bootstrap-touchspin js -->
<script src="{{asset('')}}public/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="{{asset('')}}public/vendors/scripts/advanced-components.js"></script>
<script src="{{asset('')}}public/vendors/scripts/process.js"></script>
<script src="{{asset('')}}public/vendors/scripts/layout-settings.js"></script>
<script src="{{asset('')}}public/src/plugins/jquery-steps/jquery.steps.js"></script>
<script src="{{asset('')}}public/vendors/scripts/steps-setting.js"></script>


</body>
</html>
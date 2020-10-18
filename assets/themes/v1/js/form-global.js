'use strict';

$(document).ready(function () {

	$('#defaultModal').on('hide.bs.modal', function (event) {
		$(".modal-theme-loader").fadeIn();
		$('#modalTitle').html('');
		$('#modalBody').html('');
	});

	$('#defaultModal').on('shown.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var form = button.data('modal-url');
		var title = button.data('modal-title') ? button.data('modal-title') : '';

		$('#modalBody').load(form, function (response, status, xhr) {
			$('#modalTitle').html(title);
			$(".modal-theme-loader").fadeOut();
		});
	});

	//hafifi - workaround for bootstrap4 tabs bug
	$('a[data-toggle="tab"]').click(function () {
		// todo remove snippet on bootstrap v4
		$('a[data-toggle="tab"]').click(function () {
			$($(this).attr('href')).show().addClass('show active').siblings().hide();
		});
	});

	//MF - recalculate datatable column witdh adjustment in tab operation
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$($.fn.dataTable.tables(true)).DataTable()
			.columns.adjust();
	});

	// var n = $("li.nav-item").length;
	// $('.md-tabs .nav-item').css('width', 'calc(100% /' + n + ')');
	// $('.nav-tabs .slide').css('width', 'calc(100% /' + n + ')');

	var x = $("a.myag").length;
	$('.linkwizard .myag').css('width', 'calc(98% /' + x + ')');

	var z = $('#design-wizard .steps li').length;
	$('#design-wizard .steps li').css('width', 'calc(100% /' + z + ')');

	$('#btn_reset_form').click(function () {
		$('form')[0].reset();
		$('select').removeClass('form-control-danger');
		$('input').removeClass('form-control-danger');
		$('.error_message').remove();
	});

	// $('#form_entry').submit(function (event) {
	// 	event.preventDefault();
	// 	Swal({
	// 	html: 'Anda pasti untuk simpan/kemaskini rekod ini?',
	// 	type: 'question',
	// 	showCancelButton: true,
	// 	confirmButtonText: 'Ya',
	// 	cancelButtonText: "Tidak",
	// 	allowOutsideClick: false
	// 	}).then((result) => {
	// 		if (result.value) {
	// 			this.submit();
	// 		}
	// 	})
	// });    

	$('#btn_form_set_semula').click(function (e) {
		event.preventDefault();

		Swal({
			html: 'Anda pasti untuk set semula rekod ini?',
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			allowOutsideClick: false
		}).then((result) => {
			if (result.value) {
				$('form')[0].reset();
				$('select').removeClass('form-control-danger');
				$('input').removeClass('form-control-danger');
				$('.error_message').remove();
			}
		})
	});

	$('#btn_form_sah').click(function (e) {
		event.preventDefault();
		$("#is_sah").val(1);
		Swal({
			html: 'Anda pasti untuk sahkan tetapan ini?',
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Sah',
			cancelButtonText: "Tidak",
			allowOutsideClick: false
		}).then((result) => {
			if (result.value) {
				$('#form_entry').submit();

			}
		})
	});

	$('#btn_form_hapus').click(function (e) {
		event.preventDefault();
		var link = $(this).attr('href');

		swal({
			html: "Anda pasti untuk hapuskan rekod ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			allowOutsideClick: false
		}).then((result) => {
			if (result.value) {
				window.location.href = link;
			}
		})
	});

	$('#btn_form_simpan').click(function (e) {
		event.preventDefault();
		var inputs = $(':input.mesti');
		var final = 0;

		inputs.each(function () {
			if ($(this).val() == "") {
				$(this).addClass("is-invalid");
				final++;
			} else {
				// values[this.name] = $(this).val();
				$(this).removeClass("is-invalid")
			}
		});

		if (final == 0) {
			$('#is_draf').val('1');
			Swal({
				html: 'Anda pasti untuk simpan rekod ini?',
				type: 'question',
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: "Tidak",
				allowOutsideClick: false
			}).then((result) => {
				if (result.value) {
					$('#form_entry').submit();

					$("body").append('<div class="theme-loader"> <div class="loader-track"> <div class="loader-bar"></div> </div> </div>');

					// Swal.fire({
					// 	title: 'Sila Tunggu.',
					// 	width: 600,
					// 	padding: '3em',
					// 	background: '#fff url(./../../v1/images/general/webmaster_login.jpg)',
					// 	showConfirmButton: false,
					// 	backdrop: `
					// 			rgba(160,160,160,0.4)
					// 			url(./../../v1/images/general/loading.gif)
					// 			left top
					// 			no-repeat
					// 		  `
					// })
				}
			})
		} else {
			Swal({
				html: 'Sila penuhkan semua ruangan yang diperlukan.',
				type: 'error',
				showCancelButton: false,
				confirmButtonText: 'Ya',
				allowOutsideClick: false
			})
		}

	});

	$('#btn_form_hantar').click(function (e) {
		event.preventDefault();
		var inputs = $(':input.mesti');
		var final = 0;

		inputs.each(function () {
			if ($(this).val() == "") {
				$(this).addClass("is-invalid");
				final++;
			} else {
				// values[this.name] = $(this).val();
				$(this).removeClass("is-invalid")
			}
		});

		if (final == 0) {
			$('#is_draf').val('0');
			Swal({
				html: 'Anda pasti untuk hantar permohonan ini?',
				type: 'question',
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: "Tidak",
				allowOutsideClick: false
			}).then((result) => {
				if (result.value) {
					$('#form_entry').submit();
				}
			})
		} else {
			Swal({
				html: 'Sila penuhkan semua ruangan yang diperlukan.',
				type: 'error',
				showCancelButton: false,
				confirmButtonText: 'Ya',
				allowOutsideClick: false
			})
		}

	});

	$('#btn_form_jana').click(function (e) {
		event.preventDefault();
		$('#is_draf').val('1');
		$('#is_download').val('0');
		Swal({
			html: 'Anda pasti untuk jana rekod ini?',
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			allowOutsideClick: false
		}).then((result) => {
			if (result.value) {
				$('#form_entry').submit();
				location.reload();

			}
		})
	});

	$('#btn_form_muatturun').click(function (e) {
		event.preventDefault();
		$('#is_download').val('1');
		Swal({
			html: 'Anda pasti untuk memuat turun buku bajet ini?',
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			allowOutsideClick: false
		}).then((result) => {
			if (result.value) {
				$('#form_entry').submit();
			}
		})
	});

	$('#btn_form_confirm_draf').click(function (e) {
		event.preventDefault();
		$("#form_entry").removeAttr('target');

		// $('#is_download').val('1');
		Swal({
			html: 'Anda pasti untuk memuktamadkan draf ini?',
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			allowOutsideClick: false
		}).then((result) => {
			if (result.value) {
				$("form#form_entry").append("<input name='muktamad' value='1' type='hidden'/>")

				$('#form_entry').submit();
			}
		})
	});

	$('#btn_form_tindakan').click(function (e) {
		e.preventDefault();

		if ($('input[name="wf_keputusan"]:checked').val() == 37 || $('input[name="wf_keputusan"]:checked').val() == 14) {
			if ($('#wf_ulasan').val() == '') {
				var html = '<ul><li>Ruangan "Ulasan/Catatan" diperlukan.</li></ul>';
				$('#warning_kuiri').html(html);
				$('#warning_kuiri').removeClass('alert-info').addClass('alert-danger');
				$('html, body').animate({
					scrollTop: $("#title").offset().top
				}, 500);
				// $('#kuiri_msg').show();
				// // $('#wf_ulasan').addClass('is-invalid');
				// Swal.fire({
				// 	type: 'error',
				// 	title: 'Sila isi ruangan Ulasan/Catatan',
				// 	showConfirmButton: false,
				// 	timer: 1000
				// });
			} else {
				$('#warning_kuiri').addClass('alert-info').removeClass('alert-danger');
				$('#warning_kuiri').html('<p>Sila semak maklumat berikut.</p>');
				Swal({
					html: 'Anda pasti untuk hantar permohonan ini?',
					type: 'question',
					showCancelButton: true,
					confirmButtonText: 'Ya',
					cancelButtonText: "Tidak",
					allowOutsideClick: false
				}).then((result) => {
					if (result.value) {
						$('#kuiri_msg').hide();
						$('#form_entry').submit();
					}
				})
			}
		} else {
			Swal({
				html: 'Anda pasti untuk hantar permohonan ini?',
				type: 'question',
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: "Tidak",
				allowOutsideClick: false
			}).then((result) => {
				if (result.value) {
					$('#kuiri_msg').hide();
					$('#form_entry').submit();
				}
			})
		}
	});

	$('.money_bla').on("keyup", function () {
		let define_value = $(this).val();

		if (define_value.includes(".")) {
			let n_define = define_value.replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "");
			let s_define = n_define.trim().split(".");
			var n_val = "";


			if (s_define[0].length == 1) {
				for (let i = 0; i < 1; i++) {
					n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 2) {
				for (let i = 0; i < 2; i++) {
					n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 3) {
				for (let i = 0; i < 3; i++) {
					n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 4) {
				for (let i = 0; i < 4; i++) {
					if (i == 0)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 5) {
				for (let i = 0; i < 5; i++) {
					if (i == 1)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 6) {
				for (let i = 0; i < 6; i++) {
					if (i == 2)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 7) {
				for (let i = 0; i < 7; i++) {
					if (i == 0 || i == 3)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 8) {
				for (let i = 0; i < 8; i++) {
					if (i == 1 || i == 4)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 9) {
				for (let i = 0; i < 9; i++) {
					if (i == 2 || i == 5)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 10) {
				for (let i = 0; i < 10; i++) {
					if (i == 0 || i == 3 || i == 6)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 11) {
				for (let i = 0; i < 11; i++) {
					if (i == 1 || i == 4 || i == 7)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 12) {
				for (let i = 0; i < 12; i++) {
					if (i == 2 || i == 5 || i == 8)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			} else if (s_define[0].length == 13) {
				for (let i = 0; i < 13; i++) {
					if (i == 0 || i == 3 || i == 6 || i == 9)
						n_val = n_val + s_define[0].charAt(i) + ",";
					else
						n_val = n_val + s_define[0].charAt(i);
				}
			}

			let n2_val = n_val + "." + s_define[1];
			$(this).val(n2_val);
		} else {
			define_value = define_value.replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "");
			var n_val = "";

			if (define_value.length == 1) {
				for (let i = 0; i < 1; i++) {
					n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 2) {
				for (let i = 0; i < 2; i++) {
					n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 3) {
				for (let i = 0; i < 3; i++) {
					n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 4) {
				for (let i = 0; i < 4; i++) {
					if (i == 0)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 5) {
				for (let i = 0; i < 5; i++) {
					if (i == 1)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 6) {
				for (let i = 0; i < 6; i++) {
					if (i == 2)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 7) {
				for (let i = 0; i < 7; i++) {
					if (i == 0 || i == 3)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 8) {

				for (let i = 0; i < 8; i++) {
					if (i == 1 || i == 4)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 9) {
				for (let i = 0; i < 9; i++) {
					if (i == 2 || i == 5)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 10) {
				for (let i = 0; i < 10; i++) {
					if (i == 0 || i == 3 || i == 6)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 11) {
				for (let i = 0; i < 11; i++) {
					if (i == 1 || i == 4 || i == 7)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 12) {
				for (let i = 0; i < 12; i++) {
					if (i == 2 || i == 5 || i == 8)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			} else if (define_value.length == 13) {
				for (let i = 0; i < 13; i++) {
					if (i == 0 || i == 3 || i == 6 || i == 9)
						n_val = n_val + define_value.charAt(i) + ",";
					else
						n_val = n_val + define_value.charAt(i);
				}
			}

			let n2_val = n_val;
			$(this).val(n2_val);
		}
	});

	$('#btn_form_batal').click(function (e) {
		event.preventDefault();
		$('#is_draf').val('0');
		Swal({
			html: 'Adakah anda pasti untuk membatalkan laporan ini?',
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			allowOutsideClick: false
		}).then((result) => {
			if (result.value) {
				$('#form_entry').submit();
			}
		})
	});

	$(document).on('keyup', 'input.amaun', function () {
		// var x = $(this).val();
		// $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		if (event.which >= 37 && event.which <= 40) return;
		$(this).val(function (index, value) {
			return value
				// Keep only digits, decimal points, and dashes at the start of the string:
				.replace(/[^\d.-]|(?!^)-/g, "")
				// Remove duplicated decimal points, if they exist:
				.replace(/^([^.]*\.)(.*$)/, (_, g1, g2) => g1 + g2.replace(/\./g, ''))
				// Keep only two digits past the decimal point:
				.replace(/\.(\d{2})\d+/, '.$1')
				// Add thousands separators:
				.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		});
	});


	$('.form_refresh_kemaskini').submit(function (event) {
		event.preventDefault();
		Swal({
			html: 'Adakah anda pasti?',
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			allowOutsideClick: false
		}).then(function (result) {
			if (result.value) {
				$.ajax({
					url: $('.form_refresh_kemaskini').attr("action"),
					type: "post",
					data: new FormData($(".form_refresh_kemaskini")[0]),
					datatype: "json",
					async: true,
					processData: false,
					contentType: false,

				})
					.done(function (data) {
						swal({
							title: "Maklumat berjaya dikemaskini",
							type: "success",
							showCancelButton: false,
							confirmButtonText: "Ok",
							confirmButtonClass: "btn btn-info m-btn",
							closeOnConfirm: true
						}).then(function (result) {
							location.reload();

						});
					})
					.fail(function (jqXHR, ajaxOptions, thrownError) {
						alert('Terdapat ralat pada sistem ini. Sila hubungi Unit IT.');
					});
				return false;
			}
		});
	});
});

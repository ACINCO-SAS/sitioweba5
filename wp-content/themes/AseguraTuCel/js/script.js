var SUCCESS_RESPONSE = 1;
var FAILURE_RESPONSE = 2;
var PROCESS_RESPONSE = 3;

function getBase64(file, callback) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {
        callback(reader.result);
    };
    reader.onerror = function(error) {
        //console.log('Error: ', error);
    };
}

(function ( $ ) {
 
    $.fn.loading = function() {
        var mode = arguments[0];
        if ( mode == 'start' || mode == null || typeof(mode) == 'undefined' ) {
            this.data('preval',this.text());
            this.addClass('inloading');
            this.css('width',this.outerWidth());
            this.html('<div class="lds-ring"><div></div><div></div><div></div><div></div></div>');
        } else if ( mode == 'stop' ) {
            this.removeClass('inloading');
            this.html(this.data('preval'));
            this.css('width','');
        }
        return this;
    };
 
}( jQuery ));

$(document).ready(function() {
	var url = location.href
	if(url == 'http://aseguratucelular.com/'){
		location.href = '/category/productos';
    }
    
    var wpcf7Elm = document.querySelector( '.wpcf7' );

    var onClickAnchor = function(e) {
        e.preventDefault();
        e.data.elInput.trigger('click');
        //e.data.wrap.find('.preview-name').first().html();
    };

    var onChangeInputFile = function(e) {
        e.preventDefault();
        if( this.files && this.files.length > 0 ) {
            var $file = jQuery(e.currentTarget);

            var selectedFile = this.files[0];
            
            var listFormats = {
                docx: 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                doc: 'application/msword',
                pdf: 'application/pdf',
                jpg: 'image/png',
                png: 'image/jpeg',
            };

            var filesAccepteds = $file.data('myaccept');

            if( filesAccepteds ) {
                filesAccepteds = filesAccepteds.split(',');
            }

            if( filesAccepteds instanceof Array ) {
                var listValid = [];
                for(var i in filesAccepteds) {
                    var ext = jQuery.trim(filesAccepteds[i]).substring(1);
                    listValid.push(listFormats[ext]);
                }

                if( listValid.indexOf(selectedFile.type) < 0 ) {
                    $file.trigger('resetVal');
                    $file.trigger('noValidType');
                    return;
                }

            }

            e.data.wrap.find('.preview-name').first().html(selectedFile.name);
        }
    };


    var onResetInputFile = function(e) {
        e.preventDefault();
        e.data.wrap.find('.preview-name').first().html("");
        e.data.inputFile.val("");
    };

    var onNoValidTypeInputFile = function(e) {
        e.preventDefault();

        var messageError = e.data.errorMsg ? e.data.errorMsg : 'File type not valid';
        e.data.wrap.find('.inner-error').remove();
        var $elError = jQuery('<div>').addClass('inner-error').addClass('text-danger').html(messageError);
        e.data.wrap.append($elError);
        setTimeout(function(){
            e.data.wrap.find('.inner-error').slideUp();
        },6000);
    };

    var convertFile = function($inputFile) {
        $inputFile.addClass('force-hide');
        var $div = jQuery('<div>').addClass('wrap-input-file').insertAfter($inputFile);
        var $anchor = jQuery('<a href="#">').addClass('mybtn mybtn-file').html($inputFile.data('lblbtn') ? $inputFile.data('lblbtn') : 'Escoger archivo').on('click',{
            elInput: $inputFile,
            wrap: $div,
        },onClickAnchor);
        $div.append($anchor);
        $div.append('<span class="preview-name"></span>');
        $div.insertBefore($inputFile);

        $inputFile.on('change',{
            wrap: $div,
        },onChangeInputFile);

        $inputFile.on('resetVal',{
            wrap: $div,
            inputFile: $inputFile,
        },onResetInputFile);
        $inputFile.on('noValidType',{
            wrap: $div,
            errorMsg: $inputFile.data('novalidmsg'),
        },onNoValidTypeInputFile);
    };

    var onResetFormTrigger = function(e) {
        e.data.inputs.each(function(idxInputFile,elInputFile){
            jQuery(elInputFile).trigger('resetVal');
        });
    };

    jQuery('form').each(function(idxForm,elForm){
        var $form = jQuery(elForm);
        var $listInputs = $form.find('input[type="file"]');
        $form.on('reset',{
            inputs: $listInputs,
        },onResetFormTrigger);
        $listInputs.each(function(idxInputFile,elInputFile){
            convertFile(jQuery(elInputFile));
        });
    });

    
    wpcf7Elm.addEventListener( 'wpcf7beforesubmit', function( event ) {
        var $divForm = $(this);
        var $wrapButton = $divForm.find('.wrap-btn-loading').first();
        
        var $btnSubmit = $wrapButton.find('.wpcf7-submit').first();
        $btnSubmit.data('preval',$btnSubmit.text());
        $btnSubmit.html('<div class="lds-ring"><div></div><div></div><div></div><div></div></div>');
    }, false );
    wpcf7Elm.addEventListener( 'wpcf7submit', function(event) {
        var $divForm = $(this);
        var $wrapButton = $divForm.find('.wrap-btn-loading').first();
        var $btnSubmit = $wrapButton.find('.wpcf7-submit').first();
        $btnSubmit.html($btnSubmit.data('preval'));
    }, false );


    var $myCarousel2 = $('#myCarousel2');
    
    var car2 = new Swiper({
        el: $myCarousel2.find('.swiper-container').get(0),
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        slidesPerView: 6,
        spaceBetween: 10,
        navigation: {
            nextEl: $myCarousel2.find('.swiper-button-next').get(0),
            prevEl: $myCarousel2.find('.swiper-button-prev').get(0),
        },
        /*pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },*/
    });
	
	var sesion = "";
	$('.menu-mobile-effect.navbar-toggle').on('click', function(){
		if ($(".mobile-menu-open")[0]){
		    //console.log('yes');
		    $('.wrapper-container').removeClass('mobile-menu-open');
		} else {
		    //console.log('no');
		    $('.wrapper-container').addClass('mobile-menu-open');
		}
	});
	
	$('#cerrar-sesion').on('click', function(event) {
		location.reload();
    });
    
    var elFormLoginSesion = document.getElementById('loginform');

    if( elFormLoginSesion ) {

        var $formLoginSesion = jQuery( elFormLoginSesion );

        var $btnSubmitLoginSesion = $formLoginSesion.find('button[type="submit"]').first();
        $formLoginSesion.validate({
            lang: 'es',
            errorClass: "msg-error text-danger",
            errorElement: "span",
            submitHandler: function(elForm) {

                if( $btnSubmitLoginSesion.hasClass('inloading') ) {
                    return;
                }
                $btnSubmitLoginSesion.loading();

                var input_tipoDoc = document.getElementById('tipo_documento');
                var input_numDoc = document.getElementById('num_documento');
                var input_numCel = document.getElementById('num_celular');

                var objsend = {
                    documento: jQuery(input_numDoc).val(),
                    linea: jQuery(input_numCel).val()
                };
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "/wp-content/themes/AseguraTuCel/services/login.php",
                    "method": "POST",
                    "headers": {
                        "content-type": "application/json"
                    },
                    "processData": false,
                    "data": JSON.stringify(objsend)
                };
        
                $.ajax(settings).done(function(response) {
                    var resp = JSON.parse(response);

                    if (resp['estado'] != SUCCESS_RESPONSE) {
                        jQuery('#reclamacion-sesion .errors .message.text-danger').html(resp['desc']);
                        jQuery('#reclamacion-sesion .errors .message.text-danger').addClass('active');
                        jQuery('#reclamacion-sesion .errors .message.text-danger').fadeIn();
                    } else {
                        var pdf = resp['pdf'];
                        jQuery('#reclamacion-sesion #login').fadeOut();
                        jQuery('#reclamacion-sesion #sesion').fadeIn();
                        jQuery('#reclamacion-sesion .documento .tipo-doc').html(jQuery(input_tipoDoc).val());
                        jQuery('#reclamacion-sesion .documento .num-doc').html(jQuery(input_numDoc).val());
                        jQuery('#reclamacion-sesion .linea .num-linea').html(jQuery(input_numCel).val());
                        jQuery('#reclamacion-sesion .nombre .num-nombre').html(resp['user']['CLI_RAZON_SOCIAL']);
                        $('#content_clausulado #numero_linea').html(jQuery(input_numCel).val());
                        $('#content_clausulado #numero_certificado').html(resp['id']);
                        $('#content_clausulado #cert_url').attr("href", pdf);
                        $('#content_clausulado #estado_linea').html(resp['desc']);
                        $('#content_clausulado #user_event').html(resp['evento']);
                        claim(objsend, function(data) {
                            $('#sesion #consulta .table').html(data);
                        });
                    }
                    $btnSubmitLoginSesion.loading('stop');
                });
            }
        });
    }
	
	/*$('#reclamacion-sesion #loginform').on('click', function(event) {
		$('#reclamacion-sesion .errors .message.message-error').fadeOut();
		var errors = [];
		var input_tipoDoc = document.getElementById('tipo_documento');
		var input_numDoc = document.getElementById('num_documento');
		var input_numCel = document.getElementById('num_celular');
	
		if (jQuery(input_tipoDoc).val() == '') {
			event.preventDefault();
			jQuery(input_tipoDoc).addClass('invalid');
			errors.push('<p>Campo tipo documento vacio.</p>');
		}
		if (jQuery(input_numDoc).val() == '') {
			event.preventDefault();
			jQuery(input_numDoc).addClass('invalid');
			errors.push('<p>Campo número de documento vacio.</p>');
		}
		if (jQuery(input_numCel).val() == '') {
			event.preventDefault();
			jQuery(input_numCel).addClass('invalid');
			errors.push('<p>Campo número de celular vacio.</p>');
		}
		if (jQuery(input_numCel).val().length < 10) {
			event.preventDefault();
			jQuery(input_numCel).addClass('invalid');
			errors.push('<p>Número de celular incorrecta.</p>');
		}
	
		if (errors.length > 0) {
			errors.toString().replace(',', ' ');
			jQuery('#reclamacion-sesion .errors .message.message-error').html(errors);
			jQuery('#reclamacion-sesion .errors .message.message-error').addClass('active');
			jQuery('#reclamacion-sesion .errors .message.message-error').fadeIn();
			return false;
		}
		else {
			
		}
	});*/
	
	$('#sesion #reclamacion #submit').on('click', function(events) {
		jQuery('#sesion #reclamacion .errorr .message.message-error').fadeOut();
		var _validFileExtensions = [".pdf", ".jpeg", ".jpg", ".zip", ".rar", ".png"];
		var email_valid = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		var errorr = [];
		var num_linea = document.getElementById('num_linea');
		var lastname = document.getElementById('lastname');
		var name = document.getElementById('name');
		var tipo_docum = document.getElementById('tipo_docum');
		var num_docu = document.getElementById('num_docu');
		var email = document.getElementById('email');
		var tipo_solicitud = document.getElementById('tipo_solicitud');
		var descripcion = document.getElementById('descripcion');
		var archivo = document.getElementById('archivo');
		var archivos = [];
		var file64 = [];
		var sFileName = "";
	
		if (jQuery(num_linea).val() == '' || jQuery(num_linea).val().length < 10) {
			event.preventDefault();
			jQuery(num_linea).addClass('invalid');
			errorr.push('<p>Número de linea incorrecta.</p>');
		}
		if (jQuery(lastname).val() == '') {
			event.preventDefault();
			jQuery(lastname).addClass('invalid');
			errorr.push('<p>Campo apellido (s) vacio.</p>');
		}
		if (jQuery(name).val() == '') {
			event.preventDefault();
			jQuery(name).addClass('invalid');
			errorr.push('<p>Campo nombre (s) vacio.</p>');
		}
		if (jQuery(tipo_docum).val() == '') {
			event.preventDefault();
			jQuery(tipo_docum).addClass('invalid');
			errorr.push('<p>Campo tipo documento vacio.</p>');
		}
		if (jQuery(num_docu).val() == '') {
			event.preventDefault();
			jQuery(num_docu).addClass('invalid');
			errorr.push('<p>Campo número documento vacio.</p>');
		}
		if (jQuery(email).val() == '' || !email_valid.test(jQuery(email).val())) {
			event.preventDefault();
			jQuery(email).addClass('invalid');
			errorr.push('<p>Por favor verificar el campo de correo electronico.</p>');
		}
		if (jQuery(tipo_solicitud).val() == '') {
			event.preventDefault();
			jQuery(tipo_solicitud).addClass('invalid');
			errorr.push('<p>Campo tipo solicitud vacio.</p>');
		}
		if (jQuery(descripcion).val() == '') {
			event.preventDefault();
			jQuery(descripcion).addClass('invalid');
			errorr.push('<p>Por favor ingrese la descripcion de su reclamo.</p>');
		}
		if (jQuery(archivo).val() == '') {
			event.preventDefault();
			jQuery(archivo).addClass('invalid');
			errorr.push('<p>Por favor adjunte la evidencia de la solicitud.</p>');
		}else {
			for (var i = 0; i < archivo.files.length; i++) {
				var oInput = archivo.files[i];
				sFileName = oInput.name;
				var blnValid = false;
				/*for (var j = 0; j < _validFileExtensions.length; j++) {
					var sCurExtension = _validFileExtensions[j];
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						blnValid = true;
						j = _validFileExtensions.length;*/
						getBase64(oInput, function(data) {
							file64.push(data);
							/*archivos.push(sFileName);
							archivos.push(data);*/
						})
						/*break;
					}
				}
	
				if (!blnValid) {
					alert("Lo Sentimos, " + sFileName + " no es un archivo válido, las extensiones permitidas son: " + _validFileExtensions.join(", "));
					return false;
				}*/
			}
		}
	
		if (errorr.length > 0) {
			errorr.toString().replace(',', ' ');
			jQuery('#sesion #reclamacion .errorr .message.message-error').html(errorr);
			jQuery('#sesion #reclamacion .errorr .message.message-error').addClass('active');
			jQuery('#sesion #reclamacion .errorr .message.message-error').fadeIn();
			return false;
		}
		else {
			$('#sesion #reclamacion .acf-spinner').addClass('is-active');
			window.setTimeout(function() {
				var objsend = { 
					archivo: file64,
					nombreArchivo: sFileName,
					numerocel: jQuery(num_linea).val(),
					nombres: jQuery(name).val(),
					apellidos: jQuery(lastname).val(),
					tipodocum: jQuery(tipo_docum).val(),
					numdocument: jQuery(num_docu).val(),
					correo: jQuery(email).val(),
					tipoIncidencia: jQuery(tipo_solicitud).val(),
					descripcion: jQuery(descripcion).val(),
					idCobertura: jQuery('#clausulado #content_clausulado #numero_certificado').text()
				}
				//console.log(objsend);
				var settings = {
					"async": true,
					"crossDomain": true,
					"url": "/wp-content/themes/AseguraTuCel/services/create-reclamacion-login.php",
					"method": "POST",
					"headers": {
						"content-type": "application/json"
					},
					"processData": false,
					"data": JSON.stringify(objsend)
				}
	
				$.ajax(settings).done(function(response) {

					$('#sesion #reclamacion .acf-spinner').remove('is-active');
					var resp = "";
					if(response['estado'] == SUCCESS_RESPONSE){
						resp = '<h3><strong>' +response['desc']+ '</strong></h3>';
					} else {
						resp = '<h3>'+response['desc']+'</h3>';
					}
					$('#sesion #reclamacion #reclamacionform').fadeOut();
					$('#sesion #reclamacion #responseReclamo').html(resp);
					$('#sesion #reclamacion #responseReclamo').fadeIn();
				});
			}, 2000);
	
		}
	});
	
    var $formConsulta = jQuery(document.getElementById('reclamaconsultaform'));

    var $btnSubmitConsulta = $formConsulta.find('button[type="submit"]').first();
    $formConsulta.validate({
        lang: 'es',
        errorClass: "msg-error text-danger",
        errorElement: "span",
        submitHandler: function(elForm) {

            if( $btnSubmitConsulta.hasClass('inloading') ) {
                return;
            }
            $btnSubmitConsulta.loading();

            var numdocument = document.getElementById('numdocumento');
            var numlinea = document.getElementById('numlinea');

            var objsendd = {
				documento: $(numdocument).val(),
				linea: $(numlinea).val()
			};
			claim2(objsendd, function(data) {
				$('#consultaSeguro #reclamaconsultaform').fadeOut()
				$('#reclamacion-seguro #consultaSeguro #responseConsulta').fadeIn()
                $('#reclamacion-seguro #consultaSeguro #responseConsulta .table').html(data);

                $("#consulta .table .btn-warning").click(function(){
                    var idTicket = $(this).attr('id');
                    $('#consulta .otherFiles').addClass('active');
                    $('#consulta #addOtherFiles #radicadoAddFile').attr('value', idTicket);
                    $(document.body).addClass('modal-mode');
                });
                $btnSubmitConsulta.loading('stop');
			});

        }
    });
    
	
	function claim(objsend, callback) {
		localStorage.setItem('consultaLogin', JSON.stringify(objsend));
		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "/wp-content/themes/AseguraTuCel/services/consulta-reclamaciones.php",
			"method": "POST",
			"headers": {
				"content-type": "application/json"
			},
			"processData": false,
			"data": JSON.stringify(objsend)
		}
		$.ajax(settings).done(function(response) {
			//console.log(response);
			if(response.length == 0){
				var res = '<thead class="thead-dark"><tr><th scope="col">No se encontró información</th></tr></thead>';
				callback(res);
			}else{
				var resp = '<thead class="thead-dark"><tr><th scope="col" style="text-align: center;">Número</th><th scope="col" style="text-align: center;">Estado</th><th scope="col" style="text-align: center;">Fecha</th><th scope="col" style="text-align: center;">Descripción</th><th scope="col" style="text-align: center;">PDF</th><th scope="col" style="text-align: center;"></th></tr></thead><tbody>';
				for(var i = 0; response.length > i; i++){
					resp = resp+'<tr>';
					resp = resp+'<td>'+response[i].ticket+'</td>';
					if(response[i].estado.toLowerCase() == "cerrado"){
						resp = resp+'<td class="closed">'+response[i].estado+'</td>';
					}
					if(response[i].estado.toLowerCase() == "asignado"){
						resp = resp+'<td class="asigned">'+response[i].estado+'</td>';
					}
					if(response[i].estado.toLowerCase() == "creado"){
						resp = resp+'<td class="created">'+response[i].estado+'</td>';
					}
					resp = resp+'<td>'+response[i].fecha+'</td>';
					resp = resp+'<td>'+response[i].descripcion+'</td>';
					if(response[i].cartaPdf != ""){
						resp = resp+'<td><a class="btn btn-xs btn-warning bgAzulBdAzul" href="'+response[i].cartaPdf+'" target="_blank">Ver Documento</a></td>';
					}else{
						resp = resp+'<td></td>';
					}
					if(response[i].estado.toLowerCase() != "cerrado"){
						resp = resp+'<td><button class="btn btn-xs btn-warning bgAzulBdAzul" id="'+response[i].ticket+'">Anexar Archivos</button></td>';
					}else{
						resp = resp+'<td></td>';
					}
					resp = resp+'</tr>';
				}
				resp = resp+'</tbody>';
				callback(resp);
			}
		});
	}
	
	function claim2(objsend, callback) {
		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "/wp-content/themes/AseguraTuCel/services/consulta-reclamaciones.php",
			"method": "POST",
			"headers": {
				"content-type": "application/json"
			},
			"processData": false,
			"data": JSON.stringify(objsend)
		}
	
		$.ajax(settings).done(function(response) {
			if(response.length == 0){
				var res = '<thead class="thead-dark"><tr><th scope="col">No se encontró información</th></tr></thead>';
				callback(res);
			}else{
				var resp = '<thead class="thead-dark"><tr><th scope="col" style="text-align: center;">Número</th><th scope="col" style="text-align: center;">Estado</th><th scope="col" style="text-align: center;">Fecha</th><th scope="col" style="text-align: center;">Descripción</th><th scope="col" style="text-align: center;">PDF</th><th scope="col" style="text-align: center;"></th></tr></thead><tbody>';
				for(var i = 0; response.length > i; i++){
					resp = resp+'<tr>';
					resp = resp+'<td>'+response[i].ticket+'</td>';
					if(response[i].estado.toLowerCase() == "cerrado"){
						resp = resp+'<td class="closed">'+response[i].estado+'</td>';
					}
					if(response[i].estado.toLowerCase() == "asignado"){
						resp = resp+'<td class="asigned">'+response[i].estado+'</td>';
					}
					if(response[i].estado.toLowerCase() == "creado"){
						resp = resp+'<td class="created">'+response[i].estado+'</td>';
					}
					resp = resp+'<td>'+response[i].fecha+'</td>';
					resp = resp+'<td>'+response[i].descripcion+'</td>';
					if(response[i].cartaPdf != ""){
						resp = resp+'<td><a class="btn btn-xs btn-warning bgAzulBdAzul" href="'+response[i].cartaPdf+'" target="_blank">Ver Documento</a></td>';
					}else{
						resp = resp+'<td></td>';
					}
					if(response[i].estado.toLowerCase() != "cerrado"){
						resp = resp+'<td><button class="btn btn-xs btn-warning" id="'+response[i].ticket+'">Anexar Archivos</button></td>';
					} else {
						resp = resp+'<td></td>';
					}
					resp = resp+'</tr>';
				}
				resp = resp+'</tbody>';
				callback(resp);
			}
		});
	}
	
	/*var flag=0;
	setInterval(function(){
		if($(".btn-warning").length && !flag){
	        $(".btn-warning").click(function(){
	            event.preventDefault()
	            var attrClick=$(this).attr("onclick");
	            var attrArr=attrClick.split("(");
	            var id=attrArr[1].split(")")[0];
				$('#addOtherFiles #radicadoAddFile').attr('value', attrClick);
				$('#consultaSeguro .otherFiles').addClass('active');
	        })
			flag=1;
		}
	},200);*/
	
	$('#consulta .otherFiles .closeOtherFiles').click(function(){
        $('#consulta .otherFiles').removeClass('active');
        $(document.body).removeClass('modal-mode');        
	});
    
    var $formAddOtherFiles = $('#addOtherFiles');

	$formAddOtherFiles.find('#fileAdd').on('change', function(e){
        $formAddOtherFiles.find('.messages .not-selected').first().hide();
    });
	$formAddOtherFiles.find('.sumbit').first().on('click', function(e){
        e.preventDefault();
        var $this = jQuery(this);

        if( $this.hasClass('inloading') ) {
            return;
        }

        $formAddOtherFiles.find('.messages p').hide();

        var file = document.getElementById('fileAdd');

        var $file = $(file);
		if ( file.files.length <= 0 ) {
            $file.addClass('invalid');
            $formAddOtherFiles.find('.messages .not-selected').first().show();
			return;
        }
        
        var oInput = file.files[0];

        if ( oInput.type != "application/pdf" ) {
            $formAddOtherFiles.find('.messages .not-pdf').first().show();
            return;
        }

        $this.loading();
        
        getBase64(oInput, function(data) {
            var file64 = [data];

            var obj = {
				file : file64,
				archivo: oInput.name,
				radicado : $('#radicadoAddFile').val()
			};
			//console.log(obj);
			var settings = {
				"crossDomain": true,
				"url": "/wp-content/themes/AseguraTuCel/services/addFileReclamacion.php",
				"method": "POST",
				"headers": {
					"content-type": "application/json"
				},
				"processData": false,
				"data": JSON.stringify(obj)
			};


			$.ajax(settings).done(function(response) {
                var $divOutput = $formAddOtherFiles.find('.messages .output').first();
                $divOutput.html(response['desc']);
                $divOutput.show();
                window.setTimeout(function() {
                    $('#consulta .otherFiles').removeClass('active');
                    $(document.body).removeClass('modal-mode');        
                    $this.loading('stop');
                    $divOutput.hide();
                    $file.val("");
                    $formAddOtherFiles.trigger('reset');
                },2500);
            }).fail(function(error) {
                $formAddOtherFiles.find('.messages .fail').first().show();
                $this.loading('stop');
                $formAddOtherFiles.trigger('reset');
            });
            
        });
                
		
	});
    
	$("#consultLogin").on('click', function(){
		var consultaLogin = JSON.parse(localStorage.getItem('consultaLogin'));
		//console.log(consultaLogin);
		claim(consultaLogin, function(data) {
			$('#sesion #consulta .table').html(data);
		});
	});
});
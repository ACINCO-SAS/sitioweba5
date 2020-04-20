<?php 
/**
 * 
 * Template Name: Tramites y Reclamaciones
 *
 **/

get_header(); 

the_post();

//$urlForm = network_site_url('/wp-content/themes/AseguraTuCel/services/create-reclamacion.php');
$urlForm = network_site_url('/wp-json/acinco/v1/claims');

$urlFileClaim = get_field('url_claim_format_file');
?>

<div id="reclamacion-seguro" class="p0">
    <?php get_template_part('components/banner','image_right'); ?>
    <div id="SeguroReclamacion" class="container mb12 mt4">
        <div class="container-seguros">
            <div>
                <ul class="btn-tabs">
                    <li class="active"><a data-toggle="tab" href="#reclamacion">Crear</a></li>
                    <li><a data-toggle="tab" href="#consultaSeguro">Consultar</a></li>
                    <?php if( $urlFileClaim ) { ?>
                    <li><a href="<?php echo reSiteUrl($urlFileClaim); ?>" target="_blank" class="mybtn mybtn-icon mybtn-icon-right">Formato Reclamación<i class="icon icon-pdf"></i></a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <div id="reclamacion" class="tab-pane fade in active pt6">
                        <h1 class="p0 helv-md"><?php _e('Trámite o Reclamación','acinco'); ?><span class="required">*</span></h3>
                        <form id="form-reclama-seguro" enctype="multipart/form-data" class="reclamacion-form" name="formReclamaSeguro" method="post" action="<?php echo $urlForm; ?>" novalidate="">
                            <h3 class="pt2 pb2 helv-md"><?php _e('Datos básicos del titular','acinco'); ?><span class="required">*</span></h3>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label><?php _e('Número de línea Tigo','acinco'); ?><span class="required">*</span></label>
                                    <input class="form-control" type="number" placeholder="" name="num_line" required="">
                                </div>
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label><?php _e('Apellido (s)','acinco'); ?><span class="required">*</span></label>
                                    <input class="form-control" type="text" placeholder="" name="lastname" required="">
                                </div>
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label><?php _e('Nombre (s)','acinco'); ?><span class="required">*</span></label>
                                    <input class="form-control" type="text" placeholder="" name="fullname" required="">
                                </div>
                            </div>
                            <hr class="noline"/>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label><?php _e('Tipo de documento','acinco'); ?><span class="required">*</span></label>
                                    <select class="form-control" name="type_dni" required="">
                					    <option value=""><?php _e('Selecciona','acinco'); ?></option>
                		                <option value="cedula"><?php _e('Cédula de Ciudadanía','acinco'); ?></option>
                		                <option value="nit"><?php _e('NIT','acinco'); ?></option>
                		                <option value="ce"><?php _e('Cédula de Extranjeria','acinco'); ?></option>
                		                <option value="pasaporte"><?php _e('Pasaporte','acinco'); ?></option>
                		            </select>
                                </div>
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label><?php _e('Número de documento','acinco'); ?><span class="required">*</span></label>
                                    <input class="form-control" type="number" placeholder="" name="dni" required=""/>
                                </div>
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label><?php _e('Correo Electrónico','acinco'); ?><span class="required">*</span></label>
                                    <input class="form-control" type="email" placeholder="" name="email" required=""/>
                                </div>
                            </div>
                            <h3 class="pt2 pb2 helv-md"><?php _e('Datos de la solicitud','acinco'); ?><span class="required">*</span></h3>
                            <div class="row">
                                <div class="col-md-12">
                                <?php if($urlDocumentation = get_field('documentacion')): ?>
                                        <a href="<?php echo $urlDocumentation; ?>" target="_blank" class="helv-md txt1-8rem pb2 dtable border-r18 cursorPoint"><?php _e('Consulta la documentación requerida','acinco'); ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>documentacion/" target="_blank" class="helv-md txt1-8rem pb2 dtable border-r18 cursorPoint"><?php _e('Consulta la documentación requerida','acinco'); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label><?php _e('Tipo de trámite','acinco'); ?><span class="required">*</span></label>
                                    <select class="form-control" name="type_request" required="">
                					    <option value=""><?php _e('Selecciona','acinco'); ?></option>
                					    <option value="3"><?php _e('Reclamación por siniestro','acinco'); ?></option>
                		                <option value="1"><?php _e('Envío documentos','acinco'); ?></option>
                		                <option value="2"><?php _e('Cancelación del seguro','acinco'); ?></option>
                		                <option value="6"><?php _e('Actualización de equipo','acinco'); ?></option>
                		            </select>
                                </div>
                                <div class="col-sm-12 col-md-8 form-group">
                                    <label><?php _e('Adjuntar Soportes','acinco'); ?><span class="required">*</span></label>
                                    <input class="form-input" data-lblbtn="<?php _e('Escoger archivo','acinco'); ?>" type="file" name="file" required="" data-myaccept=".pdf,.jpg,.png,.doc,.docx" data-novalidmsg="<?php _e('Archivos permitidos: .pdf, .doc, .docx, .jpg, .png','acinco'); ?>" />
                                    <?php printf(__('Tamaño máximo de archivo: <b>%s</b>'),size_format( wp_max_upload_size() )); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <label><?php _e('Descripción de solicitud','acinco'); ?><span class="required">*</span></label>
                                    <textarea class="form-control" rows="15" cols="40" name="description" required=""></textarea>
                                </div>
                            </div>
                            <div class="mt2">
                                <button type="submit" class="mybtn mybtn-primary mybtn-green"><?php _e('Enviar solicitud','acinco'); ?></button>
                            </div>
                        </form>
                        <div class="errorr col-sm-12 p0 txtac">
                            <div class="col-sm-12 col-md-4">
                                <div class="message message-success"></div>
                                <div class="message message-error"></div>
                            </div>
                        </div>
                        <div id="responseReclamo" class="col-sm-12 mb12" style="display: none;">
							<div id="respCreateReclam"></div>
                            <div class="col-md-12 pt3 pb3 txtac">
                                <div class="container-seguros">
                                    <div class="w50 p0 mauto">
                                        <a href="/reclamacion-seguro" class="cblanco btntxt-white">
                                            <div class="col-sm-12 p0 pt3 pb3 bgverde txtac txt2rem border-r18 ">Aceptar</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
						</div>
                    </div>




                    
                    <div id="consultaSeguro" class="tab-pane fade">
                        <div id="consulta">
                            <h1 class="pt6 pb3 helv-md txtac"><?php _e('¿Ya tienes un trámite o reclamación? ¡Consultalo!','acinco'); ?></h1>
                            <div class="table">
                                <form class="reclamacion-consulta-form" name="reclamaconsultaform" id="reclamaconsultaform" method="post" novalidate="novalidate">
                                    <div class="row p0">
                                        <div class="col-sm-12 col-md-4 form-group box-centered">
                                            <div class="form-group">
                                                <label><?php _e('Número de documento','acinco'); ?></label>
                                                <input class="form-control" type="number" placeholder="" name="numdocumento" id="numdocumento" required="" value="">
                                            </div>
                                            <div class="form-group">
                                                <label><?php _e('Número de celular','acinco'); ?></label>
                                                <input class="form-control" type="password" placeholder="" name="numlinea" id="numlinea" required="" value="">
                                            </div>
                                            <button id="submitConsulta" type="submit" class="mybtn mybtn-primary mybtn-green"><?php _e('Consultar','acinco'); ?></button>
                                        </div>
                                    </div>
                                </form>
    							<div class="otherFiles hide">
                                    <div class="closeOtherFiles"></div>
                                    <form class="addOtherFiles txtac" name="addOtherFiles" id="addOtherFiles">
                                        <input type="file" id="fileAdd" class="" data-myaccept=".pdf" data-novalidmsg="<?php _e('Archivos permitidos: .pdf','acinco'); ?>" data-lblbtn="<?php _e('Seleccionar documento','acinco'); ?>" />
                                        <input type="hidden" id="radicadoAddFile"/>
                                        <div class="messages">
                                            <p class="normal output" style="display: none;"></p>
                                            <p class="error not-selected" style="display: none;"><?php _e('Por favor seleccione un documento.','acinco'); ?></p>
                                            <p class="error fail" style="display: none;"><?php _e('Algo salió mal. Intente nuevamente.','acinco'); ?></p>
                                            <p class="error not-pdf" style="display: none;"><?php _e('Tipo de documento no permitido.','acinco'); ?></p>
                                        </div>
                                        <div class="block-center">
                                            <button class="sumbit mybtn mybtn-primary mybtn-green">Enviar Archivo</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="error-consulta col-sm-12 p0 txtac">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="message message-success"></div>
                                        <div class="message message-error"></div>
                                    </div>
                                </div>
                                <div id="responseConsulta" class="col-sm-12 mb12 p0">
                                    <div class="table-responsive">
                                        <table class="table table-condensed table-striped table-bordered" style="text-align: center; margin-left:0px;"></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
window.addEventListener('DOMContentLoaded', function(){
    
    var $form = jQuery(document.getElementById('form-reclama-seguro'));

    var $btnSubmit = $form.find('button[type="submit"]').first();
    var validator = $form.validate({
        lang: 'es',
        errorClass: "msg-error text-danger",
        errorElement: "span",
        submitHandler: function(elForm) {

            if( $btnSubmit.hasClass('inloading') ) {
                return;
            }
            $btnSubmit.loading();

            var files64 = [];
            var fileName = 'no_name';

            var dataForm = new FormData();

            dataForm.append('num_line', $form.find('input[name="num_line"]').first().val());
            dataForm.append('fullname', $form.find('input[name="fullname"]').first().val());
            dataForm.append('lastname', $form.find('input[name="lastname"]').first().val());
            dataForm.append('type_dni', $form.find('select[name="type_dni"]').first().val());
            dataForm.append('dni', $form.find('input[name="dni"]').first().val());
            dataForm.append('email', $form.find('input[name="email"]').first().val());
            dataForm.append('type_request', $form.find('select[name="type_request"]').first().val());
            dataForm.append('description', $form.find('textarea[name="description"]').first().val());

            dataForm.append('file', $form.find('input[name="file"]').get(0).files[0]);
            

            jQuery.ajax({ 
                contentType: false, 
                processData: false,
                type: 'post',
                url: "<?php echo $urlForm; ?>",
                dataType: 'json',
                data: dataForm,
            }).done(function(response){

                if( [SUCCESS_RESPONSE,PROCESS_RESPONSE].indexOf(response['estado']) >= 0 ) {
                    toastr.success(response.desc, "<?php _e('Radicado:','acinco'); ?> "+response.radicado,{timeOut: 0,extendedTimeOut: 0,tapToDismiss: false,closeButton: true});

                    validator.resetForm();
                    $form.trigger("reset");
                } else {
                    toastr.error(response.desc, "<?php _e('Error:','acinco'); ?>",{timeOut: 0,extendedTimeOut: 0,tapToDismiss: false,closeButton: true});
                }
                $btnSubmit.loading('stop');

            }).fail(function(error){
                if ( error.responseJSON && error.responseJSON.message ) {
                    toastr.error(error.responseJSON.message, "<?php _e('Error','acinco'); ?>");
                } else if(error.status == 413 ) {
                    toastr.error("<?php _e('El archivo adjuntado es muy pesado. Intente con uno menor a 1MB (Mega byte) ','acinco'); ?>", "<?php _e('Error','acinco'); ?>");
                } else {
                    toastr.error("<?php _e('Algo salió mal. Intente nuevamente.','acinco'); ?>", "<?php _e('Error Inesperado','acinco'); ?>");
                }
                $btnSubmit.loading('stop');
            });

                

        }
    });
}, false);
</script>
<?php get_footer(); ?>
<?php 
/**
 * 
 * Template Name: Reclamacion Sesion
 *
 **/

get_header(); 

the_post();
?>
<div id="reclamacion-sesion" class="">
    <?php get_template_part('components/banner','image_right'); ?>
    <div class="container">
        <div id="login" class="mb12 mb12 box-centered" style="min-width: 315px;">
            <h3 class="text-size-4r mb3 mt3 helv-md text-center">INICIAR SESIÓN</h3>
            <div>
                <form class="login-form" name="loginform" id="loginform" method="post" novalidate="novalidate">
                    <div class="form-group tipo_doc">
                        <label>Tipo de documento</label>
                        <select class="form-control" name="tipo_documento" id="tipo_documento" required="">
                            <option value="">Selecciona</option>
                            <option value="cedula" selected>Cédula de Ciudadanía</option>
                            <option value="nit">NIT</option>
                            <option value="ce">Cédula de Extranjeria</option>
                            <option value="pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group documento">
                        <label>Número de documento</label>
                        <input class="form-control" type="number" placeholder="" name="num_documento" id="num_documento" required="">
                    </div>
                    <div class="form-group celular">
                        <label>Número de celular</label>
                        <input class="form-control" type="password" placeholder="" name="num_celular" id="num_celular" required="">
                    </div>
                    <div class="form-group submit p0">
                        <button id="wp-submit" class="mybtn mybtn-primary mybtn-green">Ingresar</button>
                    </div>
                </form>
                <div class="errors p0 mt2">
                    <div class="message text-success txt16px"></div>
                    <div class="message text-danger txt16px"></div>
                </div>
            </div>
        </div>
        <div id="sesion" class="mb12" style="display: none;">
            <div class="mb4">
                <div class="row">
                    <div class="col-sm-1">
                        <img src="/wp-content/uploads/2018/08/registrodeusuarios-e1534888419778.png" alt=""/>
                    </div>
                    <div class="col-sm-4 documento">
                        <h2 class="m0 helv-md fn-2m">Documento</h2>
                        <h3 class="tipo-doc m0 mt3 helvlt fn-2m"></h3>
                        <h3 class="num-doc m0 helvlt fn-2m"></h3>
                    </div>
                    <div class="col-sm-4 linea">
                        <h2 class="m0 helv-md fn1-7m">Número Celular</h2>
                        <h3 class="num-linea m0 mt3 helvlt fn1-7m"></h3>
                    </div>
                    <div class="col-sm-3 nombre">
                        <h2 class="m0 helv-md fn1-7m">Nombre</h2>
                        <h3 class="num-nombre m0 mt3 helvlt fn1-7m"></h3>
                    </div>
                </div>
            </div>
            <div class="">
                <ul class="list-inline btn-tabs">
                    <li class="active"><a data-toggle="tab" href="#reclamacion">Crear Reclamación</a></li>
                    <li><a data-toggle="tab" href="#consulta" id="consultLogin">Consultar</a></li>
                    <li><a data-toggle="tab" href="#clausulado">Ver mi información</a></li>
                    <li><a href="/wp-content/uploads/2018/09/Formato_Reclamacion_AXA_COLPATRIA.pdf" target="_blank">Descargar Formato Reclamación</a></li>
                    <li><a data-toggle="tab" href="" id="cerrar-sesion">Cerrar sesión</a></li>
                </ul>
            
                <div class="tab-content pt6">
                    <div id="reclamacion" class="tab-pane fade in active col-sm-12">
                        <h1 class="p0 helv-md">CREAR RECLAMACIÓN</h3>
                        <form class="reclamacion-form" name="reclamacionform" id="reclamacionform" method="post" novalidate="novalidate">
                            <h3 class="p0 pt2 pb2 helv-md">Datos básicos del titular</h3>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Número de línea Tigo</label>
                                    <input class="form-control" type="number" placeholder="" name="num_linea" id="num_linea" required="">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Apellido (s)</label>
                                    <input class="form-control" type="text" placeholder="" name="lastname" id="lastname" required="">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Nombre (s)</label>
                                    <input class="form-control" type="text" placeholder="" name="name" id="name" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Tipo de documento</label>
                                    <select class="form-control" name="tipo_docum" id="tipo_docum" required="">
                                        <option value="">Selecciona</option>
                                        <option value="cedula">Cédula de Ciudadanía</option>
                                        <option value="nit">NIT</option>
                                        <option value="ce">Cédula de Extranjeria</option>
                                        <option value="pasaporte">Pasaporte</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Número de documento</label>
                                    <input class="form-control" type="number" placeholder="" name="num_docu" id="num_docu" required="">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Correo Electrónico</label>
                                    <input class="form-control" type="text" placeholder="" name="email" id="email" required="">
                                </div>
                            </div>
                            <h3 class="p0 pt2 pb2 helv-md">Datos de la solicitud</h3>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Tipo de solicitud</label>
                                    <select class="form-control" name="tipo_solicitud" id="tipo_solicitud" required="">
                                        <option value="">Selecciona</option>
                                        <option value="1">Envío documentos</option>
                                        <option value="2">Cancelación</option>
                                        <option value="3">Reclamación</option>
                                        <option value="6">Actualización de equipo</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Evidencia de solicitud</label>
                                    <input class="form-control" type="file" name="archivo" id="archivo">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <?php if(get_field('documentacion_sesion')): ?>
                                        <label>&nbsp;</label>
                                        <a href="<?php echo get_field('documentacion_sesion') ?>" target="_blank" class="helv-md txt1-8rem pt2 pb2 pl2 pr2 dtable border-r18 button-large txtac cursorPoint w100">
                                            Consulta la documentación requerida
                                        </a>
                                    <?php else: ?>
                                        <label>&nbsp;</label>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>documentacion/" target="_blank" class="helv-md txt1-8rem pt2 pb2 pl2 pr2 dtable border-r18 button-large txtac cursorPoint w100">
                                            Consulta la documentación requerida
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 form-group">
                                    <label>Descripción de solicitud</label>
                                    <textarea name="descripcion" class="form-control" rows="15" cols="40" name="descripcion" id="descripcion" required=""></textarea>
                                </div>
                            </div>
                            <div class="row mt2">
                                <div id="submit" class="col-sm-4 form-group p0 pt1 pb1 bgverde cblanco cursorPoint txtac txt2rem border-r18">
                                    Enviar solicitud
                                </div>
                                <i class="acf-spinner"></i>
                            </div>
                        </form>
                        <div class="errorr row p0 txtac">
                            <div class="col-sm-4">
                                <div class="message message-success"></div>
                                <div class="message message-error"></div>
                            </div>
                        </div>
                        <div id="responseReclamo" class="mb12" style="display: none;"></div>
                    </div>
                    <div id="consulta" class="tab-pane fade">
                        <h1 class="col-sm-12 p0">Reclamaciones</h3>
                        <div class="col-sm-12 p0">
                            <table class="table table-condensed table-striped table-bordered" style="text-align: center; margin-left:0px;"></table>
                        </div>
                        <div class="otherFiles col-md-12">
                            <div class="closeOtherFiles"></div>
                            <form class="addOtherFiles txtac" name="addOtherFiles" id="addOtherFiles">
                                <input type="file" id="fileAdd" class="col-md-12">
                                <input type="hidden" id="radicadoAddFile"/>
                                <button class="sumbit mybtn mybtn-primary mybtn-green">
                                    Enviar Archivo
                                </button>
                                <i class="acf-spinner"></i>
                            </form>
                        </div>
                    </div>
                    <div id="clausulado" class="tab-pane fade table-responsive">
                        <table id="content_clausulado" class="table table-condensed table-striped table-bordered" style="text-align: center; margin-left:0px;">
                            <tbody>
                                <tr>
                                    <th style="text-align: center;" colspan="4">LINEA</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;" colspan="4" id="numero_linea"></th>
                                </tr>
                                <tr>
                                    <td>Certificado</td>
                                    <td>
                                        <span id="numero_certificado"></span>
                                        <a target="_blank" href="" class="btn btn-warning bgAzulBdAzul" id="cert_url">Certificado individual</a>
                                    </td>
                                    <td>Estado</td>
                                    <td>
                                        <b><span id="estado_linea"></span></b>
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <td colspan="2">Evento Asociado</td>
                                    <td colspan="2" id="user_event"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Clausulado General</td>
                                    <td colspan="2"><a target="_blank" href="http://docs.wixstatic.com/ugd/129af2_3f03649937704fe797c1f149d6acd6a8.pdf" class="btn btn-danger bgAzulBdAzul">Clausulado General</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
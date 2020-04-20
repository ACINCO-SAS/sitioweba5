<?php 
/**
 * 
 * Template Name: Producto
 *
 **/

get_header();

the_post();
?>
<?php $banner = get_field('seleccione_una_opcion_para_el_banner'); ?>
<div class="lienzo p0">
    <?php get_template_part('components/banner','image_right'); ?>
    <div class="container">
        <div class="apps all-desc-banner z-index">
            <!--<div class="row">
                <div class="col-md-12">
                <ul class="list-inline logos-apps">
                    <?php if(have_rows('logos_apps')) :  ?>
                    <?php while(have_rows('logos_apps')) : the_row(); ?>
                    <li>
                            <a href="<?php the_sub_field('url') ?>" target="_blank">
                                <?php $logo = get_sub_field('imagen'); ?>
                                <img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['alt'] ?>">
                            </a> 
                    </li>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </ul> 
                </div>
            </div>
            <div class="col-sm-6 p0">
                <a href="<?php the_field('link_del_boton') ?>" class="cblanco btntxt-white">
                    <div class="col-sm-12 p0 pt3 pb3 bgverde txtac txt2rem border-r18 "><?php the_field('boton') ?></div>
                </a>
            </div>-->
        </div>
        <?php if(have_rows('pasos_para_activarlo')) { ?>
        <div class="help-active content-category pt3 p0">
            <div class="title-active pt4 pb6">
                <h2 class="text-size-5r helv-md"><?php the_field('titulo_como_activarlo'); ?></h2>
            </div>
            <div class="pb4">
                
                <?php
                    echo '<div class="row">';

                    $ncol = 2;
                    $i = 0;
                    $j = 0;
                    $total = count(get_field('pasos_para_activarlo'));

                    while(have_rows('pasos_para_activarlo')) {
                        the_row();

                        if( $i != 0 && $i%$ncol == 0 ) {
                            echo '<div class="row">';
                        }
                    ?>
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <div class="col-md-4 mb3">
                                    <div class="img-pasos">
                                        <?php $img_paso = get_sub_field('imagen'); ?>
                                        <img src="<?php echo $img_paso['url'] ?>" alt="<?php echo $img_paso['alt'] ?>" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-8 mb3">
                                    <div class="num-pasos">
                                        <h2><strong><?php echo $i; ?></strong></h2>
                                    </div>
                                    <div class="desc-pasos helvlt">
                                        <?php the_sub_field('descripcion'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    <?php 
                        if( ($i + 1)%$ncol == 0) {
                            echo '</div>';
                        }
                        $i++;
                        $j++;
                    }
                    if( $i%$ncol != 0) {
                        echo '</div>';
                    }
                    ?>
            </div>
        </div>
        <?php 
        } 
        
        if( have_rows('logos_apps') ) {
            $urlLogoProteccionMovil = get_field('logo_proteccion_movil');
            if( !$urlLogoProteccionMovil ) {
                $urlLogoProteccionMovil = 'https://via.placeholder.com/150';
            }
        ?>
        <div class="apps all-desc-banner z-index pb4 mb4">
            <div class="row d-flex">
                <div class="col-md-7 d-flex txtar">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo $urlLogoProteccionMovil; ?>"/>
                        </div>
                        <div class="col-md-5">
                            <h3>Protección Móvil
                            <strong>Descargala en:</strong></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <ul class="list-inline logos-apps">
                        <?php while(have_rows('logos_apps')) { the_row(); ?>
                            <li class="" style="display: -webkit-box;">
                                <a href="<?php the_sub_field('url') ?>" target="_blank">
                                    <?php $logo = get_sub_field('imagen'); ?>
                                    <img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['alt'] ?>">
                                </a> 
                            </li>
                        <?php } ?>
                    </ul> 
                </div>
            </div>
        </div>
        <?php } 
        if( have_rows('coberturas') ) {
            $coberturas = get_field('coberturas');

        ?>
        <div class="content-coberturas bgacinco">
            <div>
                <div class="title-active pb4">
                    <h2 class="text-size-5r helv-md"><?php the_field('titulo_coberturas'); ?></h2>
                </div>
                <?php 
                if( !(count($coberturas) < 3) ) {
                    echo '<div class="row pb4">';
                    while(have_rows('coberturas')) { the_row();
                    ?>
                    <div class="col-md-3">
                        <div class="img-cob text-center">
                            <?php $img_cob = get_sub_field('imagen'); ?>
                            <img src="<?php echo $img_cob['url']; ?>" alt="<?php echo $img_cob['alt']; ?>" class="img-responsive">
                        </div>
                        <div class="desc-cob text-center">
                            <?php the_sub_field('descripcion'); ?>
                        </div>
                    </div>
                    <?php 
                    }//End while
                    echo '</div>';
                } else {
                    while(have_rows('coberturas')) { the_row();
                        echo '<div class="row pb4">';
                    ?>
                    <div class="col-md-2">
                        <div class="img-cob text-center">
                            <?php $img_cob = get_sub_field('imagen'); ?>
                            <img src="<?php echo $img_cob['url']; ?>" alt="<?php echo $img_cob['alt']; ?>" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="desc-cob">
                            <?php the_sub_field('descripcion'); ?>
                        </div>
                    </div>
                    <?php 
                        echo '</div>';
                    }//End while
                }//End if ?>
            </div>
        </div>
        <?php
        }
        $botonTerms = array(
            'text' => get_field('boton'),
            'link' => get_field('link_del_boton'),
        );
        if( $botonTerms['text'] && $botonTerms['link'] ) {
        ?>
        <div class="pt3 pb3 txtac">
            <div class="container-seguros">
                <div class="w50 p0 mauto">
                    <a href="<?php echo reSiteUrl($botonTerms['link']); ?>" class="cblanco btntxt-white">
                        <div class="pl4 pr4 pt4 pb4 bgverde txtac txt2rem border-r18 block-center"><?php echo $botonTerms['text']; ?></div>
                    </a>
                </div>
            </div>
        </div>
        <?php
        }
        if( $htmlRecobros = get_field('recobros') ) { ?>
        <div id="recobro" class="pt3 pb3">
            <div class="container-seguros">
                <h1 class="text-size-5r pb4 helv-md">Recobros</h1>
                <div class="row">
                    <?php echo $htmlRecobros; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <div id="exclusiones" class="exclusionesproduct pt3 pb3 mb3">
            <div class="container-seguros">
                <h1 class="helv-md text-size-5r pb4"><?php the_field('titulo_exclusiones'); ?></h1>
                <div class="show-mobile">
                    <ul class="excluded-items txt2rem helvlt">
                        <li><?php echo strip_tags(get_field('exclusionestext1')); ?></li>
                        <li><?php echo strip_tags(get_field('exclusionestext2')); ?></li>
                        <li><?php echo strip_tags(get_field('exclusionestext3')); ?></li>
                        <li><?php echo strip_tags(get_field('exclusionestext4')); ?></li>
                    </ul>
                </div>
                <div class="show-desktop">
                    <div class="row p0 txtac">
                        <div class="col-sm-4 p0 helvlt txt2rem">
                            <?php the_field('exclusionestext1'); ?>
                        </div>
                        <div class="col-sm-4 p0"></div>
                        <div class="col-sm-4 p0 helvlt txt2rem">
                            <?php the_field('exclusionestext2'); ?>
                        </div>
                    </div>
                    <?php if( $imageExclusiones = get_field('exclusionesimagen') ) { ?>
                    <div class="row p0 txtac">
                        <div class="col-sm-4 p0"></div>
                        <div class="col-sm-4 p0">
                            <img src="<?php echo $imageExclusiones; ?>" alt="exclusiones" class="w100" />
                        </div>
                        <div class="col-sm-4 p0"></div>
                    </div>
                    <?php } ?>
                    <div class="row p0 txtac">
                        <div class="col-sm-4 p0 helvlt txt2rem">
                            <?php the_field('exclusionestext3'); ?>
                        </div>
                        <div class="col-sm-4 p0"></div>
                        <div class="col-sm-4 p0 helvlt txt2rem">
                            <?php the_field('exclusionestext4'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php $terminos = get_field('link_terminos');
                        $clausula = get_field('link_clausula');
                        if($terminos != ""){ ?>
                            <a class="col-md-6 txtac mt3 cazul fn1-2m helv-md" href="<?php echo reSiteUrl($terminos); ?>" target="_blank">
                                <div class="txtac mt3 cazul fn1-2m helv-md txt-underline">
                                    Ver términos y condiciones
                                </div>
                            </a>
                        <?php }
                        if($clausula != ""){ ?>
                            <a class="col-md-6 txtac mt3 cazul fn1-2m helv-md" href="<?php echo reSiteUrl($clausula); ?>" target="_blank">
                                <div class="txtac mt3 cazul fn1-2m helv-md txt-underline">
                                    Clausulado Póliza #34
                                </div>
                            </a>
                        <?php } 
                    ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php get_footer(); ?>
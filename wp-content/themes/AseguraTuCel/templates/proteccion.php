<?php 
/**
 * 
 * Template Name: Producto - Proteccion
 *
 **/

get_header();

the_post();
?>

<div id="content-proteccion" class="p0">
    <?php get_template_part('components/banner','image_right'); ?>
    <div class="container">
        <div id="activarlo" class="pt3">
            <h1 class="p0 text-size-5r pb3 helv-md">¿Cómo activarlo?</h1>
            <div class="pb4">
                <?php 
                    $count = 0;
                    $total = count(get_field('activarlo'));
                    if( have_rows('activarlo') ):
                        while ( have_rows('activarlo') ) : the_row();
                            if($count % 2 == 0){?>
                                <div class="row p0 d-flex mb3">
                                    <div class="col-sm-6 text-center">
                                        <img class="" src="<?php the_sub_field('imagen'); ?>"/>
                                    </div>
                                    <div class="col-sm-6 desc-activarlo txt2rem helvlt">
                                        <?php the_sub_field('texto'); ?>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="row p0 d-flex">
                                    <div class="col-sm-6 desc-activarlo txt2rem helvlt">
                                        <?php the_sub_field('texto'); ?>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <img class="" src="<?php the_sub_field('imagen'); ?>"/>
                                    </div>
                                </div>
                            <?php } $count++;
                        endwhile;
                    endif;
                ?>
            </div>
        </div>
        <div class="apps all-desc-banner z-index pb4">
            <ul class="list-inline logos-apps txtac">
                <?php if(have_rows('logos_apps')) :  ?>
                    <?php while(have_rows('logos_apps')) : the_row(); ?>
                    <li class="">
                        <a href="<?php echo reSiteUrl(get_sub_field('url')); ?>" target="_blank">
                            <?php $logo = get_sub_field('imagen'); ?>
                            <img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['alt'] ?>">
                        </a> 
                    </li>
                    <?php endwhile; ?>
                <?php endif; ?>
        </ul>
        </div>
        <div id="coberturas" class="bgacinco pt3 pb3 p0">
            <h1 class="text-size-5r pb4 helv-md">Coberturas</h1>
            <div class="row">
                <?php 
                    $totalcober = count(get_field('coberturas'));
                    if( have_rows('coberturas') ):
                        while ( have_rows('coberturas') ) : the_row(); ?>
                            <div class="col-sm-4 txtac">
                                <div class="p0">
                                    <img class="" src="<?php the_sub_field('imagen'); ?>" />
                                </div>
                                <div class="p0 helv-md txt2rem">
                                    <h3><?php the_sub_field('titulo'); ?></h3>
                                </div>
                                <div class="p0 helvlt txt2rem">
                                    <?php the_sub_field('contenido'); ?>
                                </div>
                            </div>
                        <?php endwhile;
                    endif;
                ?>
            </div>
            <div class="pt3 pb3 txtac">
                <div class="container-seguros">
                    <div class="w50 p0 mauto">
                        <a href="<?php echo reSiteUrl(get_field('link_del_boton')); ?>" class="cblanco btntxt-white">
                            <div class="p0 pt3 pb3 bgverde txtac txt2rem border-r18 ">Trámites y Reclamaciones</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="recobro" class="pt3 pb3">
            <h1 class="text-size-5r pb4 helv-md">Recobros</h1>
            <div class="row">
                <?php the_field('recobros'); ?>
            </div>
        </div>
    </div>
    <div class="bggris">
        <div id="exclusiones" class="container pt3 pb3 p0">
            <h1 class="helv-md text-size-5r pb4"><?php the_field('titulo_exclusiones'); ?></h1>
            <div class="show-mobile">
                <ul class="excluded-items txt2rem helvlt">
                    <li><?php echo strip_tags(get_field('exclusiones_text_1')); ?></li>
                    <li><?php echo strip_tags(get_field('exclusiones_text_2')); ?></li>
                    <li><?php echo strip_tags(get_field('exclusiones_text_3')); ?></li>
                    <li><?php echo strip_tags(get_field('exclusiones_text_4')); ?></li>
                </ul>
            </div>
            <div class="show-desktop">
                <div class="row p0 txtac">
                    <div class="col-sm-4 p0 helvlt txt2rem">
                        <?php the_field('exclusiones_text_1'); ?>
                    </div>
                    <div class="col-sm-4 p0"></div>
                    <div class="col-sm-4 p0 helvlt txt2rem">
                        <?php the_field('exclusiones_test_2'); ?>
                    </div>
                </div>
                <div class="row p0 txtac">
                    <div class="col-sm-4 p0"></div>
                    <div class="col-sm-4 p0">
                        <img src="<?php the_field('exclusiones_imagen'); ?>" alt="exclusiones" class="w100"/>
                    </div>
                    <div class="col-sm-4 p0"></div>
                </div>
                <div class="row p0 txtac">
                    <div class="col-sm-4 p0 helvlt txt2rem">
                        <?php the_field('exclusiones_text_3'); ?>
                    </div>
                    <div class="col-sm-4 p0"></div>
                    <div class="col-sm-4 p0 helvlt txt2rem">
                        <?php the_field('exclusiones_text_4'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="funcionalidades" class="pt3 pb3">
            <h1 class="p0 text-size-5r pb3 helv-md">Funcionalidades</h1>
            <div class="p0">
                <?php 
                    $countfuncio = 0;
                    $countfuncio1 = 1;
                    $totalfuncio = count(get_field('funcionalidades'));
                    if( have_rows('funcionalidades') ):
                        while ( have_rows('funcionalidades') ) : the_row(); ?>
                            <?php if($countfuncio1 != 2){ ?>
                            <div class="row p0 yes">
                                <div class="col-sm-6">
                                    <div class="p0 d-flex">
                                        <div class="col-sm-2 pb4">
                                            <img class="" src="<?php the_sub_field('imagen'); ?>"/>
                                        </div>
                                        <div class="col-sm-10 helv-md txt2rem pb4">
                                            <?php the_sub_field('titulo'); ?>
                                        </div>
                                    </div>
                                    <div class="pb4 helvlt txt2rem mt2 mb3">
                                        <?php the_sub_field('contenido'); ?>
                                    </div>
                                </div>
                            <?php $countfuncio1++; } else { ?>
                                <div class="col-sm-6 no">
                                    <div class="row p0 d-flex">
                                        <div class="col-sm-2 pb4">
                                            <img class="" src="<?php the_sub_field('imagen'); ?>"/>
                                        </div>
                                        <div class="col-sm-10 helv-md txt2rem pb4">
                                            <?php the_sub_field('titulo'); ?>
                                        </div>
                                    </div>
                                    <div class="pb4 helvlt txt2rem mt2 mb3">
                                        <?php the_sub_field('contenido'); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $countfuncio1 = 1; }
                            $countfuncio++;
                            if($countfuncio == $totalfuncio){
                                ?></div><?php
                            }
                        endwhile;
                    endif;
                ?>
            </div>
        </div>
        <div id="coberturas-terminos" class="bgacinco pt3 pb3 p0">
            <div class="row">
                <?php $terminos = get_field('link_terminos');
                    $clausula = get_field('link_clausula');
                    if($terminos != ""){ ?>
                        <a class="col-md-6 txtac mt3 cazul fn1-2m helv-md" href="<?php echo reSiteUrl($terminos); ?>">
                            <div class="txtac mt3 cazul fn1-2m helv-md">
                                Ver términos y condiciones
                            </div>
                        </a>
                    <?php }
                    if($clausula != ""){ ?>
                        <a class="col-md-6 txtac mt3 cazul fn1-2m helv-md" href="<?php echo reSiteUrl($clausula); ?>" target="_blank">
                            <div class="txtac mt3 cazul fn1-2m helv-md">
                                Clausulado póliza #34
                            </div>
                        </a>
                    <?php } 
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<?php 
/**
 * 
 * Template Name: Producto - Seguro
 *
 **/

get_header(); 

the_post();
?>

<div id="content-seguro" class="p0">
    <?php get_template_part('components/banner','image_right'); ?>
    <div class="container">
        <div id="activarlo" class="help-active activarlo pt3 pt3">
            <div class="container-seguros">
                <div class="title-active pb6">
                    <h2 class="text-size-5r helv-md">¿Como Activarlo?</h2>
                </div>
                <div class="row pb4">
                    <?php
                    if(have_rows('pasos_para_activarlo')) {
                        $i = 1; $total = count(get_field('pasos_para_activarlo')); $j=1;
                        while(have_rows('pasos_para_activarlo')) {
                            the_row();
                            if($i == 1 || $i == 3){?>
                                <div class="row">
                                    <div class="col-md-6">
                            <?php }
                            if($i == 2 || $i == 4){?>
                                <div class="col-md-6">
                            <?php } ?>
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
                            <?php $i++; 
                            if($i == 2 || $i == 4){?>
                                    </div>
                            <?php }
                            if($i == 3 ){
                                echo '</div></div>';
                            }
                            ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if( $imagePrimas = get_field('image_primas') ) { ?>
        <div class="mt3">
            <div class="container-seguros">
                <h1 class="p0 helv-md text-size-5r">Primas</h1>
                <div class="p0 txtac pt3">
                    <img src="<?php echo $imagePrimas; ?>" class="borAzulRa20" />
                </div>
            </div>
        </div>
        <?php } ?>
        <div id="coberturas" class="bgacinco pt3 pb3">
            <div class="container-seguros">
                <h1 class="p0 helv-md text-size-5r">Coberturas</h1>
                <div class="row p0">
                    <?php 
                        $totalcober = count(get_field('coberturas'));
                        if( have_rows('coberturas') ):
                            while ( have_rows('coberturas') ) : the_row(); ?>
                                <div class="col-sm-4 txtac">
                                    <div class="text-center pt20 pb2">
                                        <img class="" src="<?php the_sub_field('imagen'); ?>" />
                                    </div>
                                    <div class="p0">
                                        <h3 class="helv-md"><?php the_sub_field('titulo'); ?></h3>
                                    </div>
                                    <div class="p0 txt2rem helvlt">
                                        <?php the_sub_field('contenido'); ?>
                                    </div>
                                </div>
                            <?php endwhile;
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="pt3 pb3 txtac">
            <div class="container-seguros">
                <div class="w50 p0 mauto">
                    <a href="/reclamacion-seguro/" class="cblanco btntxt-white">
                        <div class="p0 pt3 pb3 bgverde txtac txt2rem border-r18 ">Trámites y Reclamaciones</div>
                    </a>
                </div>
            </div>
        </div>
        <div id="recobro" class="pt3 pb3">
            <h1 class="text-size-5r pb4 helv-md">Recobros</h1>
            <div class="row">
                <?php the_field('recobros'); ?>
            </div>
        </div>
        <div id="exclusiones" class="pt3 pb3 mb3">
            <div class="container-seguros">
                <h1 class="helv-md text-size-5r pb4">Exclusiones</h1>
                <div class="show-mobile">
                    <ul class="excluded-items txt2rem helvlt">
                        <li><?php echo strip_tags(get_field('exclusiones_text1')); ?></li>
                        <li><?php echo strip_tags(get_field('exclusiones_text2')); ?></li>
                        <li><?php echo strip_tags(get_field('exclusiones_text3')); ?></li>
                        <li><?php echo strip_tags(get_field('exclusiones_text4')); ?></li>
                    </ul>
                </div>
                <div class="show-desktop">
                    <div class="row p0 txtac">
                        <div class="col-sm-4 p0 helvlt txt2rem">
                            <?php the_field('exclusiones_text1'); ?>
                        </div>
                        <div class="col-sm-4 p0"></div>
                        <div class="col-sm-4 p0 helvlt txt2rem">
                            <?php the_field('exclusiones_text2'); ?>
                        </div>
                    </div>
                    <div class="row p0 txtac">
                        <div class="col-sm-4 p0"></div>
                        <div class="col-sm-4 p0">
                            <img src="<?php the_field('exclusiones_imagen'); ?>" alt="exclusiones" class="w100">
                        </div>
                        <div class="col-sm-4 p0"></div>
                    </div>
                    <div class="row p0 txtac">
                        <div class="col-sm-4 p0 helvlt txt2rem">
                            <?php the_field('exclusiones_text3'); ?>
                        </div>
                        <div class="col-sm-4 p0"></div>
                        <div class="col-sm-4 p0 helvlt txt2rem">
                            <?php the_field('exclusiones_text4'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php $terminos = get_field('link_terminos');
                        $clausula = get_field('link_clausula');
                        if($terminos != ""){ ?>
                            <a class="col-md-6 txtac mt3 cazul fn1-2m helv-md" href="<?php echo reSiteUrl($terminos); ?>" target="_blank">
                                <div class="txtac mt3 cazul fn1-2m helv-md">
                                    Ver términos y condiciones
                                </div>
                            </a>
                        <?php }else{?>
                            <div class="col-md-6"></div>
                        <?php }
                        if($clausula != ""){ ?>
                            <a class="col-md-6 txtac mt3 cazul fn1-2m helv-md" href="<?php echo reSiteUrl($clausula); ?>" target="_blank">
                                <div class="txtac mt3 cazul fn1-2m helv-md">
                                    Clausulado póliza #34
                                </div>
                            </a>
                        <?php } else { ?>
                            <div class="col-md-6"></div>
                        <?php }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php get_footer(); ?>
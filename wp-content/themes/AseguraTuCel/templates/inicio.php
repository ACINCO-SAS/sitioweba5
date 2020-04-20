<?php 
/**
 * 
 * Template Name: Home
 *
 **/
get_header(); 
$principal = get_field('colocar_principal');
/*$host = parse_url($_SERVER['HTTP_HOST']);
echo '<script>console.log('.json_encode($host).')</script>';
$domain = parse_url($_SERVER['SERVER_NAME']);
echo '<script>console.log('.json_encode($domain).')</script>';*/
?>
<div id="content-home" class="p0">
    <?php if( $principal == 'image' ){ ?>
    	<img src="<?php echo get_field('banner')?>" alt="banner_home"/>
    <?php }elseif($principal == 'slider'){ 
        echo do_shortcode( get_field( 'slider' ) );
    } ?>
    <div class="bggris">
        <div class="container contentprinci pt4 pb4">
            <div>
                <div id="view-more"><img src="/wp-content/uploads/2018/09/ver-mas.png"></div>
                <?php $contprinci =  get_field('contenido_principal');
                    if($contprinci){
                        echo $contprinci;
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="bgblanco">
        <div class="container contProducts pt4 pb4">
            <div>
                <div class="title-pro pb4">
                    <h2><strong>Productos</strong></h2>
                </div>
                
                <?php
                    $count = 1;
                    if( have_rows('productos') ):
                        while ( have_rows('productos') ) : the_row();
                            $odd = $count % 2 == 0;
                        ?>
                            <div id="home-prod-<?php echo $count; ?>" class="col-sm-12 p0 wrap-row justifyCenter d-flex count<?php echo $count ?>">
                                <div class="col-sm-6 <?php echo !$odd ? 'image' : 'description'; ?> txtac pt4">
                                    <?php if($odd){ ?>
                                        <h3 class="txtal txt4r helv-md"><?php echo the_sub_field('titulo_productos'); ?></h3>
                                        <div class="txtal helvlt txt2rem pt2"><?php echo the_sub_field('contenido_productos'); ?></div>
                                        <a href="<?php echo reSiteUrl(get_sub_field('url_detalle_producto')); ?>" class="cverde dtable p0 txtal abtn-mas">
                                            <div class="btn-mas">
                                                <img src="/wp-content/uploads/2018/08/verde-derecha-min.png" class="floatL img-sig"/>
                                                <p class="helvlt">Ver Más</p>
                                            </div>
                                        </a>
                                    <?php }else{ ?>
                                        <img src="<?php echo the_sub_field('imagen_productos'); ?>" class="img-celularpro" />
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6 <?php echo $odd ? 'image' : 'description'; ?> txtac pt4">
                                    <?php if($count % 2 == 0){ ?>
                                        <img src="<?php echo the_sub_field('imagen_productos'); ?>"class=""  />
                                    <?php }else{ ?>
                                        <h3 class="txtal txt4r helv-md pt4"><?php echo the_sub_field('titulo_productos'); ?></h3>
                                        <div class="txtal helvlt txt2rem pt2"><?php echo the_sub_field('contenido_productos'); ?></div>
                                        <a href="<?php echo reSiteUrl(get_sub_field('url_detalle_producto')); ?>" class="cverde p0 txtal dtable abtn-mas">
                                            <div class="btn-mas">
                                                <img src="/wp-content/uploads/2018/08/verde-derecha-min.png" class="floatL img-sig"/>
                                                <p class="helvlt">Ver Más</p>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php
                            $count++;
                        endwhile;
                    else :
                    endif;
                ?>
            </div>
        </div>
    </div>
    <div class="bgverde">
        <div class="container contExperiencia pt4 pb4">
            <div>
                <div class="title-exp">
                    <h2 class="cblanco txt4r helv-md"><strong>Nuestra Experiencia</strong></h2>
                </div>
                <?php
                    if( have_rows('experiencia') ):
                        while ( have_rows('experiencia') ) : the_row();?>
                            <div class="col-sm-4 text-center">
                                <div class="col-sm-12">
                                    <img src="<?php echo the_sub_field('imagen_experiencia'); ?>"/>
                                </div>
                                <div class="col-sm-12 txtac cblanco helvlt txt2rem pt4">
                                    <?php echo the_sub_field('contenido_experiencia'); ?>
                                </div>
                            </div>
                        <?php endwhile;
                    endif;
                ?>
            </div>
        </div>
    </div>
    <div class="bgblanco">
        <div class="container contClientes pt4 pb4">
            <div>
                <div class="title-cliente pb2">
                <h2 class="txt4r"><strong>Clientes</strong></h2> 
                </div>
                <div class=" txt2rem helvlt pb2">
                    <?php echo get_field('texto_clientes'); ?>
                </div>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="md800">
                        <div class="span12">
                            <div class="well"> 
                                
                                <div id="myCarousel2">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php

                                            if( have_rows('imagenes_clientes') ) {
                                                                                    
                                                while ( have_rows('imagenes_clientes') ) { the_row();
                                                    ?>
                                                    <div class="swiper-slide span3">
                                                        <a href="#x" class="img-cliente">
                                                            <img src="<?php echo the_sub_field('imagen'); ?>" alt="Image" style="max-width:100%;" />
                                                        </a>
                                                    </div>
                                                    <?php 
                                                }
                                                
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-prev">‹</div>
                                    <div class="swiper-button-next">›</div>
                                </div>
                            </div>
                        </div>
                    <div class="row md769 txtac">
                        <div class="span12">
                            <div class="well"> 
                                <div id="myCarousel2" class="carousel slide">
                                    <div class="carousel-inner">
                                        <?php 
                                            $cant = 0;
                                            $totall = count(get_field('imagenes_clientes'));
                                            //echo $total;
                                            if( have_rows('imagenes_clientes') ):
                                                
                                                
                                                //if($count == 0){
                                                    ?><div class="item active"><?php
                                                //}
                                                while ( have_rows('imagenes_clientes') ) : the_row();
                                                    if($cant % 1 == 0){
                                                        ?><div class="row-fluid"><?php
                                                    }?>
                                                    <div class="span3 col-sm-2">
                                                        <a href="#x" class="img-cliente">
                                                            <img src="<?php echo the_sub_field('imagen'); ?>" alt="Image" style="max-width:100%;" />
                                                        </a>
                                                    </div>
                                                <?php $cant++; 
                                                if($cant == $totall){
                                                    ?></div></div><?php
                                                }
                                                if($cant % 1 == 0){
                                                    ?></div></div><div class="item"><?php
                                                }
                                                endwhile;
                                            endif;
                                        ?>
                                    </div>
                                    <a class="left carousel-control" href="#myCarousel2" data-slide="prev">‹</a>
                                    <a class="right carousel-control" href="#myCarousel2" data-slide="next">›</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
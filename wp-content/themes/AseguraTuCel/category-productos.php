<?php get_header(); ?>
<div class="lienzo">
    <section class="banner-category bgi" style="background-image: url(<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(); ?>)">
        <div class="bkdown-header"></div>
        <div class="container">
            <div class="row">
                <div class="text-banner-category title-pro col-md-8 marginTop50">
                    <h2 class="cl-white helv-md "><i class="icon-seguro"></i>Bienvenido</h2>
                    <?php echo category_description(); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="container ontent-category">
        <div>
            <div class="title-category pt4 pb4">
                <h1 class="text-size-5r"><strong><?php single_cat_title() ?></strong></h1>
            </div>
            <div class="container list-cat pb4">
                <div class="row">
                    <?php if(have_posts()) :?>
                    <?php while(have_posts()): the_post();
                    $post_id = get_the_ID();
                    ?>
                    <div class="col-md-12 cat-list">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="title">
                                    <?php $imagen = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full');
                                    $ruta_imagen = $imagen[0];?>
                                    <img src="<?php echo $ruta_imagen; ?>" alt="" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-4 desc-ent">
                                <h3 class="helv-med txt-2r"><?php the_title(); ?></h3>
                                <?php the_content(); ?>
                            </div>
                            <div class="col-md-4 pt3 two-down-buttons">
                                <div class="btn-dell text-center helvlt">
                                    <a class="boton btn-ent" href="<?php the_permalink();?>">
                                        Ver Más   Información
                                    </a>
                                </div>
                                <div class="mt2 text-center helvlt">
                                    <a class="boton btn-ent-r" href="<?php the_field('url_reclamaciones') ?>">
                                        Trámite-Reclamación
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>
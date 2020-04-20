<?php 
/**
 * 
 * Template Name: Nuestros Productos
 *
 **/

get_header(); 

if( have_posts() ) {
    the_post();
    $post_id = get_the_ID();
    
?>
<div class="lienzo">
    <section class="banner-category bgi" style="<?php
    if( has_post_thumbnail() ) {
        echo 'background-image: url(\''.get_the_post_thumbnail_url(null,'full').'\')';
    }
    ?>">
        <div class="bkdown-header"></div>
        <div class="container">
            <div class="row">
                <div class="text-banner-category title-pro col-md-8 marginTop50">
                    <h2 class="cl-white helv-md "><i class="icon-seguro"></i><?php the_field('banner_title'); ?></h2>
                    <?php the_field('banner_description'); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="container ontent-category">
        <div>
            <div class="title-category pt4 pb4">
                <h1 class="text-size-5r"><strong><?php the_title() ?></strong></h1>
            </div>
            <?php if( have_rows('list_products') ) { ?>
            <div class="container list-cat pb4">
                <?php while( have_rows('list_products') ) {
                    the_row();

                    $imgUrl = wp_get_attachment_url(get_sub_field('image'));
                    $listLinks = get_sub_field('list_links');
                ?>
                <div class="row box-rounded">
                    <div class="col-sm-12 col-md-4 form-group">
                        <div class="title block-center">
                            <img src="<?php echo $imgUrl; ?>" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 desc-ent form-group">
                        <h3 class="helv-med txt-2r"><?php echo get_sub_field('title'); ?></h3>
                        <div class="short-desc">
                            <?php echo get_sub_field('description'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 pt3 group-down-buttons form-group">
                        <?php
                        foreach($listLinks as $groupLink) {
                        ?>
                        <div class="listed text-center helvlt">
                            <a class="mybtn mybtn-primary mybtn-<?php echo $groupLink['link']['type']; ?>" href="<?php echo reSiteUrl($groupLink['link']['url']); ?>"><?php echo $groupLink['link']['text']; ?></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </section>
</div>
<?php 
}

get_footer(); ?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$bgImage = null;
$bgColor = '#003984';
if( $newBgColor = get_field('bg_color') ) {
    $bgColor = $newBgColor;
}
if( $newBgImage = get_field('bg_image') ) {
    $bgImage = $newBgImage;
}
?>
<div class="heading-image-phone p0">
    <div style="background-color: <?php echo $bgColor; ?>;<?php echo $bgImage ? 'background-image: url("'.$bgImage.'");':''; ?>" class="wrap-bg p0 cblanco">
        <div class="bkdown-header"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-7 box-text">
                    <h1 class="m0 txt7rem bigtitle2"><strong><?php the_title(); ?></strong></h1><br/>
                    <div class="container-seguros helvlt txt2rem"><?php the_content(); ?></div>
                </div>
                <?php if( $urlImage = get_field('image_right') ) { ?>
                <div class="col-sm-5 box-image">
                    <img class="phone-image" src="<?php echo $urlImage; ?>"/>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
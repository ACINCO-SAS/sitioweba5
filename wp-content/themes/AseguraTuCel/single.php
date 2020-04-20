<?php get_header();  ?>
<div class="p0 h200 mb2 w100" style="background: #003984;"></div>
<div class="container">
    <div class="container">
        <div id="content" class="site-content blog-content-wrapper" role="main">
            <?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }
            }
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
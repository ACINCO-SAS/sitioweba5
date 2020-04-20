<?php get_header();  

the_post();
?>
<?php get_template_part('components/banner','single_title'); ?>
<div class="container pb4">
    <div class="content-editor"><?php the_content(); ?></div>
</div>
<?php get_footer(); ?>
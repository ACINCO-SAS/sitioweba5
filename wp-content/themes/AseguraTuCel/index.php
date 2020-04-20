<?php get_header(); 

$principal = get_field('colocar_principal');

if( $principal == 'image' ){ ?>
	<img src="<?php echo $principal['image']?>" alt="banner_home"/>
<?php }elseif($principal == 'slider'){ 
    echo do_shortcode( $principal['slider'] );
} ?>

<h1>Index</h1>

<?php get_footer(); ?>
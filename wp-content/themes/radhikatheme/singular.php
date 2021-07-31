<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<?php if(is_front_page() && !\Elementor\Plugin::$instance->preview->is_preview_mode()) { 
if(!isset($_COOKIE['welcomescreen'])) {
?>
<div class="bg"></div>
<div class="drag" id="customclass">
	<div class="welcome_block">
	<div class="song">
	<div class="title"></div>
	<div class="pause" onclick="togglePlay()"><img src="/wp-content/uploads/2021/05/mute.svg"></div>
	<div class="player">
		<audio class="audio" src="/wp-content/uploads/2021/05/birds-sound-low.mp3" autoplay type="audio" loop=""></audio>
	</div>

</div>
		
		<div class="welcome_left">
			<img class="loader-logo" src="/wp-content/uploads/2021/05/Logo-RB-Only.svg">
       
        <p><strong>A clinical psychologists multiverse</strong> Psychotherapy<b>bar</b> is a personal labor of love twenty <br> years in the making. It seeks to give
you, dearest reader, <br> free access to lovely psychological book reviews, writings <br> and recordings, conscientiously created and curated by me.</p>
         </div>
    </div>
		
	<div class="welcome_copyright">
		© 2021 Radhika S. Bapat All Rights Reserved 
	</div>
	
    <div class="drag-container">
        <div class="drag-button">
		<img src="/wp-content/uploads/2021/05/hand-loader-left.svg">
		</div>
        <div class="drag-line"></div>
        <div class="drag-target">
		<img src="/wp-content/uploads/2021/05/hand-loader-right.svg">
		</div>
    </div>
    <p>Hold & Drag to Start</p>
</div>
<?php } } ?>
<main id="site-content" role="main">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>

<?php
/**
 * Displays the related in single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
if( $related ){  ?>
	<div class="related-post-blog-container">
		<h4>Related Posts</h4>
		<ul class="related-post-blog">
<?php	foreach( $related as $post ) {
    setup_postdata($post); ?>


        <li>	
			<?php the_excerpt(); ?>
            <?php
            if ( has_post_thumbnail() ) { ?>
                <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail("small"); ?>
                </a>
            <?php } ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php the_category(); ?></p>
        </li>
<?php } 
	
	?>    
	</ul>
</div>

<?php }
wp_reset_postdata();


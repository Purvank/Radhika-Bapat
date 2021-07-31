<?php 
while ( $all_posts->have_posts() ) :

    $all_posts->the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('wpcap-post'); ?>>
         
            <div class="post-grid-inner">
            	
            	<?php $this->render_thumbnail(); ?>

                <div class="post-grid-text-wrap">
               		<?php $this->render_title(); ?>
	                <?php $this->render_meta(); ?>
	                <?php $this->render_excerpt(); ?>
					<?php
                    if($all_posts->query['category_name'] == 'podcasts'){
 						echo mb_strimwidth(get_the_content(), 0, 200);
                    }
                    ?><!-- .inner -->
					<?php $this->render_readmore(); ?>	                
                </div><!-- .blog-inner -->


            </div>
           
        </article>

        <?php

endwhile; 

wp_reset_postdata();
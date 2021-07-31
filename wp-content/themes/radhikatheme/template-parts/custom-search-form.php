<div class="content-search">
	<form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_site_url(); ?>">
		<div>
			<label class="screen-reader-text" for="s">Search for:</label>
			<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />

			<?php wp_dropdown_categories( array(
				'show_option_all' => 'All Posts',
				'orderby' => 'name',
				'echo' => 1,
				'selected' => $cat,
				'hierarchical' => true,
				'class'	=> 'cat-dropdown',
				'id'	=> 'custom-cat-drop',
				'value_field' => 'term_id'
			) ); ?>

			<input type="submit" id="searchsubmit" value="Search" />
		</div>
	</form>
</div>

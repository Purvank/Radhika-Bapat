<?php
if( !defined('ABSPATH')) exit;
add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);

if( ! function_exists( 'enqueue_child_theme_styles' ) ) {
    function enqueue_child_theme_styles()
    {
        // parent style ( this loads the css from the main folder )
        wp_enqueue_style('parent-style', get_template_directory_uri() .'/style.css');
        // child style ( this loads the css from the child folder after parent-style )

        wp_enqueue_style('child-style', get_stylesheet_directory_uri() .'/style.css', array('parent-style'));

    }

}



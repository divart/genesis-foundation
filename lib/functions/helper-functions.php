<?php

/**
 * Unregister the superfish scripts
 */
function ssm_unregister_superfish() {
  wp_deregister_script( 'superfish' );
  wp_deregister_script( 'superfish-args' );
}

/**
 * Filter Yoast SEO Metabox Priority
 */
function ssm_filter_yoast_seo_metabox() {
  return 'low';
}

/**
 *  Sanitize multiple classes at once
 */
if ( ! function_exists( "sanitize_html_classes" ) && function_exists( "sanitize_html_class" ) ) {
  /**
   * sanitize_html_class works just fine for a single class
   * Some times le wild <span class="blue hedgehog"> appears, which is when you need this function,
   * to validate both blue and hedgehog,
   * Because sanitize_html_class doesn't allow spaces.
   *
   * @uses   sanitize_html_class
   * @param  (mixed: string/array) $class   "blue hedgehog goes shopping" or array("blue", "hedgehog", "goes", "shopping")
   * @param  (mixed) $fallback Anything you want returned in case of a failure
   * @return (mixed: string / $fallback )
   */
  function sanitize_html_classes( $class, $fallback = null ) {

    // Explode it, if it's a string
    if ( is_string( $class ) ) {
      $class = explode(" ", $class);
    }


    if ( is_array( $class ) && count( $class ) > 0 ) {
      $class = array_map("sanitize_html_class", $class);
      return implode(" ", $class);
    }
    else {
      return sanitize_html_class( $class, $fallback );
    }
  }
}


/**
  * Set classes for a block wrapper. These can be overridden or added to with a filter like the following:
  *     add_filter( 'fcb_set_block_wrapper_classes', 'custom_block_wrapper_classes' );
  *     function custom_block_wrapper_classes($classes) {
  *         if(is_page_template('template-landing-page.php') {
  *             $classes[]   = 'on-landing-page';
  *         }
  *         return $classes;
  *     }
  *
  * @return string string of classes
  */
 function ssm_block_wrapper_classes() {
    global $cb_i;
    $classes    = array();
    $classes[]  = get_sub_field('html_id');
    $classes[]  = sanitize_html_classes(get_sub_field('class_options'));
    $classes[]  = 0 == $cb_i % 2 ? 'even' : 'odd';

    $classes = array_filter(array_map('trim', $classes));
    echo trim(implode(' ', apply_filters( 'fcb_set_block_wrapper_classes', $classes )));
}

/**
 * Registering menus
 */
register_nav_menus(
  array(
    'primary-navigation' => __( 'Primary Navigation' ),
  )
);